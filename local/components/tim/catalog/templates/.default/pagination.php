<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var Local\Catalog\TimCatalog $component */

$size = $component->navParams['nPageSize'];
$cur = $component->offers['NAV']['PAGE'];
$end = ceil($component->offers['NAV']['COUNT'] / $size);

if ($end <= 1)
	return;

$range = 2;

$start = $cur - $range;
$finish = $cur + $range;
if ($start < 1)
{
	$finish -= $start - 1;
	$start = 1;
}
if ($finish > $end)
{
	$start -= $finish - $end;
	if ($start < 1)
		$start = 1;
	$finish = $end;
}

$url = $component->filter['URL'];
if (strpos($url, '?') !== false)
	$urlPage = $url . '&page=';
else
	$urlPage = $url . '?page=';

$cnt = $component->offers['NAV']['COUNT'];
$to = $cur * $size;
$from = $to - $size + 1;
if ($to > $cnt)
	$to = $cnt;
?>
<nav class="commerce-pagination">
	<p class="commerce-result-count">
		Показаны товары: <?= $from ?>&ndash;<?= $to ?> из <?= $cnt ?>
	</p>

	<div class="paginate">
		<div class="paginate_links"><?

			// Предыдущая страница
			if ($cur > 1)
			{
				$i = $cur - 1;
				// Для первой страницы не подмешиваем параметр
				$href = ($i == 1) ? $url : $urlPage . $i;
				?>
				<a class="pagination-meta" href="<?= $href ?>"><i class="fa fa-angle-left"></i></a><?
			}

			// Первая страница
			if ($start > 1)
			{
				?>
				<a class="page-numbers" href="<?= $url ?>">1</a><?

				if ($start > 2)
				{
					?>
					<span class="pagination-meta">...</span><?
				}
			}

			// Список страниц
			for ($i = $start; $i <= $finish; $i++)
			{
				if ($i == $cur)
				{
					?>
					<span class="page-numbers current"><?= $i ?></span><?
				}
				else
				{
					$href = ($i == 1) ? $url : $urlPage . $i;
					?>
					<a class="page-numbers" href="<?= $href ?>"><?= $i ?></a><?
				}
			}

			// Последняя страница
			if ($finish < $end)
			{
				if ($finish < $end - 1)
				{
					?>
					<span class="pagination-meta">...</span><?
				}

				$href = $urlPage . $end;
				?>
				<a class="page-numbers" href="<?= $href ?>"><?= $end ?></a><?
			}

			// Следующая страница
			if ($cur < $end)
			{
				$i = $cur + 1;
				$href = $urlPage . $i;
				?>
				<a class="pagination-meta" href="<?= $href ?>"><i class="fa fa-angle-right"></i></a><?
			}

			?>
		</div>
	</div>
</nav><?
