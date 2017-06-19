<?
namespace Local\Catalog;
use Local\System\ExtCache;
use Local\System\User;

/**
 * Class Offer Торговые предложения
 * @package Local\Catalog
 */
class Offer
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Offer/';

	/**
	 * Время кеширования
	 */
	const CACHE_TIME = 86400;

	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 5;

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
				'ID', 'NAME', 'CODE',
				'PREVIEW_PICTURE',
				'DETAIL_PICTURE',
				'PREVIEW_TEXT',
				'DETAIL_TEXT',
			    'PROPERTY_PRODUCT',
			    'PROPERTY_COUNTRY',
			    'PROPERTY_UNIT',
			    'PROPERTY_SECTION',
			    'PROPERTY_BRAND',
			    'PROPERTY_WOOD',
			    'PROPERTY_COLOR',
			    'PROPERTY_ARTICLE',
			    'PROPERTY_DIM',
			    'PROPERTY_COATING',
			    'PROPERTY_PROTECTION',
			    'PROPERTY_PRICE',
			    'PROPERTY_PRICE_P',
			    'PROPERTY_L',
			    'PROPERTY_L1',
			    'PROPERTY_W',
			    'PROPERTY_W1',
			    'PROPERTY_H',
			    'PROPERTY_H1',
			    'PROPERTY_SCHEME',
			    'PROPERTY_SCHEME_DETAIL',
			    'PROPERTY_ORIG',
			    'PROPERTY_JSON',
			]);
			while ($item = $rsItems->Fetch())
			{
				$id = intval($item['ID']);
				$return['ITEMS'][$id] = [
					'ID' => $id,
					'NAME' => $item['NAME'],
					'CODE' => $item['CODE'],
					'PREVIEW_PICTURE' => $item['PREVIEW_PICTURE'],
					'DETAIL_PICTURE' => $item['DETAIL_PICTURE'],
				    'PRODUCT' => intval($item['PROPERTY_PRODUCT_VALUE']),
				    'SECTION' => intval($item['PROPERTY_SECTION_VALUE']),
				    'BRAND' => intval($item['PROPERTY_BRAND_VALUE']),
				    'WOOD' => intval($item['PROPERTY_WOOD_VALUE']),
				    'COUNTRY' => $item['PROPERTY_COUNTRY_VALUE'],
				    'ARTICLE' => $item['PROPERTY_ARTICLE_VALUE'],
				    'COLOR' => $item['PROPERTY_COLOR_VALUE'],
				    'PROTECTION' => intval($item['PROPERTY_PROTECTION_VALUE']),
				    'UNIT' => intval($item['PROPERTY_UNIT_VALUE']),
				    'PRICE' => intval($item['PROPERTY_PRICE_VALUE']),
				    'PRICE_P' => intval($item['PROPERTY_PRICE_P_VALUE']),
				    'PREVIEW_TEXT' => $item['PREVIEW_TEXT'],
				    'DETAIL_TEXT' => $item['DETAIL_TEXT'],
				    'DIM' => $item['PROPERTY_DIM_VALUE'],
				    'COATING' => $item['PROPERTY_COATING_VALUE'],
				    'L' => floatval($item['PROPERTY_L_VALUE']),
				    'L1' => floatval($item['PROPERTY_L1_VALUE']),
				    'W' => floatval($item['PROPERTY_W_VALUE']),
				    'W1' => floatval($item['PROPERTY_W1_VALUE']),
				    'H' => floatval($item['PROPERTY_H_VALUE']),
				    'H1' => floatval($item['PROPERTY_H1_VALUE']),
				    'SCHEME' => $item['PROPERTY_SCHEME_VALUE'],
				    'SCHEME_DETAIL' => $item['PROPERTY_SCHEME_DETAIL_VALUE'],
				    'ORIG' => $item['PROPERTY_ORIG_VALUE'],
				    'JSON' => $item['PROPERTY_JSON_VALUE'],
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
	 * Возвращает данные по фильтру
	 * (сначала получает все getAll - потом фильтрует)
	 * @param $filter
	 * @param bool|false $refreshCache
	 * @return array
	 */
	public static function getDataByFilter($filter, $refreshCache = false)
	{
		$return = [
			'COUNT' => 0,
		];

		$extCache = new ExtCache(
			[
				__FUNCTION__,
				$filter,
			],
			static::CACHE_PATH . __FUNCTION__ . '/',
			static::CACHE_TIME,
			false
		);
		if (!$refreshCache && $extCache->initCache())
		{
			$return = $extCache->getVars();
		}
		else
		{
			$extCache->startDataCache();

			$offers = self::get(0, $filter);
			foreach ($offers['ITEMS'] as $offer)
			{
				$return['COUNT']++;

				// Цена
				if (!isset($return['PRICE']['MIN']) || $return['PRICE']['MIN'] > $offer['PRICE'])
					$return['PRICE']['MIN'] = $offer['PRICE'];
				if (!isset($return['PRICE']['MAX']) || $return['PRICE']['MAX'] < $offer['PRICE'])
					$return['PRICE']['MAX'] = $offer['PRICE'];

				// Категории
				$sections = [];
				$s = $offer['SECTION'];
				while ($s)
				{
					$sections[$s] = $s;
					$sect = Section::getById($s);
					$s = $sect['PARENT'];
				}
				foreach ($sections as $sect)
					$return['CATEGORY'][$sect]++;

				$return['COLOR'][$offer['COLOR']]++;
				$return['BRAND'][$offer['BRAND']]++;
				$return['COUNTRY'][$offer['COUNTRY']]++;
				$return['WOOD'][$offer['WOOD']]++;
				$return['PROTECTION'][$offer['PROTECTION']]++;

				foreach (Flags::getCodes() as $code)
				{
					if ($offer['FLAGS'][$code])
					{
						if (!isset($return[$code]))
							$return[$code] = 0;
						$return[$code]++;
					}
				}
			}

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Возвращает предложения по фильтру
	 * @param $type
	 * @param $bitrixFilter
	 * @param array $sort
	 * @param bool $nav
	 * @return array
	 */
	private static function getOffers($type, $bitrixFilter, $sort = [], $nav = false)
	{
		$return = [];

		$select = [
			'ID',
			'NAME',
			'CODE',
			'IBLOCK_ID',
			'PROPERTY_SECTION',
			'PROPERTY_BRAND',
			'PROPERTY_COUNTRY',
			'PROPERTY_WOOD',
			'PROPERTY_COLOR',
			'PROPERTY_PROTECTION',
			'PROPERTY_PRICE',
			'PROPERTY_PRICE_P',
			'PROPERTY_PRODUCT',
		];
		$flagsSelect = Flags::getForSelect();
		$select = array_merge($select, $flagsSelect);
		$codes = Flags::getCodes();

		if ($type > 0)
		{
			$select = array_merge($select, [
				'PREVIEW_PICTURE',
				'DETAIL_PICTURE',
				'PROPERTY_RATING',
				'PROPERTY_UNIT',
				'PROPERTY_INPACK',
			]);
		}
		if ($type > 1)
		{
			$select = array_merge($select, [
				'DETAIL_TEXT',
				'PROPERTY_ARTICLE',
				'PROPERTY_COATING',
				'PROPERTY_DIM',
				'PROPERTY_JSON',
			]);
		}

		$iblockElement = new \CIBlockElement();
		$rsItems = $iblockElement->GetList($sort, $bitrixFilter, false, $nav, $select);
		while ($item = $rsItems->GetNext())
		{
			$id = intval($item['ID']);
			$sectionId = intval($item['PROPERTY_SECTION_VALUE']);
			$fields = [
				'SECTION' => $sectionId,
				'PRICE' => intval($item['PROPERTY_PRICE_VALUE']),
				'BRAND' => intval($item['PROPERTY_BRAND_VALUE']),
				'COUNTRY' => intval($item['PROPERTY_COUNTRY_VALUE']),
				'WOOD' => intval($item['PROPERTY_WOOD_VALUE']),
				'COLOR' => intval($item['PROPERTY_COLOR_VALUE']),
				'PROTECTION' => intval($item['PROPERTY_PROTECTION_VALUE']),
			];
			foreach ($codes as $code)
				$fields['FLAGS'][$code] = intval($item['PROPERTY_' . $code . '_VALUE']);

			if ($type > 0)
			{
				$section = Section::getById($sectionId);
				$fields['DETAIL_PAGE_URL'] = self::getDetailUrl($item, $section['CODE']);
				$fields['ID'] = $id;
				$fields['NAME'] = $item['NAME'];
				$fields['PRICE_P'] = intval($item['PROPERTY_PRICE_P_VALUE']);
				$fields['PRODUCT'] = intval($item['PROPERTY_PRODUCT_VALUE']);
				$fields['RATING'] = intval($item['PROPERTY_RATING_VALUE']);
				$fields['UNIT'] = intval($item['PROPERTY_UNIT_VALUE']);
				$fields['INPACK'] = floatval($item['PROPERTY_INPACK_VALUE']);
				$fields['PREVIEW_PICTURE'] = $item['PREVIEW_PICTURE'];
				$fields['DETAIL_PICTURE'] = $item['DETAIL_PICTURE'];
			}
			if ($type > 1)
			{
				$fields['DETAIL_TEXT'] = $item['~DETAIL_TEXT'];
				$fields['ARTICLE'] = $item['PROPERTY_ARTICLE_VALUE'];
				$fields['COATING'] = $item['PROPERTY_COATING_VALUE'];
				$fields['DIM'] = $item['PROPERTY_DIM_VALUE'];
				$fields['PROPS'] = json_decode($item['~PROPERTY_JSON_VALUE'], true);
			}

			$return['ITEMS'][$id] = $fields;
		}

		if ($type == 1)
		{
			$return['NAV'] = [
				'COUNT' => $rsItems->NavRecordCount,
				'PAGE' => $rsItems->NavPageNomer,
			];
		}

		return $return;
	}

	/**
	 * Возвращает товары по фильтру
	 * @param $type
	 * @param $sort
	 * @param $filter
	 * @param $nav
	 * @param array|bool $refreshCache
	 * @return array
	 */
	public static function get($type, $filter, $sort = ['PROPERTY_PRICE' => 'asc'], $nav = false,
	                           $refreshCache = false)
	{
		$extCache = new ExtCache(
			[
				__FUNCTION__,
				$type,
				$filter,
				$sort,
				$nav,
			],
			static::CACHE_PATH . __FUNCTION__ . '/',
			static::CACHE_TIME,
			false
		);
		if (!$refreshCache && $extCache->initCache())
		{
			$return = $extCache->getVars();
		}
		else
		{
			$extCache->startDataCache();

			$bitrixFilter = [
				'IBLOCK_ID' => self::IBLOCK_ID,
				'ACTIVE' => 'Y',
				'!PROPERTY_PRODUCT' => false,
			];
			$codes = Flags::getCodes();
			foreach ($filter as $k => $v)
			{
				if ($k == 'CATEGORY')
				{
					$v = Section::getChildrenFilter($v);
					$bitrixFilter['PROPERTY_SECTION'] = $v;
				}
				elseif ($k == 'COLOR')
				{
					$bitrixFilter['PROPERTY_COLOR'] = $v;
				}
				elseif ($k == 'BRAND')
				{
					$bitrixFilter['PROPERTY_BRAND'] = $v;
				}
				elseif ($k == 'COUNTRY')
				{
					$bitrixFilter['PROPERTY_COUNTRY'] = $v;
				}
				elseif ($k == 'WOOD')
				{
					$bitrixFilter['PROPERTY_WOOD'] = $v;
				}
				elseif ($k == 'PROTECTION')
				{
					$bitrixFilter['PROPERTY_PROTECTION'] = $v;
				}
				elseif ($k == 'ID')
				{
					$bitrixFilter['ID'] = $v;
				}
				elseif ($k == 'PRICE')
				{
					if (isset($v['FROM']))
						$bitrixFilter['>=PROPERTY_PRICE'] = $v['FROM'];
					if (isset($v['TO']))
						$bitrixFilter['<=PROPERTY_PRICE'] = $v['TO'];
				}
				else
				{
					foreach ($codes as $code)
						if ($k == $code)
							$bitrixFilter['=PROPERTY_' . $code] = 1;
				}
			}

			// В случае поиска - ручная пагинация
			$manualSort = false;
			$nav_ = [];
			if ($sort['SEARCH'] == 'asc' && $nav)
			{
				$nav_ = $nav;
				$nav = false;
				$manualSort = true;
				$sort = [];
			}

			if (!$manualSort && !isset($sort['ID']))
				$sort['ID'] = 'DESC';

			// Товары
			$return = self::getOffers($type, $bitrixFilter, $sort, $nav);

			// Восстановление сортировки
			if ($manualSort)
			{
				$productIds = $filter['ID'];
				$items = [];
				foreach ($productIds as $id)
				{
					if ($return['ITEMS'][$id])
						$items[$id] = $return['ITEMS'][$id];
				}
				$l = $nav_['nPageSize'];
				$offset = ($nav_['iNumPage'] - 1) * $l;
				$return['ITEMS'] = array_slice($items, $offset, $l);

				$return['NAV'] = [
					'COUNT' => count($items),
					'PAGE' => $nav_['iNumPage'],
				];
			}

			$extCache->endDataCache($return);
		}

		return $return;
	}

	/**
	 * Возвращает ID элемента по коду
	 * @param $code
	 * @param bool|false $refreshCache
	 * @return int|mixed
	 */
	public static function getIdByCode($code, $refreshCache = false)
	{
		$return = 0;

		$extCache = new ExtCache(
			[
				__FUNCTION__,
				$code,
			],
			static::CACHE_PATH . __FUNCTION__ . '/',
			static::CACHE_TIME
		);
		if (!$refreshCache && $extCache->initCache())
		{
			$return = $extCache->getVars();
		}
		else
		{
			$extCache->startDataCache();

			$iblockElement = new \CIBlockElement();
			$rsItems = $iblockElement->GetList([], [
				'IBLOCK_ID' => self::IBLOCK_ID,
				'=CODE' => $code,
			], false, false, ['ID']);
			if ($item = $rsItems->Fetch())
			{
				$return = $item['ID'];
				$extCache->endDataCache($return);
			}
			else
				$extCache->abortDataCache();
		}

		return $return;
	}

	/**
	 * Возвращает карточку по коду
	 * @param $code
	 * @param bool|false $refreshCache
	 * @return array|mixed
	 */
	public static function getByCode($code, $refreshCache = false)
	{
		$id = self::getIdByCode($code, $refreshCache);
		if ($id)
			return self::getById($id, $refreshCache);
		else
			return [];
	}

	/**
	 * Возвращает url карточки
	 * @param $item
	 * @param $category
	 * @return string
	 */
	public static function getDetailUrl($item, $category)
	{
		return CATALOG_PATH . $category . '/' . $item['ID'] . '/';
	}

	/**
	 * Возвращает карточку по ID
	 * @param int $id
	 * @param bool|false $refreshCache
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
			static::CACHE_TIME
		);
		if (!$refreshCache && $extCache->initCache())
		{
			$return = $extCache->getVars();
		}
		else
		{
			$extCache->startDataCache();

			$res = self::getOffers(2, [
				'ID' => $id,
				'IBLOCK_ID' => self::IBLOCK_ID
			]);
			if ($res['ITEMS'][$id])
			{
				$return = $res['ITEMS'][$id];
				$return['PRODUCT'] = Product::getById($return['PRODUCT']);
				$extCache->endDataCache($return);
			}
			else
				$extCache->abortDataCache();

		}

		return $return;
	}

	/**
	 * Увеличивает счетчик просмотра
	 * @param $offerId
	 */
	public static function viewedCounters($offerId)
	{
		\CIBlockElement::CounterInc($offerId);
	}

	/**
	 * Корректирует значения свойств, предложения зависящих от товара
	 * @param $id
	 * @param $offer
	 * @param $product
	 */
	public static function correctProductFields($id, $offer, $product)
	{
		$update = [];
		if ($offer['BRAND'] != $product['BRAND'])
			$update['BRAND'] = $product['BRAND'];
		if ($offer['COUNTRY'] != $product['COUNTRY'])
			$update['COUNTRY'] = $product['COUNTRY'];
		if ($offer['WOOD'] != $product['WOOD'])
			$update['WOOD'] = $product['WOOD'];
		if ($offer['COLOR'] != $product['COLOR'])
			$update['COLOR'] = $product['COLOR'];

		if ($update)
		{
			$iblockElement = new \CIBlockElement();
			$iblockElement->SetPropertyValuesEx($id, Offer::IBLOCK_ID, $update);
		}
	}

	/**
	 * Возвращает предложения для заданного товара
	 * @param $productId
	 * @return array
	 */
	public static function getByProduct($productId)
	{
		$res = self::getOffers(0, [
			'IBLOCK_ID' => self::IBLOCK_ID,
			'=PROPERTY_PRODUCT' => $productId,
		]);
		return $res['ITEMS'];
	}

	/**
	 * Обработчик изменения элемента - нужно обновить поля товара
	 * @param $id
	 */
	public static function afterUpdate($id)
	{
		$res = self::getOffers(2, [
			'ID' => $id,
			'IBLOCK_ID' => self::IBLOCK_ID
		]);
		$offer = $res['ITEMS'][$id];
		if ($offer)
		{
			$product = Product::getById($offer['PRODUCT']);
			if ($product)
				self::correctProductFields($id, $offer, $product);
		}
	}

	/**
	 * Формирует поисковый контент для предложения
	 * @param $arFields
	 * @return mixed
	 */
	public static function beforeSearchIndex($arFields)
	{
		$offerId = intval($arFields['ITEM_ID']);
		if ($offerId && array_key_exists('BODY', $arFields))
		{
			$offer = self::getById($offerId);
			if ($offer)
			{
				$title = '';
				$text = '';

				$sections = Section::getChain($offer['SECTION']);
				foreach ($sections as $i => $section)
					if ($i)
						$title .= $section['NAME'] . ' ';
				$brand = Brand::getById($offer['BRAND']);
				$title .= $brand['NAME'] . ' ';
				$country = Country::getById($offer['COUNTRY']);
				$text .= $country['NAME'] . ' ';
				$wood = Wood::getById($offer['WOOD']);
				$text .= $wood['NAME'] . ' ';
				$text .= $offer['ARTICLE'] . ' ';
				$coating = Coating::getById($offer['COATING']);
				$text .= $coating['NAME'] . ' ';
				$text .= $offer['DIM'] . ' ';

				$arFields['TITLE'] = $title;
				$arFields['BODY'] = $text;
			}
		}

		return $arFields;
	}

	public static function printQuickPopup($offer)
	{
		$img = \CFile::GetFileArray($offer['PREVIEW_PICTURE']);
		$price = number_format($offer['PRICE'], 0, '', ' ');
		$unit = Unit::getById($offer['UNIT']);
		$forUnit = '';
		$labelUnit = '';
		if ($unit['SHOW'])
		{
			$forUnit = '/' . $unit['NAME'];
			if ($offer['INPACK'] != 1)
				$labelUnit = $unit['NAME'];
		}
		$qnt = '';
		if ($offer['INPACK'] != 1)
			$qnt = $offer['INPACK'];

		$order_name = '';
		$order_phone = '';
		$user = User::getCurrentUser();
		if ($user)
		{
			$order_name = $user['NAME'];
			$order_phone = $user['PHONE'];
		}

		?>
		<div class="engFormPopup zwhite-popup" id="elFormOneClick_<?= $offer['ID'] ?>">
			<form class="oneclick-form">
				<input type="hidden" name="id" value="<?= $offer['ID'] ?>">
				<div class="elOrderPopup-pole">
					<div class="it-block">
						<div class="it-title">Имя*</div>
						<input name="order_name" type="text" placeholder="Ваше Имя" value="<?= $order_name ?>" required title="Ваше Имя">
					</div>
					<div class="it-block">
						<div class="it-title">Телефон*</div>
						<input name="order_phone" type="text" placeholder="Ваш телефон" value="<?= $order_phone ?>" required title="Ваш телефон">
					</div>
				</div>
				<div class="commerce">
					<table id="cart" class="table shop_table cart">
						<thead>
						<tr>
							<th class="product-thumbnail hidden-xs">&nbsp;</th>
							<th class="product-name">Название</th>
							<th class="product-price text-center">Цена</th>
							<th class="product-quantity text-center">Количество</th>
							<th class="product-subtotal text-center hidden-xs">Сумма</th>
						</tr>
						</thead>
						<tbody>
						<tr class="cart_item" data-id="18">
							<td class="product-thumbnail hidden-xs">
								<img width="<?= $img['WIDTH'] ?>" height="<?= $img['HEIGHT'] ?>"
									 src="<?= $img['SRC'] ?>" alt="<?= $offer['NAME'] ?>"/>
							</td>
							<td class="product-name">
								<?= $offer['NAME'] ?>
							</td>
							<td class="product-price text-center">
								<span class="amount"><?= $price ?> руб.<?= $forUnit ?></span>
							</td>
							<td class="product-quantity text-center">
								<div class="quantity"><?

									if ($unit['SHOW'])
									{
										?>
                                        <input type="number" step="1" min="0" name="qnt"
                                               value="<?= floor($offer['INPACK']) ?>" title="Количество, <?= $labelUnit ?>"
                                               class="input-text qty text" size="4" data-price="<?= $offer['PRICE'] ?>"/><?
									}

									?>
									<input type="number" step="1" min="0" name="cnt" data-price="<?= $offer['PRICE'] ?>"
										   value="1" title="Количество упаковок" class="input-text qty text"
										   size="4"/>
									<span class="amount js-qnt" data-inpack="<?= $offer['INPACK'] ?>"><?= $qnt ?></span> <?= $labelUnit ?>
								</div>
							</td>
							<td class="product-subtotal hidden-xs text-center">
								<span class="amount js-total"><?= $price ?></span> руб.
							</td>
						</tr>
					</table>
					<div class="cart-collaterals">
						<div class="cart_totals">
							<div class="wc-proceed-to-checkout">
								<button type="submit" class="checkout-button button alt wc-forward rounded">Оформить заказ</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<?
	}

}
