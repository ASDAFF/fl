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


$result = array();

// Товары
ob_start();
include('products.php');
$result['HTML'] = ob_get_contents();
ob_end_clean();

// Хлебные крошки
ob_start();
include('bc.php');
$result['BC'] = ob_get_contents();
ob_end_clean();

// Поисковый запрос
$result['SEARCH'] = $component->searchQuery;

// Заголовок браузера
$result['TITLE'] = $component->seo['TITLE'];
$result['H1'] = $component->seo['H1'];

// Фильтры
$result['FILTERS'] = array();
foreach ($filter['GROUPS'] as $group)
{
	if ($group['TYPE'] == 'price')
	{
		$from = $group['FROM'] ? $group['FROM'] : $group['MIN'];
		$to = $group['TO'] ? $group['TO'] : $group['MAX'];
		$result['FILTERS']['PRICE'] = array(
			'FROM' => $from,
			'TO' => $to,
			'MIN' => $group['MIN'],
			'MAX' => $group['MAX'],
		);
	}
	elseif ($group['TYPE'] == 'category')
	{
		foreach ($group['ITEMS'] as $code => $item)
			$result['FILTERS']['CATEGORY'][$code] = array($item['CNT'], $item['TREE_CHECKED'] ? 1 : 0);
	}
	else
	{
		foreach ($group['ITEMS'] as $code => $item)
			$result['FILTERS'][$code] = array($item['CNT'], $item['CHECKED'] ? 1 : 0);
	}
}

header('Content-Type: application/json');
echo json_encode($result);