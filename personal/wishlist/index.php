<?
/** @var CMain $APPLICATION */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Избранное");

$APPLICATION->IncludeComponent('tim:empty', 'wishlist');

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");