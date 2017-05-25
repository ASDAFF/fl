<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$cart = \Local\Sale\Cart::getCart();

?>
<div class="minicart-side-title">
	<h4>Корзина</h4>
</div>
<div class="minicart-side-content">
	<div class="minicart"><?

		if (!$cart['COUNT'])
		{
			?>
			<div class="minicart-header no-items show">
				Ваша корзина пуста
			</div>
			<div class="minicart-footer">
				<div class="minicart-actions clearfix">
					<a class="button no-item-button" href="<?= CATALOG_PATH ?>">
						<span class="text">Перейти в каталог</span>
					</a>
				</div>
			</div><?
		}
		else
		{
			$pos = \Local\System\Utils::cardinalNumberRus($cart['COUNT'], 'позиций', 'позиция', 'позиции');
			?>
			<div class="minicart-header">
				<?= $cart['COUNT'] ?> <?= $pos ?> в корзине
			</div>
			<div class="minicart-body"><?

				$file = new \CFile();
				foreach ($cart['ITEMS'] as $item)
				{
					$offer = \Local\Catalog\Offer::getById($item['OFFER']);
					$img = $file->GetFileArray($offer['PREVIEW_PICTURE']);
					$price = number_format($item['PRICE'], 0, '', ' ');
					?>
					<div class="cart-product clearfix">
						<div class="cart-product-image">
							<a class="cart-product-img" href="#">
								<img width="<?= $img['WIDTH'] ?>" height="<?= $img['HEIGHT'] ?>"
								     src="<?= $img['SRC'] ?>" alt="<?= $offer['NAME'] ?>" />
							</a>
						</div>
						<div class="cart-product-details">
							<div class="cart-product-title">
								<a href="<?= $offer['DETAIL_PAGE_URL'] ?>"><?= $offer['NAME'] ?></a>
							</div>
							<div class="cart-product-quantity-price">
								<?= $item['QUANTITY'] ?> x <span class="amount"><?= $price ?> руб.</span>
							</div>
						</div>
						<span class="remove" data-id="<?= $item['ID'] ?>" title="Удалить">&times;</span>
					</div><?
				}

				$price = number_format($cart['PRICE'], 0, '', ' ');
				?>
			</div>
			<div class="minicart-footer">
				<div class="minicart-total">
					Сумма <span class="amount"><?= $price ?> руб.</span>
				</div>
				<div class="minicart-actions clearfix">
					<a class="viewcart-button button" href="/personal/cart/">
						<span class="text">В корзину</span>
					</a>
					<a class="checkout-button button" href="/personal/order/">
						<span class="text">Оформить заказ</span>
					</a>
				</div>
			</div><?
		}

		?>
	</div>
</div>
