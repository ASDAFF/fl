<?
namespace Local\Catalog;

use Bitrix\Iblock\InheritedProperty\ElementValues;
use Local\System\ExtCache;

/**
 * Class Product Товары
 * @package Local\Catalog
 */
class Product
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Product/';

	/**
	 * Время кеширования
	 */
	const CACHE_TIME = 86400;

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 1;

	/**
	 * Возвращает все элементы
	 * @param bool $refreshCache
	 * @return array|mixed
	 */
	public static function getAll_($refreshCache = false)
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
				'ID',
				'NAME',
				'CODE',
				'PREVIEW_TEXT',
				'DETAIL_TEXT',
				'PREVIEW_PICTURE',
				'DETAIL_PICTURE',
				'PROPERTY_SECTION',
				'PROPERTY_SECTION1',
				'PROPERTY_BRAND',
				'PROPERTY_COUNTRY',
				'PROPERTY_WOOD',
				'PROPERTY_COLOR',
				'PROPERTY_PICTURES',
				'PROPERTY_COL',
				'PROPERTY_COL1',
			]);
			while ($item = $rsItems->Fetch())
			{
				$id = intval($item['ID']);
				$return['ITEMS'][$id] = [
					'ID' => $id,
					'NAME' => $item['NAME'],
					'CODE' => $item['CODE'],
					'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
					'DETAIL_TEXT' => $item['DETAIL_TEXT'],
					'PREVIEW_PICTURE' => $item['PREVIEW_PICTURE'],
					'DETAIL_PICTURE' => $item['DETAIL_PICTURE'],
					'SECTION' => intval($item['PROPERTY_SECTION_VALUE']),
					'SECTION1' => intval($item['PROPERTY_SECTION1_VALUE']),
					'BRAND' => intval($item['PROPERTY_BRAND_VALUE']),
					'COUNTRY' => intval($item['PROPERTY_COUNTRY_VALUE']),
					'WOOD' => intval($item['PROPERTY_WOOD_VALUE']),
					'COLOR' => $item['PROPERTY_COLOR_VALUE'],
					'PICTURES' => $item['PROPERTY_PICTURES_VALUE'],
					'COL' => $item['PROPERTY_COL_VALUE'],
					'COL1' => $item['PROPERTY_COL1_VALUE'],
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
	public static function getById_($id, $refreshCache = false)
	{
		$items = self::getAll_($refreshCache);

		return $items['ITEMS'][$id];
	}

	/**
	 * Возвращает элемент по коду
	 * @param $code
	 * @param bool $refreshCache
	 * @return mixed
	 */
	public static function getByCode_($code, $refreshCache = false)
	{
		$items = self::getAll_($refreshCache);
		$id = $items['BY_CODE'][$code];

		return $items['ITEMS'][$id];
	}

	/**
	 * Возвращает карточку по ID
	 * @param int $id
	 * @param bool $refreshCache
	 * @return array|mixed
	 */
	public static function getById($id, $refreshCache = false)
	{
		$return = [];

		$id = intval($id);
		if (!$id)
			return $return;

		$extCache = new ExtCache(
			[
				__FUNCTION__,
				$id,
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
				'ID' => $id,
			], false, false, [
				'ID',
				'IBLOCK_ID',
				'PROPERTY_BRAND',
				'PROPERTY_COUNTRY',
				'PROPERTY_WOOD',
				'PROPERTY_COLOR',
				'PROPERTY_PICTURES',
			]);
			if ($item = $rsItems->Fetch())
				$return = [
					'BRAND' => intval($item['PROPERTY_BRAND_VALUE']),
					'COUNTRY' => intval($item['PROPERTY_COUNTRY_VALUE']),
					'WOOD' => intval($item['PROPERTY_WOOD_VALUE']),
					'COLOR' => intval($item['PROPERTY_COLOR_VALUE']),
					'PICTURES' => $item['PROPERTY_PICTURES_VALUE'],
				];

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Корректирует значения свойств предложений, зависящих от товара
	 * @param $productId
	 */
	public static function correctOfferFields($productId)
	{
		$product = self::getById($productId);
		if ($product)
		{
			$offers = Offer::getByProduct($productId);
			foreach ($offers as $id => $offer)
				Offer::correctProductFields($id, $offer, $product);
		}
	}

	/**
	 * Очищает кеш каталога
	 */
	public static function clearCatalogCache()
	{
		$phpCache = new \CPHPCache();
		$phpCache->CleanDir(static::CACHE_PATH . 'getAll');
		$phpCache->CleanDir(static::CACHE_PATH . 'getDataByFilter');
		$phpCache->CleanDir(static::CACHE_PATH . 'get');
		$phpCache->CleanDir(static::CACHE_PATH . 'getById');
	}

}
