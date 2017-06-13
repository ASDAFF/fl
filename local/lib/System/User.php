<?
namespace Local\System;

/**
 * Дополнительные методы для работы с пользователем битрикса
 */
class User
{
	/**
	 * @var bool Пользователь
	 */
	private static $user = false;
	/**
	 * @var \CUser
	 */
	private static $u = false;
	/**
	 * @var int
	 */
	private static $uId = false;

	/**
	 * Возвращает ID текущего пользователя
	 * @return bool|null
	 */
	public static function getCurrentUserId()
	{
		if (!self::$uId)
		{
			if ($_SESSION['LOCAL_USER']['ID'])
				self::$uId = $_SESSION['LOCAL_USER']['ID'];
			else
			{
				$u = self::getBitrixUser();
				self::$uId = intval($u->GetID());
			}
		}
		return self::$uId;
	}

	/**
	 * Возвращает объект битрикса
	 * @return \CUser
	 */
	public static function getBitrixUser()
	{
		if (!self::$u)
			self::$u = new \CUser();

		return self::$u;
	}

	/**
	 * Возвращает текущего пользователя
	 * @param bool $update
	 * @return array|bool
	 */
	public static function getCurrentUser($update = false)
	{
		if ($update || self::$user === false)
		{
			$userId = self::getCurrentUserId();
			if ($userId)
			{
				$u = self::getBitrixUser();
				$rs = $u->GetByID($userId);
				$user = $rs->Fetch();
				self::$user = array(
					'ID' => $user['ID'],
					'NAME' => $user['NAME'],
				    'EMAIL' => $user['EMAIL'],
				    'PHONE' => $user['PERSONAL_PHONE'],
				    'ADDRESS' => $user['PERSONAL_STREET'],
				);
			}
			else
				self::$user = array();
		}

		return self::$user;
	}

	/**
	 * Корректирует имя и фамилию ползователя
	 * @param $name
	 * @param $phone
	 * @param $address
	 */
	public static function update($name, $phone, $address = '')
	{
		if (self::$user === false)
			return;

		$update = array();
		if ($name && self::$user['NAME'] != $name)
			$update['NAME'] = $name;
		if ($phone && self::$user['PHONE'] != $phone)
			$update['PERSONAL_PHONE'] = $phone;
		if ($address && self::$user['ADDRESS'] != $address)
			$update['PERSONAL_STREET'] = $address;
		if ($update)
		{
			$u = self::getBitrixUser();
			$u->Update(self::$user['ID'], $update);
		}
	}

	/**
	 * Возвращает пользователя по email
	 * @param $email
	 * @return array
	 */
	public static function getByEmail($email)
	{
		$user = array();

		$u = self::getBitrixUser();
		$rs = $u->GetList($by, $order, array(
			'=EMAIL' => $email,
		));
		if ($item = $rs->Fetch())
		{
			$_SESSION['LOCAL_USER']['ID'] = $item['ID'];
			$user = self::getCurrentUser(true);
		}

		return $user;
	}

	/**
	 * Возвращает пользователя по телефону
	 * @param $phone
	 * @return array|bool
	 */
	public static function getByPhone($phone)
	{
		$user = array();

		$u = self::getBitrixUser();
		$rs = $u->GetList($by, $order, array(
			'=PERSONAL_PHONE' => $phone,
		));
		if ($item = $rs->Fetch())
		{
			$_SESSION['LOCAL_USER']['ID'] = $item['ID'];
			$user = self::getCurrentUser(true);
		}

		return $user;
	}

	/**
	 * Проверка пользователя перед созданием заказа
	 * @param $name
	 * @param $email
	 * @param $phone
	 * @param $address
	 * @return array|bool
	 */
	public static function checkOrder($name, $email, $phone, $address)
	{
		$name = htmlspecialchars(trim($name));
		$email = htmlspecialchars(trim($email));
		$phone = htmlspecialchars(trim($phone));
		$address = htmlspecialchars(trim($address));

		$user = self::getCurrentUser();
		if ($user)
		{
			// Если пользователь авторизован - скорректируем поля профиля
			self::update($name, $phone, $address);
		}
		else
		{
			if (!$email)
				return array(
					'MESSAGE' => 'Заполните email',
				);

			// Если не авторизован - пробуем найти по email
			$user = self::getByEmail($email);
			if (!$user)
			{
				// если не найден по email - регистрируем
				$user = self::register($name, $email);
				if ($user)
					self::update($name, $phone, $address);
			}
		}

		return $user;
	}

	/**
	 * Проверка пользователя перед созданием заказа в один клик
	 * @param $name
	 * @param $phone
	 * @return array|bool
	 */
	public static function checkQuickOrder($name, $phone)
	{
		$name = htmlspecialchars(trim($name));
		$phone = htmlspecialchars(trim($phone));

		$user = self::getCurrentUser();
		if ($user)
		{
			// Если пользователь авторизован - скорректируем поля профиля
			self::update($name, $phone);
		}
		else
		{
			// Если не авторизован - пробуем найти по email
			$user = self::getByPhone($phone);
			if (!$user)
			{
				// если не найден по email - регистрируем
				$email = $phone . '@veles-parket.ru';
				$user = self::register($name, $email);
				if ($user)
					self::update($name, $phone);
			}
		}

		return $user;
	}

	/**
	 * Генерирует пароль
	 * @param int $length
	 * @return string
	 */
	public static function generatePass($length = 8)
	{
		$keychars = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789_';
		$return = '';
		$max = strlen($keychars) - 1;
		for ($i = 0; $i < $length; $i++)
			$return .= $keychars{rand(0, $max)};
		return $return;
	}

	/**
	 * Регистрирует пользователя
	 * @param $name
	 * @param $email
	 * @return array|bool
	 */
	public static function register($name, $email)
	{
		$name = htmlspecialchars(trim($name));
		$email = htmlspecialchars(trim($email));
		$pass = self::generatePass();
		if (!self::$u)
			self::$u = new \CUser();
		$user = self::$u->Register(
			$email,
			$name,
			'',
			$pass,
			$pass,
			$email
		);

		if ($user['TYPE'] == 'OK' && $user['ID'])
		{
			$_SESSION['LOCAL_USER']['PASS'] = $pass;
			$user = self::getCurrentUser(true);
		}

		return $user;
	}

	/**
	 * Генерирует новый пароль для указанного email и отправляет письмо
	 * @param $email
	 * @return array
	 */
	public static function forgotPwd($email)
	{
		$return = [];
		// Пробуем найти по email
		$user = self::getByEmail($email);
		if (!$user)
		{
			$return['TYPE'] = 'ERROR';
			$return['MESSAGE'] = 'Введенный Email не найден';
		}
		else
		{
			$pwd = self::generatePass();

			$u = self::getBitrixUser();
			$res = $u->Update($user['ID'], [
				'PASSWORD' => $pwd,
				'CONFIRM_PASSWORD' => $pwd,
			]);
			if (!$res)
			{
				$return['TYPE'] = 'ERROR';
				$return['MESSAGE'] = 'Ошибка генерации пароля';
			}
			else
			{
				$eventFields = [
					'USER_ID' => $user['ID'],
					'EMAIL' => $email,
					'PASSWORD' => $pwd,
				];

				\CEvent::Send('NEW_PASSWORD', 's1', $eventFields);

				$return['TYPE'] = 'OK';
				$return['MESSAGE'] = 'Сгенерирован новый пароль и отправлен на указанный Email';
			}
		}

		return $return;
	}
}
