<?
namespace Local\System;
use Local\Catalog\Offer;
use Local\Catalog\Product;
use Local\Sale\Cart;
use Local\Sale\Wish;

/**
 * Class Handlers Обработчики событий
 * @package Local\Utils
 */
class Handlers
{
	/**
	 * Добавление обработчиков
	 */
	public static function addEventHandlers() {
		static $added = false;
		if (!$added) {
			$added = true;
			AddEventHandler('iblock', 'OnIBlockPropertyBuildList',
				[__NAMESPACE__ . '\Handlers', 'addYesNo']);
			AddEventHandler('catalog', 'OnDiscountAdd',
				array(__NAMESPACE__ . '\Handlers', 'discountAdd'));
			AddEventHandler('catalog', 'OnDiscountUpdate',
				array(__NAMESPACE__ . '\Handlers', 'discountUpdate'));
			AddEventHandler('catalog', 'OnDiscountDelete',
				array(__NAMESPACE__ . '\Handlers', 'discountDelete'));
			AddEventHandler('catalog', 'OnPriceAdd',
				array(__NAMESPACE__ . '\Handlers', 'priceAdd'));
			AddEventHandler('catalog', 'OnPriceUpdate',
				array(__NAMESPACE__ . '\Handlers', 'priceUpdate'));
			AddEventHandler('iblock', 'OnAfterIBlockElementUpdate',
				array(__NAMESPACE__ . '\Handlers', 'afterElementUpdate'));
			AddEventHandler('main', 'OnAfterUserLogout',
				array(__NAMESPACE__ . '\Handlers', 'afterUserLogout'));
			AddEventHandler('main', 'OnAfterUserLogin',
				array(__NAMESPACE__ . '\Handlers', 'afterUserLogin'));
			AddEventHandler('search', 'BeforeIndex',
				array(__NAMESPACE__ . '\Handlers', 'beforeSearchIndex'));
		}
	}

	/**
	 * Добавление пользовательских свойств
	 * @return array
	 */
	public static function addYesNo()
	{
		return UserTypeNYesNo::GetUserTypeDescription();
	}

	/**
	 * Корректировка цен товаров после добавления, редактирования или удаления скидок
	 */
	public static function discountAdd() {
		Offer::setSortPriceAllProducts();
	}
	public static function discountUpdate() {
		Offer::setSortPriceAllProducts();
	}
	public static function discountDelete() {
		Offer::setSortPriceAllProducts();
	}

	/**
	 * Обработчик добавления цены
	 * @param $ID
	 * @param $fields
	 */
	public static function priceAdd(/** @noinspection PhpUnusedParameterInspection */$ID, $fields) {
		if ($fields['PRODUCT_ID'])
			Offer::priceChange($fields['PRODUCT_ID']);
	}

	/**
	 * Обрабочик изменения цены
	 * @param $ID
	 * @param $fields
	 */
	public static function priceUpdate(/** @noinspection PhpUnusedParameterInspection */$ID, $fields) {
		if ($fields['PRODUCT_ID'])
			Offer::priceChange($fields['PRODUCT_ID']);
	}

	/**
	 * обработчик изменения элемента
	 * @param $arFields
	 */
	public static function afterElementUpdate($arFields) {
		// нужно обновить цену товара (вдруг ее вручную кто-то поменял)
		if ($arFields['IBLOCK_ID'] == Offer::IBLOCK_ID)
			Offer::priceChange($arFields['ID']);
	}

	/**
	 * Сбрасываем кеш корзины после логаута пользователя
	 */
	public static function afterUserLogout()
	{
		Cart::updateSessionCartSummary();
		Wish::updateSession();
	}

	/**
	 * Сбрасываем кеш корзины после логина пользователя
	 */
	public static function afterUserLogin()
	{
		Cart::updateSessionCartSummary();
		Wish::updateSession();
	}

	/**
	 * Формируем поисковый контент
	 * @param $arFields
	 * @return mixed
	 */
	public static function beforeSearchIndex($arFields)
	{
		if ($arFields['MODULE_ID'] == 'iblock' && $arFields['PARAM2'] == Offer::IBLOCK_ID)
			$arFields = Offer::beforeSearchIndex($arFields);

		return $arFields;
	}

}