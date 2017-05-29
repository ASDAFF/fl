<?
/** @var CMain $APPLICATION */

define('CART_PAGE', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");

$APPLICATION->IncludeComponent('tim:empty', 'order');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");