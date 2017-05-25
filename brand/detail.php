<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Производители");

$APPLICATION->IncludeComponent('tim:empty', 'brand.detail');

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
