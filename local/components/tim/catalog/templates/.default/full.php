<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @var Local\Catalog\TimCatalog $component */

$filter = $component->filter;
$offers = $component->offers['ITEMS'];

function printSection($section, $items)
{
	if ($section['NAME'])
	{
		$code = $section['CODE'];
		$item = $items[$code];
		$checked = $section['TREE_CHECKED'] ? ' class="chosen"' : '';
		?>
		<li<?= $checked ?> data-code="<?= $code ?>">
			<a href="<?= CATALOG_PATH ?><?= $code ?>/"><?= $item['NAME'] ?></a>
			<small class="count"><?= $item['CNT'] ?></small><?
	}

	if ($section['ITEMS'])
	{
		?>
		<ul class="s-filter"><?

			foreach ($section['ITEMS'] as $sect)
				printSection($sect, $items);

			?>
		</ul><?
	}

	if ($section['NAME'])
	{
		?></li><?
	}

}

?>
<div class="heading-container heading-resize heading-no-button">
	<div class="heading-background heading-parallax bg-shop">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="heading-wrap">
						<div class="page-title">
							<h1><? $APPLICATION->ShowTitle(false); ?></h1>
							<div class="page-breadcrumb"><?

								$APPLICATION->IncludeComponent('bitrix:breadcrumb', '', [
										'START_FROM' => '0',
										'PATH' => '',
										'SITE_ID' => '-'
									],
									false,
									['HIDE_ICONS' => 'Y']
								);

								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="content-container commerce page-layout-left-sidebar">
	<div class="container">
	<div class="row">
	<div class="col-md-9 main-wrap">
		<div class="main-content" id="ajax-cont"><?

			//=========================================================
			include('products.php');
			//=========================================================

			?>
		</div>
	</div>
	<div class="col-md-3 sidebar-wrap">
		<div class="main-sidebar" id="filters-panel">

			<input type="hidden" name="catalog_path" value="<?= CATALOG_PATH ?>">
            <input type="hidden" name="separator" value="<?= $filter['SEPARATOR'] ?>"><?

			$closed = [0, 0, 0, 1, 1, 1, 1, 1, 1, 1];
			if (isset($_COOKIE['filter_groups']))
				$closed = explode(',', $_COOKIE['filter_groups']);

			$class = $closed[0] ? ' closed' : '';
            ?>
			<div class="widget commerce widget_product_search<?= $class ?>">
				<h4 class="widget-title">
					<span>Поиск</span>
                    <i class="fa fa-angle-down"></i>
				</h4>
                <div class="widget-content">
                    <form class="commerce-product-search" id="filter-search">
                        <label class="screen-reader-text" for="s">Поиск:</label>
                        <input type="search" class="search-field rounded" placeholder="Поиск по товарам&hellip;"
                               name="q" value="<?= $component->searchQuery ?>" />
                        <input type="submit" value="Искать"/>
                    </form>
                </div>
			</div><?

			$i = 1;
			foreach ($filter['GROUPS'] as $group)
			{
				$class = $closed[$i] ? ' closed' : '';
				$widget = 'widget_layered_nav';
				if ($group['TYPE'] == 'price')
					$widget = 'widget_price_filter';
				$whidden = $group['CNT'] ? '' : ' hidden';
				$i++;

				?>
				<div class="widget <?= $widget ?><?= $whidden ?><?= $class ?>">
                <h4 class="widget-title">
                    <span><?= $group['NAME'] ?></span>
                    <i class="fa fa-angle-down"></i>
                </h4>
                <div class="widget-content"><?

					if ($group['TYPE'] == 'category')
					{
						printSection($group['TREE'], $group['ITEMS']);
					}
					elseif ($group['TYPE'] == 'price')
					{
						$min = 0;
						$max = ceil($group['MAX'] / 100) * 100;
						$from = $group['FROM'] ? $group['FROM'] : 0;
						$to = $group['TO'] ? $group['TO'] : $max;
						?>
						<form>
							<div class="price_slider_wrapper">
								<div class="price_slider" data-max="<?= $max ?>"
								     data-from="<?= $from ?>" data-to="<?= $to ?>"></div>
								<div class="price_slider_amount">
									<button id="price_submit" type="submit" class="button">Применить</button>
									<div class="price_label">
										Цена, руб.: <span class="from"><?= $from ?></span> &mdash; <span class="to"><?= $to ?></span>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</form><?
					}
					elseif ($group['TYPE'] == 'color')
					{
						?>
						<ul class="f-color"><?
						foreach ($group['ITEMS'] as $code => $item)
						{
							if (!$item['ALL_CNT'])
								continue;

							$checked = $item['CHECKED'] ? 'chosen ' : '';
							$hidden = $item['CNT'] ? '' : 'hidden ';
							$bg = 'background:#' . $code;
							?><li class="<?= $checked ?><?= $hidden ?>" data-code="<?= $code ?>"><b style="<?= $bg ?>;"></b></li><?
						}
						?>
						</ul><?
					}
					else
					{
						?>
						<ul class="f-other"><?
                        $j = 0;
                        $max = false;
						foreach ($group['ITEMS'] as $code => $item)
						{
							if (!$item['ALL_CNT'])
								continue;

							$checked = $item['CHECKED'] ? 'chosen ' : '';
							$hidden = $item['CNT'] ? '' : 'hidden ';

							$j++;
							if ($group['MAX'] && !$max && $j > $group['MAX'] && !$checked)
                            {
								$max = true;
								?>
                                </ul>
                                <ul class="f-other additional hidden">
                                <?
                            }

							?>
							<li class="<?= $checked ?><?= $hidden ?>" data-code="<?= $code ?>">
								<a href="<?= CATALOG_PATH ?><?= $code ?>/"><?= $item['NAME'] ?></a>
								<small class="count"><?= $item['CNT'] ?></small>
							</li><?
						}
						?>
						</ul><?

                        if ($max)
                        {
                            ?>
                            <div class="show-all"><span>Показать все</span></div><?
                        }


						/*?>
						<ul><?
							foreach ($group['ITEMS'] as $code => $item)
							{
								$style = $item['ALL_CNT'] ? '' : ' style="display:none;"';
								$class = '';
								if (!$item['CNT'] && $item['CHECKED'])
									$class = ' class="checked disabled"';
								elseif ($item['CHECKED'])
									$class = ' class="checked"';
								elseif (!$item['CNT'])
									$class = ' class="disabled"';
								$checked = $item['CHECKED'] ? ' checked' : '';
								$disabled = $item['CNT'] ? '' : ' disabled';

								?>
								<b></b><label>
									<input class="el-search-dop-input" type="checkbox"
									       name="<?= $code ?>"<?= $checked ?><?= $disabled ?> />
									<?= $item['NAME'] ?> (<i><?= $item['CNT'] ?></i>)
								</label>
								<?
							}
							?>
						</ul><?*/
					}

					?>
				</div>
				</div><?
			}

			/*
			?>
			<div class="widget widget_products">
				<h4 class="widget-title"><span>Хиты продаж</span></h4>
				<ul class="product_list_widget">
					<li>
						<a href="shop-detail-1.html">
							<img width="200" height="200" src="/images/products/product_60x60.jpg" alt="Product-1"/>
							<span class="product-title">Donec tincidunt justo</span>
						</a>
						<del><span class="amount">20.50&#36;</span></del>
						<ins><span class="amount">19.00&#36;</span></ins>
					</li>
					<li>
						<a href="shop-detail-1.html">
							<img width="200" height="200" src="/images/products/product_60x60.jpg" alt="Product-2"/>
							<span class="product-title">Mauris egestas</span>
						</a>
						<span class="amount">14.95&#36;</span>
					</li>
					<li>
						<a href="shop-detail-1.html">
							<img width="200" height="200" src="/images/products/product_60x60.jpg" alt="Product-9"/>
							<span class="product-title">Morbi fermentum</span>
						</a>
						<span class="amount">17.45&#36;</span>
					</li>
					<li>
						<a href="shop-detail-1.html">
							<img width="200" height="200" src="/images/products/product_60x60.jpg" alt="Product-8"/>
							<span class="product-title">Morbi fermentum</span>
						</a>
						<span class="amount">23.00&#36;</span>
					</li>
					<li>
						<a href="shop-detail-1.html">
							<img width="200" height="200" src="/images/products/product_60x60.jpg" alt="Product-7"/>
							<span class="product-title">Ut quis Aenean</span>
						</a>
						<span class="amount">10.95&#36;</span>
					</li>
				</ul>
			</div><?
			*/

			?>
		</div>
	</div>
	</div>
	</div>
</div><?

foreach ($filter['BC'] as $i => $item)
    $APPLICATION->AddChainItem($item['NAME'], $item['HREF']);

if ($component->navParams['iNumPage'] > 1)
    $component->seo['TITLE'] .= ' - страница ' . $component->navParams['iNumPage'];

if ($component->seo['H1'])
    $APPLICATION->SetTitle($component->seo['H1']);
if ($component->seo['TITLE'])
    $APPLICATION->SetPageProperty('title', $component->seo['TITLE']);
if ($component->seo['DESCRIPTION'])
    $APPLICATION->SetPageProperty('description', $component->seo['DESCRIPTION']);
if ($component->seo['NOINDEX'])
	$APPLICATION->AddHeadString('<meta name="robots" content="none"/>');
