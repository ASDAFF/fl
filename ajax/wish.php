<?
/** @global CMain $APPLICATION */
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$result = array();

// Добавление
if ($_REQUEST['action'] == 'add')
{
	$id = \Local\Sale\Wish::add($_REQUEST['id']);
	$result['ID'] = intval($id);
	$result['IN'] = $id ? true : false;
}
// Удаление
elseif ($_REQUEST['action'] == 'remove')
{
	$res = \Local\Sale\Wish::delete($_REQUEST['cid']);
	$result['IN'] = $res ? false : true;
}
// В корзину
elseif ($_REQUEST['action'] == 'cart')
{
	$res = \Local\Sale\Wish::cart($_REQUEST['cid']);
	$result['IN'] = $res ? false : true;

	$cartSummary = \Local\Sale\Cart::getSummary();
	$result['CART'] = $cartSummary;

	ob_start();
	$APPLICATION->IncludeComponent('tim:empty', 'minicart');
	$html = ob_get_contents();
	ob_end_clean();
	$result['MINI'] = $html;
}

header('Content-Type: application/json');
echo json_encode($result);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");