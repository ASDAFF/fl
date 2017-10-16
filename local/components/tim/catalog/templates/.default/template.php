<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arResult */
/** @var Local\Catalog\TimCatalog $component */

if ($component->filter['404'])
	include ('404.php');
elseif ($component->offer)
	include ('detail.php');
elseif ($component->arParams['AJAX'])
	include ('ajax.php');
elseif ($arResult['NOT_FOUND'])
	include ('not_found.php');
else
	include ('full.php');
