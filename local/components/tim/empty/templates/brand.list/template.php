<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$items = \Local\Catalog\Brand::getAll();

?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<ul><?

				foreach ($items['ITEMS'] as $item)
				{
					?>
					<li><a href="<?= $item['DETAIL_PAGE_URL'] ?>"><?= $item['NAME'] ?></a></li><?
				}

				?>
			</ul>
		</div>
	</div>
</div><?