<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var CMain $APPLICATION */

$isIndexPage = defined('INDEX_PAGE') && INDEX_PAGE === true;

if ($isIndexPage)
{
	?>
	<div class="bx-sidebar-block"><?
		$APPLICATION->IncludeComponent('bitrix:search.title', 'visual', [
				'NUM_CATEGORIES' => '1',
				'TOP_COUNT' => '5',
				'CHECK_DATES' => 'N',
				'SHOW_OTHERS' => 'N',
				'PAGE' => '/cat/',
				'CATEGORY_0_TITLE' => 'Товары',
				'CATEGORY_0' => [
					0 => 'iblock_catalog',
				],
				'CATEGORY_0_iblock_catalog' => [
					0 => 'all',
				],
				'CATEGORY_OTHERS_TITLE' => 'Прочее',
				'SHOW_INPUT' => 'Y',
				'INPUT_ID' => 'title-search-input',
				'CONTAINER_ID' => 'search',
				'PRICE_CODE' => [
					0 => 'BASE',
				],
				'SHOW_PREVIEW' => 'Y',
				'PREVIEW_WIDTH' => '75',
				'PREVIEW_HEIGHT' => '75',
				'CONVERT_CURRENCY' => 'Y'
			],
			false
		);
		?>
	</div><?
}

?>
<div class="bx-sidebar-block"><?
	$APPLICATION->IncludeComponent(
		'bitrix:main.include',
		'',
		[
			'AREA_FILE_SHOW' => 'file',
			'PATH' => '/include/socnet_sidebar.php',
			'AREA_FILE_RECURSIVE' => 'N',
			'EDIT_MODE' => 'html',
		],
		false,
		['HIDE_ICONS' => 'Y']
	);
	?>
</div>

<div class="bx-sidebar-block"><?
	$APPLICATION->IncludeComponent(
		'bitrix:main.include',
		'',
		[
			'AREA_FILE_SHOW' => 'file',
			'PATH' => '/include/about.php',
			'AREA_FILE_RECURSIVE' => 'N',
			'EDIT_MODE' => 'html',
		],
		false,
		['HIDE_ICONS' => 'N']
	);
	?>
</div>

<div class="bx-sidebar-block"><?
	$APPLICATION->IncludeComponent(
		'bitrix:main.include',
		'',
		[
			'AREA_FILE_SHOW' => 'file',
			'PATH' => '/include/info.php',
			'AREA_FILE_RECURSIVE' => 'N',
			'EDIT_MODE' => 'html',
		],
		false,
		['HIDE_ICONS' => 'N']
	);
	?>
</div>