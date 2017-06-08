<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */

$user = new \CUser();
$isAdmin = $user->IsAdmin();

$offer = $arParams['OFFER'];

$sectionId = $offer['SECTION'];
$navParams = array(
	'iNumPage' => 1,
	'nPageSize' => 12,
);
$items = \Local\Catalog\Offer::get(1, ['HIT' => true], ['PROPERTY_RATING' => 'desc'], $navParams);

if (!count($items['ITEMS']))
    return;

?>
<div class="caroufredsel product-slider nav-position-center" data-height="variable" data-visible-min="1"
     data-responsive="1" data-infinite="1" data-autoplay="0">
    <div class="product-slider-title">
        <h3 class="el-heading">Хиты</h3>
    </div>
    <div class="caroufredsel-wrap">
        <div class="commerce columns-4">
            <ul class="products columns-4" data-columns="4"><?

                $file = new \CFile();
                $cnt = 0;
                foreach ($items['ITEMS'] as $item)
                {
                    if ($item['ID'] == $offer['ID'])
                        break;

                    $img1 = $file->GetFileArray($item['PREVIEW_PICTURE']);
                    $img2 = $file->GetFileArray($item['DETAIL_PICTURE']);
                    $rating = $item['RATING'] ? $item['RATING'] : 60;
					$price = number_format($item['PRICE'], 0, '', ' ');
					$pPrice = '';
					if ($isAdmin && $item['PRICE_P'])
					{
						$pPrice = number_format($item['PRICE_P'], 0, '', ' ');
						$pPrice = ' (' . $pPrice . ' руб.)';
					}
					$wishCartId = \Local\Sale\Wish::getCartId($item['ID']);
					$wlAdded = $wishCartId ? ' added' : '';

                    ?>
                    <li class="product product-no-border style-2">
                        <div class="product-container">
                            <figure>
                                <div class="product-wrap">
                                    <div class="product-images"><?

                                        // TODO: акция
                                        if (false)
                                        {
                                            ?>
                                            <span class="onsale">Акция!</span><?
                                        }

                                        ?>
                                        <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                                            <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><img width="<?= $img1['WIDTH'] ?>" height="<?= $img1['HEIGHT'] ?>"
                                                                                           src="<?= $img1['SRC'] ?>" alt="<?= $item['NAME'] ?>"/></a>
                                        </div>
                                        <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                                            <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><img width="<?= $img2['WIDTH'] ?>" height="<?= $img2['HEIGHT'] ?>"
                                                                                           src="<?= $img2['SRC'] ?>" alt="<?= $item['NAME'] ?>"/></a>
                                        </div>
                                    </div>
                                </div>
                                <figcaption>
                                    <div class="shop-loop-product-info">
                                        <div class="info-meta clearfix">
                                            <div class="star-rating">
                                                <span style="width:<?= $rating ?>%"></span>
                                            </div>
                                            <div class="loop-add-to-wishlist">
                                                <div class="yith-wcwl-add-to-wishlist">
                                                    <div class="yith-wcwl-add-button">
                                                        <a href="#" class="add_to_wishlist<?= $wlAdded ?>"
                                                           data-id="<?= $item['ID'] ?>" data-cid="<?= $wishCartId ?>">
                                                            Добавить в избранное
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="info-content-wrap">
                                            <h3 class="product_title">
                                                <a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $item['NAME'] ?></a>
                                            </h3>
                                            <div class="info-price">
                                                <span class="price">
                                                    <span class="amount"><?= $price ?> руб.<?= $pPrice ?></span>
                                                </span>
                                            </div>
                                            <div class="loop-action">
                                                <div class="loop-add-to-cart">
                                                    <a href="/personal/cart/?id=<?= $item['ID'] ?>"
                                                       class="add_to_cart_button" data-id="<?= $item['ID'] ?>">
                                                        В корзину
                                                    </a>
                                                    <a class="popup-inline" href="#elFormOneClick_<?=$item['ID'] ?>"
                                                       class="add_to_cart_button" data-id="<?=$item['ID'] ?>" data-rel="magnific-popup-link">
                                                        Купить в один клик
                                                    </a>
                                                    <div class="engFormPopup zwhite-popup" id="elFormOneClick_<?=$item['ID']?>">
                                                        <form class="oneclick-form" action="">
                                                            <input type="hidden" name="" id="" value="">
                                                            <input type="hidden" name="PRODUCT_ID" value="">
                                                            <div class="elOrderPopup-pole">
                                                                <div class="it-block">
                                                                    <div class="it-title">Имя*</div>
                                                                    <input name="NAME" type="text" placeholder="Ваше Имя" value="" required="" title="Ваше Имя">
                                                                </div>
                                                                <div class="it-block">
                                                                    <div class="it-title">Телефон*</div>
                                                                    <input name="PHONE" type="text" placeholder="Ваш телефон" value="" required="" title="Ваш телефон">
                                                                </div>
                                                            </div>
                                                            <div class="commerce">
                                                                <table id="cart" class="table shop_table cart">
                                                                        <thead>
                                                                        <tr>
                                                                            <th class="product-thumbnail hidden-xs">&nbsp;</th>
                                                                            <th class="product-name">Название</th>
                                                                            <th class="product-price text-center">Цена</th>
                                                                            <th class="product-quantity text-center">Количество</th>
                                                                            <th class="product-subtotal text-center hidden-xs">Сумма</th>
                                                                            <th class="product-remove hidden-xs">&nbsp;</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr class="cart_item" data-id="18">
                                                                            <td class="product-thumbnail hidden-xs">
                                                                                <a href="/cat/other/30060/">
                                                                                    <img width="150" height="150" src="/upload/iblock/2b8/2b81f01ee565de7a5f3a9ce353286d0c.jpg" alt="Шпатель зубчатый для паркетных клеев ADESIV Spatola 6">
                                                                                </a>
                                                                            </td>
                                                                            <td class="product-name">
                                                                                <a href="/cat/other/30060/">Шпатель зубчатый для паркетных клеев ADESIV Spatola 6</a>                            </td>
                                                                            <td class="product-price text-center">
                                                                                <span class="amount">280 руб.</span>
                                                                            </td>
                                                                            <td class="product-quantity text-center">
                                                                                <div class="quantity">
                                                                                    <input type="number" step="1" min="0" name="qunatity" data-price="280" value="1" title="Количество упаковок" class="input-text qty text" size="4">
                                                                                    <span class="amount js-qnt" data-inpack="1"></span>
                                                                                </div>
                                                                            </td>
                                                                            <td class="product-subtotal hidden-xs text-center">
                                                                                <span class="amount js-total">3 640</span> руб.
                                                                            </td>
                                                                            <td class="product-remove hidden-xs">
                                                                                <a href="#" class="remove" title="Удалить">×</a>
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                <div class="cart-collaterals">
                                                                    <div class="cart_totals">
                                                                        <div class="wc-proceed-to-checkout">
                                                                            <a href="/personal/order/" class="checkout-button button alt wc-forward rounded">Оформить заказ</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </div>
                    </li><?
                }
                ?>
            </ul>
        </div>
        <a href="#" class="caroufredsel-prev"></a>
        <a href="#" class="caroufredsel-next"></a>
    </div>
</div><?