<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var CMain $APPLICATION */

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="main-content">
                <div class="commerce"><?

if ($_REQUEST['id'])
{
    ?>
    <p>Заказ №<?= $_REQUEST['id'] ?></p>
    <p>Спасибо, Ваш заказ оформлен!</p>
    <p>Скоро с Вами свяжется наш менеджер для уточнения всех деталей</p><?

	$APPLICATION->SetTitle("Заказ оформлен");

	//set ecommerce
	\WM\Seo\ECommerce::get()->setIblockId(1)->load((int) $_REQUEST['id'])->setViewContent();
}
else
{

	$cart = \Local\Sale\Cart::getCart();

	$notEmpty = $cart['COUNT'] > 0;

	if ($notEmpty && isset($_POST['order_create']))
	{
		$user =
			\Local\System\User::checkOrder($_REQUEST['order_name'], $_REQUEST['order_email'], $_REQUEST['order_phone'],
				$_REQUEST['order_address']);
				debugmessage($user);
		if ($user['ID'])
		{
			$orderId = \Local\Sale\Order::create($cart, $user);
			debugmessage($user);
			if ($orderId)
				LocalRedirect('/personal/order/?id=' . $orderId);
		}
	}

	$price = number_format($cart['PRICE'], 0, '', ' ');
	$deliveryPrice = 0;
	$total = number_format($cart['PRICE'] + $deliveryPrice, 0, '', ' ');

	$order_name = $_REQUEST['order_name'];
	$order_email = $_REQUEST['order_email'];
	$order_address = $_REQUEST['order_address'];
	$order_phone = $_REQUEST['order_phone'];

	$user = \Local\System\User::getCurrentUser();
	if ($user)
	{
		if (!$order_name)
			$order_name = $user['NAME'];
		if (!$order_email)
			$order_email = $user['EMAIL'];
		if (!$order_phone)
			$order_phone = $user['PHONE'];
		if (!$order_address)
			$order_address = $user['ADDRESS'];
	}

	?>
    <div class="cart-collaterals">
    <div class="cart_totals">
        <h2>Итого по корзине</h2>
        <table>
            <tr class="cart-subtotal">
                <th>Товары</th>
                <td><span class="amount js-cart-price"><?= $price ?></span> руб.</td>
            </tr>
            <tr class="shipping">
                <th>Доставка</th>
                <td><span class="amount">0</span></td>
            </tr>
            <tr class="order-total">
                <th>Итого</th>
                <td><strong><span class="amount js-cart-total"><?= $total ?></span> руб.</strong></td>
            </tr>
        </table>
    </div>
    <div class="cross-sells">
        <h2>Данные покупателя</h2>
        <form action="/personal/order/" method="post">
            <div class="wpcf7-form-control-wrap name">
                <input type="text" size="40" class="wpcf7-form-control"
                       name="order_name" value="<?= $order_name ?>" placeholder="Имя"/>
            </div>
            <div class="wpcf7-form-control-wrap email">
                <input type="email" size="40" class="wpcf7-form-control"
                       name="order_email" value="<?= $order_email ?>" placeholder="Email"/>
            </div>
            <div class="wpcf7-form-control-wrap phone">
                <input type="text" size="40" class="wpcf7-form-control"
                       name="order_phone" value="<?= $order_phone ?>" placeholder="Телефон"/>
            </div>
            <div class="wpcf7-form-control-wrap">
                <input type="submit" class="wpcf7-form-control wpcf7-submit rounded"
                       name="order_create" value="Оформить заказ"/>
            </div>
        </form>
    </div>
    </div><?
}

?>
</div>
</div>
</div>
</div>
</div><?