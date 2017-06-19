<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @var array $offers */
/** @global CMain $APPLICATION */
/** @var Local\Catalog\TimCatalog $component */

$user = new \CUser();
$isAdmin = $user->IsAdmin();

//
// Сортировка, количество страниц, плашки выбранных фильтров
//
?>
<div class="shop-toolbar">
	<form class="commerce-ordering clearfix">
		<div class="commerce-ordering-select">
			<label class="hide" for="sort">Сортировка:</label>
			<div class="form-flat-select">
				<select id="sort" name="sort" class="orderby"><?

					foreach ($component->sortParams as $key => $sort)
					{
						$selected = $sort['CURRENT'] ? ' selected' : '';

						?>
						<option value="<?= $key ?>"<?= $selected ?>><?= $sort['NAME'] ?></option><?
					}

					?>
				</select>
				<i class="fa fa-angle-down"></i>
			</div>
		</div>
		<div class="commerce-ordering-select">
			<label class="hide" for="size">Show:</label>
			<div class="form-flat-select">
				<select id="size" name="size" class="per_page"><?

					foreach ($component->pageSizes as $size)
					{
						$selected = $size == $component->navParams['nPageSize'] ? ' selected' : '';

						?>
						<option value="<?= $size ?>"<?= $selected ?>><?= $size ?></option><?
					}

					?>
				</select>
				<i class="fa fa-angle-down"></i>
			</div>
		</div>
	</form><?

	foreach ($filter['CUR_FILTERS'] as $item)
	{
		?><div class="cur-f">
			<span><?= $item['NAME'] ?></span><a href="<?= $item['HREF'] ?>">×</a>
		</div><?
	}

	?>
</div><?

//
// Список товаров
//
if (count($offers) <= 0)
{
	?>
	<p class="empty">Не найдено ни одного подходящего товара. Попробуйте отключить какой-нибудь фильтр</p><?
}
else
{

	?>
	<div class="shop-loop grid">
	<ul class="products"><?

		$file = new \CFile();
		foreach ($offers as $id => $item)
		{
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
			<li class="product product-no-border style-2 col-md-3 col-sm-6">
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
								<a href="<?= $item['DETAIL_PAGE_URL'] ?>">
									<img width="<?= $img1['WIDTH'] ?>" height="<?= $img1['HEIGHT'] ?>"
									     src="<?= $img1['SRC'] ?>" alt="<?= $item['NAME'] ?>"/>
								</a>
							</div>
							<div class="shop-loop-thumbnail shop-loop-back-thumbnail">
								<a href="<?= $item['DETAIL_PAGE_URL'] ?>">
									<img width="<?= $img2['WIDTH'] ?>" height="<?= $img2['HEIGHT'] ?>"
									     src="<?= $img2['SRC'] ?>" alt="<?= $item['NAME'] ?>"/>
								</a>
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
                                           data-id="<?=$item['ID'] ?>" data-rel="magnific-popup-link">
                                            Купить в один клик
                                        </a><?

										\Local\Catalog\Offer::printQuickPopup($item);

										?>
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
	</div><?
}

//
// Пагинация
//
//=========================================================
include('pagination.php');
//=========================================================

?>
<div class="seo-text"><?
	// Описание выводим только на первой странице.
	if ($component->navParams['iNumPage'] == 1)
	{
        echo $component->seo['TEXT'];
	}
	?>
</div><?