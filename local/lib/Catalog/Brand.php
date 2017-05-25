<?
namespace Local\Catalog;
use Local\System\ExtCache;

/**
 * Class Brand Производители
 * @package Local\Catalog
 */
class Brand
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Brand/';

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 4;

	/**
	 * Урл
	 */
	const URL = '/brand/';

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
			$rsItems = $iblockElement->GetList(['NAME' => 'asc'], [
				'IBLOCK_ID' => self::IBLOCK_ID,
			    'ACTIVE' => 'Y',
			], false, false, [
				'ID', 'NAME', 'CODE',
				'PREVIEW_PICTURE', 'DETAIL_PICTURE', 'PREVIEW_TEXT', 'DETAIL_TEXT',
                'PROPERTY_NAME_RU',
                'PROPERTY_COUNTRY',
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
                    'PREVIEW_PICTURE' => $item['PREVIEW_PICTURE'],
                    'DETAIL_PICTURE' => $item['DETAIL_PICTURE'],
                    'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
                    'DETAIL_TEXT' => $item['DETAIL_TEXT'],
                    'NAME_RU' => $item['PROPERTY_NAME_RU_VALUE'],
                    'COUNTRY' => $item['PROPERTY_COUNTRY_VALUE'],
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
					'CODE' => 'BRAND',
				];
		}

		return $return;
	}


}
