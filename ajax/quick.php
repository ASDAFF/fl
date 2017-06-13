<?
/** @global CMain $APPLICATION */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$result = array();

$user =
	\Local\System\User::checkQuickOrder($_REQUEST['order_name'], $_REQUEST['order_phone']);
if ($user['ID'])
{
	$orderId = \Local\Sale\Order::createQuick($_REQUEST['id'], $_REQUEST['quantity'], $user);
	$result['ID'] = $orderId;
}

header('Content-Type: application/json');
echo json_encode($result);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");