<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Производители");

$APPLICATION->IncludeComponent('tim:empty', 'wood.detail');

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");