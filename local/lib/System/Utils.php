<?
namespace Local\System;

/**
 * Class Utils Утилиты проекта
 * @package Local
 */
class Utils
{

	/**
	 * Возвращает слово с нужным окончанием в зависимости от числительного
	 * @param $num
	 * @param string $s0 10 штук
	 * @param string $s1 1 штука
	 * @param string $s2 2 штуки
	 * @return string
	 */
	public static function cardinalNumberRus($num, $s0 = '', $s1 = '', $s2 = '') {
		$l = strlen($num);
		$dec = 0;
		$iNubmer = intval($num);
		if ($l > 1)
		{
			$iNubmer = intval(substr($num, ($l - 1)));
			$dec = intval(substr($num, ($l - 2), 1));
		}
		if ($iNubmer > 4 || $iNubmer == 0 || $dec == 1)
			return $s0;
		elseif ($iNubmer == 1)
			return $s1;
		else
			return $s2;
	}

}
