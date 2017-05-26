<?
namespace Local\Sale;

use Bitrix\Main\Loader;
use Local\Catalog\Offer;

/**
 * Class Wish Избранное
 * @package Local\Sale
 */
class Wish
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Sale/Wish/';

	/**
	 * Возвращает избранное текущего пользователя
	 * @return array
	 * @throws \Bitrix\Main\LoaderException
	 */
	public static function get()
	{
		$return = [
			'ITEMS' => [],
		];
		Loader::IncludeModule('sale');

		$basket = new \CSaleBasket();
		$basket->Init();
		$filter = [
			'ORDER_ID' => 'NULL',
			'FUSER_ID' => $basket->GetBasketUserID(),
			'DELAY' => 'Y',
		];
		$rsCart = $basket->GetList([], $filter);
		$ids = [];
		while ($item = $rsCart->Fetch())
		{
			$id = intval($item['ID']);
			$price = intval($item['PRICE']);
			$return['ITEMS'][$id] = [
				'ID' => $id,
				'PRICE' => $price,
				'OFFER' => $item['PRODUCT_ID'],
			];

			$ids[] = $id;
		}

		if ($ids)
		{
			$rsProps = $basket->GetPropsList([], ["@BASKET_ID" => $ids]);
			while ($prop = $rsProps->Fetch())
			{
				$id = $prop['BASKET_ID'];
				$return['ITEMS'][$id]['PROPS'][$prop['CODE']] = $prop['VALUE'];
			}
		}

		return $return;
	}

	/**
	 * Возвращает список товаров избранного
	 */
	public static function getDB()
	{
		$return = [];
		$list = self::get();
		foreach ($list['ITEMS'] as $item)
			$return[$item['OFFER']] = $item['ID'];

		return $return;
	}

	/**
	 * Обновляет избренное
	 */
	public static function updateSession()
	{
		$_SESSION['WISHLIST'] = self::getDB();
	}

	/**
	 * Возвращает список товаров избранного
	 */
	public static function getSummary()
	{
		Loader::IncludeModule('sale');

		if (!isset($_SESSION['WISHLIST']))
			self::updateSession();

		return $_SESSION['WISHLIST'];
	}

	/**
	 * Есть ли товар в списке?
	 * @param $offerId
	 * @return bool
	 */
	public static function getCartId($offerId)
	{
		$list = self::getSummary();
		return intval($list[$offerId]);
	}

	/**
	 * Добавление предложения в избранное
	 * @param $offerId
	 * @return bool|int
	 */
	public static function add($offerId)
	{

		$offerId = intval($offerId);
		if ($offerId <= 0)
			return false;

		$offer = Offer::getById($offerId);
		if (!$offer)
			return false;

		Loader::IncludeModule('sale');

		$props = [];
		$fields = [
			'PRODUCT_ID' => $offerId,
			'PRICE' => $offer['PRICE'],
			'CURRENCY' => 'RUB',
			'QUANTITY' => 1,
			'LID' => SITE_ID,
			'DELAY' => 'Y',
			'CAN_BUY' => 'Y',
			'NAME' => $offer['NAME'],
			'MODULE' => 'main',
			'DETAIL_PAGE_URL' => $offer['DETAIL_PAGE_URL'],
			'PROPS' => $props,
		];

		$basket = new \CSaleBasket();
		$cartId = $basket->Add($fields);

		if ($cartId)
			self::updateSession();

		return $cartId;
	}

	/**
	 * Удаление товара из избранного
	 * @param $cartId
	 * @return bool|int
	 */
	public static function delete($cartId)
	{
		Loader::IncludeModule('sale');

		$basket = new \CSaleBasket();
		$return = $basket->delete($cartId);

		if ($return)
			self::updateSession();

		return $return;
	}

	/**
	 * Перевод из избранного в корзину
	 * @param $cartId
	 * @return bool
	 * @throws \Bitrix\Main\LoaderException
	 */
	public static function cart($cartId)
	{
		Loader::IncludeModule('sale');

		$basket = new \CSaleBasket();
		$return = $basket->Update($cartId, ['DELAY' => 'N']);

		if ($return)
		{
			self::updateSession();
			Cart::updateSessionCartSummary();
		}

		return $return;
	}

}