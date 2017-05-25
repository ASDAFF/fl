<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$ar = $filter['BC'];
array_unshift($ar, [
	'NAME' => 'Каталог',
	'HREF' => CATALOG_PATH,
]);
array_unshift($ar, [
	'NAME' => 'Главная',
	'HREF' => '/',
]);

$last = count($ar) - 1;
foreach ($ar as $i => $item)
{
	if ($i == $last)
	{
		?>
		<li><span><?= $item['NAME'] ?></span></li><?
	}
	else
	{
		?>
		<li><span><a href="<?= $item['HREF'] ?>"><span><?= $item['NAME'] ?></span></a></span></li><?
	}
}
