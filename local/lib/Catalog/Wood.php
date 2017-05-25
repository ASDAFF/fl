<?
namespace Local\Catalog;
use Local\System\ExtCache;

/**
 * Class Wood Породы дерева
 * @package Local\Catalog
 */
class Wood
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Wood/';

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 2;

	/**
	 * Урл
	 */
	const URL = '/wood/';

	/**
	 * Возвращает все элементы
	 * @param bool $refreshCache
	 * @return array|mixed
	 */
	public static function getAll($refreshCache = false)
	{
		$return = [];

		$extCache = new ExtCache(
			[
				__FUNCTION__,
			],
			static::CACHE_PATH . __FUNCTION__ . '/',
			8640000
		);
		if (!$refreshCache && $extCache->initCache())
			$return = $extCache->getVars();
		else
		{
			$extCache->startDataCache();

			$iblockElement = new \CIBlockElement();
			$rsItems = $iblockElement->GetList(['NAME' => 'ASC'], [
				'IBLOCK_ID' => self::IBLOCK_ID,
			    'ACTIVE' => 'Y',
			], false, false, [
				'ID', 'NAME', 'CODE', 'DETAIL_TEXT',
                'PROPERTY_HARDNESS',
                'PROPERTY_DENSITY',
                'PROPERTY_MENU',
			]);
			while ($item = $rsItems->Fetch())
			{
				$id = intval($item['ID']);
				$detail = self::URL . $item['CODE'] . '/';
				$return['ITEMS'][$id] = [
					'ID' => $id,
					'NAME' => $item['NAME'],
				    'CODE' => $item['CODE'],
                    'DETAIL_TEXT' => $item['DETAIL_TEXT'],
                    'HARDNESS' => floatval($item['PROPERTY_HARDNESS_VALUE']),
                    'DENSITY' => intval($item['PROPERTY_DENSITY_VALUE']),
                    'MENU' => $item['PROPERTY_MENU_VALUE'],
                    'DETAIL_PAGE_URL' => $detail,
				];
				if ($item['CODE'])
					$return['BY_CODE'][$item['CODE']] = $id;
			}

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Возвращает элемент по Id
	 * @param $id
	 * @param bool $refreshCache
	 * @return mixed
	 */
	public static function getById($id, $refreshCache = false)
	{
		$items = self::getAll($refreshCache);
		return $items['ITEMS'][$id];
	}

	/**
	 * Возвращает элемент по коду
	 * @param $code
	 * @param bool $refreshCache
	 * @return mixed
	 */
	public static function getByCode($code, $refreshCache = false)
	{
		$items = self::getAll($refreshCache);
		$id = $items['BY_CODE'][$code];
		return $items['ITEMS'][$id];
	}

	/**
	 * Возвращает элементы, которые нужно вывести в меню
	 * @return array
	 */
	public static function getForMenu()
	{
		$return = [];
		$items = self::getAll();
		foreach ($items['ITEMS'] as $item)
			if ($item['MENU'])
				$return[] = $item;

		return $return;
	}

	/**
	 * Возвращает группу для панели фильтров
	 * @return mixed
	 */
	public static function getGroup()
	{
		$items = self::getAll();
		$return = [];
		foreach ($items['ITEMS'] as $item)
		{
			if ($item['CODE'])
				$return[$item['CODE']] = [
					'ID' => $item['ID'],
					'NAME' => $item['NAME'],
					'CODE' => 'WOOD',
				];
		}

		return $return;
	}

}
