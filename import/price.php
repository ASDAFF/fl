<?
if (!$_SERVER["DOCUMENT_ROOT"]) {
	error_reporting(0);
	setlocale(LC_ALL, 'ru.UTF-8');
	$_SERVER["DOCUMENT_ROOT"] = realpath(dirname(__FILE__) . "/..");
	$bConsole = true;
}
else {
	$bConsole = false;
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

ini_set('memory_limit', '1024M');
set_time_limit(0);
date_default_timezone_set("Europe/Moscow");

require($_SERVER['DOCUMENT_ROOT'] . '/local/lib/phpQuery-onefile.php');

\Bitrix\Main\Loader::includeModule('catalog');

$_log = new \Local\System\Log('import/' . date('Y_m') . '.log');
$_log->writeText(date('d.m.Y') . ' Начало импорта');

$iblockElement = new CIBlockElement();
$offers = \Local\Catalog\Offer::getAll_(true);

$http = new \Local\System\Http();
$host = 'http://www.ya-magazin.ru';

$prices = [];
$res = \CPrice::GetList();
while ($item = $res->Fetch())
{
	$prices[$item['PRODUCT_ID']] = $item;
}

$pages = [];
$cnt = 0;
foreach ($offers['ITEMS'] as &$offer)
{
	if ($offer['ACTIVE'] != 'Y')
		continue;

	$code = $offer['CODE'];
	$ar = explode('|', $code);
	$page = $ar[0];
	$pages[$page] = true;
	$offer['PAGE'] = $page;
	$cnt++;
}
unset($offer);

$_log->writeText('Активных товаров: ' . $cnt);
$_log->writeText('Страниц для загрузки: ' . count($pages));

$yaPrices = [];
foreach ($pages as $page => $v)
{
	$localFile = $_SERVER['DOCUMENT_ROOT'] . '/_log/price/' . $page . '.html';
	if (file_exists($localFile))
	{
		$res = file_get_contents($localFile);
	}
	else
	{
		$url = $host . $page;
		$res = $http->get($url);
		CheckDirPath($localFile);
		file_put_contents($localFile, $res);
	}
	$document = phpQuery::newDocument($res);

	$trs = $document->find('table.classic tr');
	foreach ($trs as $i => $tr)
	{
		if (!$i)
			continue;

		$er = false;

		$row = pq($tr);
		$tds = $row->children('td');
		$params = [];
		$pr = 0;
		$prt = 0;
		$inp = 0;
		$name = '';
		$name1 = '';
		$dim = '';
		$offerImgSrc = '';
		$offerImgDetailSrc = '';
		foreach ($tds as $j => $tdi)
		{
			$td = pq($tdi);
			if ($j == 0)
			{
				$offerImg = $td->find('img');
				$offerImgSrc = $offerImg->attr('src');
				$offerImgDetailSrc = $offerImg->attr('title');
				$offerImgDetailSrcAr = explode("'", $offerImgDetailSrc);
				if (count($offerImgDetailSrcAr) > 2)
					$offerImgDetailSrc = $offerImgDetailSrcAr[1];
				$font = $td->find('font');
				$add = $font->text();
				$td->find('.just_bt')->remove();
				$offerImg->remove();
				$name = $td->text();
				$font->remove();
				$name1 = $td->text();
			}
			elseif ($j == 2)
			{
				$inpack = $td->find('input[name=inpack]');
				$inp = floatval($inpack->attr('value'));
				$price = $td->find('input[name=price]');
				$pr = intval($price->attr('value'));
				$priceTax = $td->find('.div_taxes');
				$prt = intval($priceTax->text());
			}
		}

		$yaPrices[$page][$name] = [$pr, $prt];
		$yaPrices[$page][$name1] = [$pr, $prt];
	}
}

$cnt1 = 0;
$cnt2 = 0;
foreach ($offers['ITEMS'] as $offer)
{
	if ($offer['ACTIVE'] != 'Y')
		continue;

	$page = $offer['PAGE'];
	if (!$page)
		continue;

	$name = $offer['YA_NAME'];
	$newPrices = $yaPrices[$page][$name];
	if (!$newPrices)
	{
		$_log->writeText('Не найдены цены для товара [' . $offer['ID'] . ']: ' . $name);
		$cnt1++;
		continue;
	}

	$update = [];
	if (intval($newPrices[0]) != $offer['PRICE_WO_DISCOUNT'])
	{
		$update['PRICE_WO_DISCOUNT'] = intval($newPrices[0]);
		$update['PRICE'] = intval($newPrices[0] * 0.9);
	}
	if (intval($newPrices[1]) != $offer['PRICE_P'])
		$update['PRICE_P'] = intval($newPrices[1]);

	if ($update)
	{
		$cnt2++;
		$iblockElement->SetPropertyValuesEx($offer['ID'], 5, $update);
		\CPrice::Update($prices[$offer['ID']]['ID'], ['PRICE' => $update['PRICE']]);
	}

}

$_log->writeText('Товаров, для которых не найдены цены: ' . $cnt1);
$_log->writeText('Товаров, цены которых изменились: ' . $cnt2);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");