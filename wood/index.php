<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Породы дерева");

$APPLICATION->IncludeComponent('tim:empty', 'wood.list');

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");