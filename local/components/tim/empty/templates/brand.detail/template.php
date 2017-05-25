<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @global CMain $APPLICATION */

$item = \Local\Catalog\Brand::getByCode($_REQUEST['code']);
if (!$item)
	return;

$APPLICATION->AddChainItem($item['NAME'], $item['DETAIL_PAGE_URL']);

$APPLICATION->SetTitle($item['NAME']);
$APPLICATION->SetPageProperty('title', $item['TITLE']);

$src = CFile::GetPath($item['DETAIL_PICTURE']);

?>
<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<img class="pull-right" src="<?= $src ?>">
			<?= $item['DETAIL_TEXT'] ?>
		</div>
	</div>
</div><?