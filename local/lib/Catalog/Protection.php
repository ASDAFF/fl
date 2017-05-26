<?
namespace Local\Catalog;
use Local\System\ExtCache;

/**
 * Class Protection Классы защиты
 * @package Local\Catalog
 */
class Protection
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Protection/';

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 17;

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
			$rsItems = $iblockElement->GetList([], [
				'IBLOCK_ID' => self::IBLOCK_ID,
			    'ACTIVE' => 'Y',
			], false, false, [
				'ID', 'NAME', 'CODE',
			]);
			while ($item = $rsItems->Fetch())
			{
				$id = intval($item['ID']);
				$return['ITEMS'][$id] = [
					'ID' => $id,
					'NAME' => $item['NAME'],
					'CODE' => $item['CODE'],
				];
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
	 * Возвращает элемент по названию
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
					'CODE' => 'PROTECTION',
				];
		}

		return $return;
	}

}
