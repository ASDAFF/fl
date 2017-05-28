<?
/** @global CMain $APPLICATION */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$result = \Local\System\User::forgotPwd($_REQUEST['user_login']);

header('Content-Type: application/json');
echo json_encode($result);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");