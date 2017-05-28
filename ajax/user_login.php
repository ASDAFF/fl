<?
/** @global CMain $APPLICATION */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$u = new \CUser();
$result = $u->Login($_REQUEST['login'], $_REQUEST['pwd'], $_REQUEST['rememberme'] == 'on' ? 'Y' : 'N');

header('Content-Type: application/json');
echo json_encode($result);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");