<?
namespace Local\Catalog;
use Local\System\ExtCache;

/**
 * Class Section Разделы каталога
 * @package Local\Catalog
 */
class Section
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Section/';

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 9;

	/**
	 * Возвращает все разделы
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

			$iblockSection = new \CIBlockSection();
			$rsItems = $iblockSection->GetList(['LEFT_MARGIN' => 'ASC', 'SORT' => 'ASC'], [
				'IBLOCK_ID' => self::IBLOCK_ID,
			    'ACTIVE' => 'Y',
			], false, [
				'ID', 'NAME', 'CODE', 'IBLOCK_SECTION_ID'
			]);
			while ($item = $rsItems->Fetch())
			{
				$id = intval($item['ID']);
				$return['ITEMS'][$id] = [
					'ID' => $id,
					'NAME' => $item['NAME'],
				    'CODE' => $item['CODE'],
				    'PARENT' => intval($item['IBLOCK_SECTION_ID']),
				    'ITEMS' => [],
				];
				if ($item['CODE'])
					$return['BY_CODE'][$item['CODE']] = $id;
			}

			foreach ($return['ITEMS'] as $id => $item)
			{
				$parent = $item['PARENT'];
				$return['ITEMS'][$parent]['ITEMS'][] = $id;
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
	 * Возвращает дерево для панели фильтров
	 * @param int $id
	 * @return mixed
	 */
	public static function getTree($id = 0)
	{
		$section = self::getById($id);
		$items = [];
		foreach ($section['ITEMS'] as $i)
		{
			$items[] = self::getTree($i);
		}
		$section['ITEMS'] = $items;

		return $section;
	}

	/**
	 * Возвращает группу для панели фильтров
	 * @return mixed
	 */
	public static function getGroup()
	{
		$items = self::getAll();
		$return = [];
		foreach ($items['ITEMS'] as $section)
		{
			if ($section['CODE'])
				$return[$section['CODE']] = [
					'ID' => $section['ID'],
					'NAME' => $section['NAME'],
					'CODE' => 'CATEGORY',
				];
		}

		return $return;
	}

	/**
	 * Возвращает ID категорий, в которых есть товары
	 * @param $ids
	 * @return array
	 */
	public static function getChildrenFilter($ids)
	{
		$return = [];
		foreach ($ids as $id)
		{
			$section = self::getById($id);
			if ($section['ITEMS'])
			{
				$ret = self::getChildrenFilter($section['ITEMS']);
				foreach ($ret as $r)
					$return[$r] = $r;
			}
			else
				$return[$id] = $id;
		}

		return $return;
	}

	/**
	 * Возвращает цепочку предков для категории
	 * @param $id
	 * @return array
	 */
	public static function getChain($id)
	{
		$sections = [];
		$sectionId = $id;
		while ($sectionId)
		{
			$section = self::getById($sectionId);
			if ($section)
				array_unshift($sections, $section);
			$sectionId = $section['PARENT'];
		}

		return $sections;
	}
}
