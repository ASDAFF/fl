<?
/** @var CMain $APPLICATION */

define('CART_PAGE', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");

$APPLICATION->IncludeComponent('tim:empty', 'cart');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");