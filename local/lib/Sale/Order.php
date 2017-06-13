<?
namespace Local\Sale;

use Bitrix\Main\Loader;
use Local\Catalog\Offer;

/**
 * Class Order Заказ
 * @package Local\Sale
 */
class Order
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Sale/Order/';

	/**
	 * Возвращает свойства заказа
	 * @return array
	 */
	public static function getProps()
	{
		$return = array();

		$rsProps = \CSaleOrderProps::GetList(
			array('SORT' => 'ASC'),
			array(
				'PERSON_TYPE_ID' => 1,
				'ACTIVE' => 'Y',
			),
			false,
			false,
			array('ID', 'NAME', 'TYPE', 'SORT', 'CODE')
		);
		while ($item = $rsProps->Fetch())
			$return[$item['CODE']] = $item;

		return $return;
	}

	public static function create($cart, $user)
	{
		Loader::IncludeModule('sale');

		$userId = $user['ID'];
		if (!$userId)
			return 0;

		$fields = array(
			'LID' => SITE_ID,
			'PERSON_TYPE_ID' => 1,
			'PAYED' => 'N',
			'CANCELED' => 'N',
			'STATUS_ID' => 'N',
			'PRICE' => $cart['PRICE'],
			'PRICE_DELIVERY' => 0,
			'CURRENCY' => 'RUB',
			'USER_ID' => $userId,
			'PAY_SYSTEM_ID' => 1,
			'DELIVERY_ID' => 2,
		);

		$order = new \CSaleOrder();
		$basket = new \CSaleBasket();
		$orderId = $order->Add($fields);

		if ($orderId)
		{
			$arOrderProps = self::getProps();

			foreach ($cart['ITEMS'] as $item)
			{
				$basket->Update($item['ID'], array(
					'ORDER_ID' => $orderId,
				));
			}

			Cart::updateSessionCartSummary();

			$prop = $arOrderProps['FIO'];
			$fields = array(
				'ORDER_ID' => $orderId,
				'ORDER_PROPS_ID' => $prop['ID'],
				'NAME' => $prop['NAME'],
				'CODE' => $prop['CODE'],
				'VALUE' => $user['NAME'],
			);
			\CSaleOrderPropsValue::Add($fields);
			$prop = $arOrderProps['EMAIL'];
			$fields = array(
				'ORDER_ID' => $orderId,
				'ORDER_PROPS_ID' => $prop['ID'],
				'NAME' => $prop['NAME'],
				'CODE' => $prop['CODE'],
				'VALUE' => $user['EMAIL'],
			);
			\CSaleOrderPropsValue::Add($fields);
			if ($_REQUEST['order_phone'])
			{
				$prop = $arOrderProps['PHONE'];
				$fields = array(
					'ORDER_ID' => $orderId,
					'ORDER_PROPS_ID' => $prop['ID'],
					'NAME' => $prop['NAME'],
					'CODE' => $prop['CODE'],
					'VALUE' => htmlspecialchars($_REQUEST['order_phone']),
				);
				\CSaleOrderPropsValue::Add($fields);
			}
			if ($_REQUEST['order_address'])
			{
				$prop = $arOrderProps['ADDRESS'];
				$fields = array(
					'ORDER_ID' => $orderId,
					'ORDER_PROPS_ID' => $prop['ID'],
					'NAME' => $prop['NAME'],
					'CODE' => $prop['CODE'],
					'VALUE' => htmlspecialchars($_REQUEST['order_address']),
				);
				\CSaleOrderPropsValue::Add($fields);
			}

			/*if ($userName)
				$userName = 'Уважаемый ' . $userName . ",";

			$eventFields = array(
				'ORDER_ID' => $orderId,
				'ORDER_DATE' => date('d.m.Y H:i'),
				'ORDER_USER' => $userName,
				'EMAIL' => $user['EMAIL'],
				'PRICE' => $cart['PRICE'] + $cart['SERV_PRICE'],
				'ORDER_LIST' => '',
				'SALE_EMAIL' => \COption::GetOptionString('sale', 'order_email', 'order@' . $_SERVER['SERVER_NAME']),
				'PAYLINK' => 'http://' . \COption::GetOptionString('main', 'server_name', $_SERVER['SERVER_NAME']) .
					'/personal/order/payment/?id=' . $orderId,
			);
			if ($_SESSION['LOCAL_USER']['PASS'])
			{
				$eventFields['REG_INFO'] = "На сайте был зарегистрирован пользователь с указанным email\n";
				$eventFields['REG_INFO'] .= "Пароль: " . $_SESSION['LOCAL_USER']['PASS'] . "\n";
				//unset($_SESSION['LOCAL_USER']['PASS']);
			}
			\CEvent::SendImmediate('ADD_ORDER', 's1', $eventFields);*/
		}

		return $orderId;
	}

	public static function createQuick($offerId, $cnt, $user)
	{
		Loader::IncludeModule('sale');

		$userId = $user['ID'];
		if (!$userId)
			return 0;

		$offer = Offer::getById($offerId);
		if (!$offer)
			return false;

		$cnt = intval($cnt);
		if ($cnt < 1)
			$cnt = 1;

		$inpack = $offer['INPACK'];
		$qnt = $cnt * $inpack;
		$price = $offer['PRICE'] * $qnt;

		$fields = array(
			'LID' => SITE_ID,
			'PERSON_TYPE_ID' => 1,
			'PAYED' => 'N',
			'CANCELED' => 'N',
			'STATUS_ID' => 'N',
			'PRICE' => $price,
			'PRICE_DELIVERY' => 0,
			'CURRENCY' => 'RUB',
			'USER_ID' => $userId,
			'PAY_SYSTEM_ID' => 1,
			'DELIVERY_ID' => 2,
		);

		$order = new \CSaleOrder();
		$basket = new \CSaleBasket();
		$orderId = $order->Add($fields);

		if ($orderId)
		{
			$arOrderProps = self::getProps();

			$cartFields = [
				'ORDER_ID' => $orderId,
				'PRODUCT_ID' => $offerId,
				'PRICE' => $offer['PRICE'],
				'PRODUCT_PRICE_ID' => $cnt,
				'QUANTITY' => $qnt,
				'CURRENCY' => 'RUB',
				'LID' => SITE_ID,
				'DELAY' => 'N',
				'CAN_BUY' => 'Y',
				'NAME' => $offer['NAME'],
				'MODULE' => 'main',
				'DETAIL_PAGE_URL' => $offer['DETAIL_PAGE_URL'],
				'PROPS' => [],
			];
			$basket->Add($cartFields);

			Cart::updateSessionCartSummary();

			$prop = $arOrderProps['FIO'];
			$fields = array(
				'ORDER_ID' => $orderId,
				'ORDER_PROPS_ID' => $prop['ID'],
				'NAME' => $prop['NAME'],
				'CODE' => $prop['CODE'],
				'VALUE' => $user['NAME'],
			);
			\CSaleOrderPropsValue::Add($fields);
			$prop = $arOrderProps['EMAIL'];
			$fields = array(
				'ORDER_ID' => $orderId,
				'ORDER_PROPS_ID' => $prop['ID'],
				'NAME' => $prop['NAME'],
				'CODE' => $prop['CODE'],
				'VALUE' => $user['EMAIL'],
			);
			\CSaleOrderPropsValue::Add($fields);
			if ($_REQUEST['order_phone'])
			{
				$prop = $arOrderProps['PHONE'];
				$fields = array(
					'ORDER_ID' => $orderId,
					'ORDER_PROPS_ID' => $prop['ID'],
					'NAME' => $prop['NAME'],
					'CODE' => $prop['CODE'],
					'VALUE' => htmlspecialchars($_REQUEST['order_phone']),
				);
				\CSaleOrderPropsValue::Add($fields);
			}
		}

		return $orderId;
	}

}