<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var CMain $APPLICATION */

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