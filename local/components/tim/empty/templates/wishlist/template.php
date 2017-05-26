<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$list = \Local\Sale\Wish::get();

if (!$list['ITEMS'])
{
	?>
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="commerce">
                <p class="cart-empty">Список избранного пуст.</p>
                <p class="return-to-shop"><a class="button wc-backward rounded" href="<?= CATALOG_PATH ?>">В каталог</a>
                </p>
            </div>
        </div>
    </div>
    </div><?

	return;
}

?>
    <div class="container">
    <div class="row">
        <div class="col-xs-12">
            <form class="commerce">
                <table class="shop_table cart wishlist_table">
                    <thead>
                    <tr>
                        <th class="product-thumbnail"></th>
                        <th class="product-name"><span class="nobr">Название</span></th>
                        <th class="product-price"><span class="nobr">Цена</span></th>
                        <th class="product-add-to-cart"></th>
                        <th class="product-remove"></th>
                    </tr>
                    </thead>
                    <tbody><?

					$file = new \CFile();
					foreach ($list['ITEMS'] as $item)
					{
						$offer = \Local\Catalog\Offer::getById($item['OFFER']);
						$img = $file->GetFileArray($offer['PREVIEW_PICTURE']);
						$price = number_format($item['PRICE'], 0, '', ' ');
						?>
                    <tr data-id="<?= $item['ID'] ?>">

                        <td class="product-thumbnail">
                            <a href="<?= $offer['DETAIL_PAGE_URL'] ?>">
                                <img width="<?= $img['WIDTH'] ?>" height="<?= $img['HEIGHT'] ?>"
                                     src="<?= $img['SRC'] ?>" alt="<?= $offer['NAME'] ?>"/>
                            </a>
                        </td>
                        <td class="product-name">
                            <a href="<?= $offer['DETAIL_PAGE_URL'] ?>"><?= $offer['NAME'] ?></a>
                        </td>
                        <td class="product-price">
                            <span class="amount"><?= $price ?> руб.</span>
                        </td>
                        <td class="product-add-to-cart">
                            <a href="#" class="add_to_cart_button button rounded">В корзину</a>
                        </td>
                        <td class="product-remove">
                            <a href="#" class="remove remove_from_wishlist">&times;</a>
                        </td>
                        </tr><?
					}

					?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="6">&nbsp;</td>
                    </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    </div><?
