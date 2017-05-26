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
			AddEventHandler('iblock', 'OnAfterIBlockElementUpdate',
				[__NAMESPACE__ . '\Handlers', 'afterElementUpdate']);
			AddEventHandler('iblock', 'OnAfterIBlockElementAdd',
				[__NAMESPACE__ . '\Handlers', 'afterElementAdd']);
			AddEventHandler('main', 'OnAfterUserLogout',
				array(__NAMESPACE__ . '\Handlers', 'afterUserLogout'));
			AddEventHandler('main', 'OnAfterUserLogin',
				array(__NAMESPACE__ . '\Handlers', 'afterUserLogin'));
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
	 * обработчик добавления элемента
	 * @param $arFields
	 */
	public static function afterElementAdd($arFields)
	{
		if ($arFields['IBLOCK_ID'] == Offer::IBLOCK_ID)
			Offer::afterUpdate($arFields['ID']);
	}

	/**
	 * обработчик изменения элемента
	 * @param $arFields
	 */
	public static function afterElementUpdate($arFields)
	{
		if ($arFields['IBLOCK_ID'] == Product::IBLOCK_ID)
			Product::correctOfferFields($arFields['ID']);
		elseif ($arFields['IBLOCK_ID'] == Offer::IBLOCK_ID)
			Offer::afterUpdate($arFields['ID']);
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

}