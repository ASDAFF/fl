<?
/** @global CMain $APPLICATION */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$result = array();

// Добавление в корзину
if ($_REQUEST['action'] == 'add')
{
	$id = \Local\Sale\Cart::add($_REQUEST['id'], $_REQUEST['cnt']);
	$result['ID'] = intval($id);
}
// Удаление из корзины
elseif ($_REQUEST['action'] == 'remove')
{
	$res = \Local\Sale\Cart::delete($_REQUEST['id']);
	$result['SUCCESS'] = $res ? 1 : 0;
}
// Количество
elseif ($_REQUEST['action'] == 'cnt')
{
	$res = \Local\Sale\Cart::updateCnt($_REQUEST['id'], $_REQUEST['cnt']);
	$result['SUCCESS'] = $res ? 1 : 0;
}

$cartSummary = \Local\Sale\Cart::getSummary();
$result['CART'] = $cartSummary;

ob_start();
$APPLICATION->IncludeComponent('tim:empty', 'minicart');
$html = ob_get_contents();
ob_end_clean();
$result['MINI'] = $html;

header('Content-Type: application/json');
echo json_encode($result);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");