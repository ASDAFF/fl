<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Карта сайта");
?>
<meta name="robots" content="noindex, follow, noarchive"> 
<div class='container site-map-container'>
<h1><?$APPLICATION->ShowHead(false);?></h1>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.map", 
	".default", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COL_NUM" => "1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"LEVEL" => "0",
		"SET_TITLE" => "Y",
		"SHOW_DESCRIPTION" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><br></div><? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
