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