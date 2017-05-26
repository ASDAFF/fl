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
	'nPageSize' => 5,
);

$items = [];
$ex = false;
while ($sectionId)
{

	$filter = [
	    'CATEGORY' => [$sectionId],
    ];
	$items = \Local\Catalog\Offer::get(1, $filter, ['PROPERTY_RATING' => 'desc'], $navParams);
	$min = isset($items['ITEMS'][$offer['ID']]) ? 1 : 0;
	if (count($items['ITEMS']) > $min)
    {
        $ex = true;
		break;
	}

	$section = \Local\Catalog\Section::getById($sectionId);
	$sectionId = $section['PARENT'];
}

if (!$ex)
    return;

?>
<div class="related products">
    <div class="related-title">
        <h3><span>Похожие товары</span></h3>
    </div>
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
                                                <a href="#" class="add_to_wishlist">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </li><?

            $cnt++;
            if ($cnt == 4)
                break;
        }

        ?>
    </ul>
</div><?
