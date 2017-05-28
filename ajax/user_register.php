<?
/** @global CMain $APPLICATION */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$u = new \CUser();
$result = $u->Register(
	$_REQUEST['user_email'],
		'',
		'',
	$_REQUEST['user_password'],
	$_REQUEST['cuser_password'],
	$_REQUEST['user_email']);

header('Content-Type: application/json');
echo json_encode($result);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");