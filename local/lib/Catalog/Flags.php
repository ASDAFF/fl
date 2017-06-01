<?
namespace Local\Catalog;

/**
 * Class Flags Простые свойства санаториев
 * @package Local\Catalog
 */
class Flags
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Flags/';

	private static $all = array(
		'Спецпредложения' => array(
			'hit' => array(
				'CODE' => 'HIT',
				'NAME' => 'Хит',
				'MAP' => true,
			),
			'action' => array(
				'CODE' => 'ACTION',
				'NAME' => 'Акция',
				'MAP' => true,
			),
			'new' => array(
				'CODE' => 'NEW',
				'NAME' => 'Новинка',
				'MAP' => true,
			),
		),
	);

	/**
	 * Возвращает все свойства
	 * @return array
	 */
	public static function getAll()
	{
		return self::$all;
	}

	/**
	 * Возвращает свойства в формате для селекта
	 * @return array
	 */
	public static function getForSelect()
	{
		$return = array();
		foreach (self::$all as $props)
		{
			foreach ($props as $prop)
				$return[] = 'PROPERTY_' . $prop['CODE'];
		}
		return $return;
	}

	/**
	 * Возвращает коды свойств
	 * @return array
	 */
	public static function getCodes()
	{
		$return = array();
		foreach (self::$all as $props)
		{
			foreach ($props as $prop)
				$return[] = $prop['CODE'];
		}
		return $return;
	}
}
