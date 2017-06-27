<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

set_time_limit(0);

$iblockElement = new \CIBlockElement();

$offers = \Local\Catalog\Offer::getAll_(true);
?><h2>Всего торговых предложений: <?= count($offers['ITEMS']) ?></h2><?

$cnt = 0;
?><h2>Торговые предложения без картинок для карточки</h2>
    <div id="b1" style="display:none;"><?
foreach ($offers['ITEMS'] as $offer)
{
	if (!$offer['PHOTOS'])
	{
		?><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=5&type=catalog&ID=<?= $offer['ID'] ?>&lang=ru"
             target="_blank"><?= $offer['NAME'] ?></a><br/><?
		$cnt++;
	}
}
?>
    </div><?
if ($cnt)
{
	?>
    <p>
        <button onclick="document.getElementById('b1').style.display='block';">Показать</button>
    </p><?
}
?>
    <p><b>Итого: <?= $cnt ?></b></p>
    <hr><?

$cnt = 0;
?><h2>Торговые предложения без картинки для анонса</h2>
    <div id="b2" style="display:none;"><?
foreach ($offers['ITEMS'] as $offer)
{
	if (!$offer['PREVIEW_PICTURE'])
	{
		?><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=5&type=catalog&ID=<?= $offer['ID'] ?>&lang=ru"
             target="_blank"><?= $offer['NAME'] ?></a><br/><?
		$cnt++;
	}
}
?>
    </div><?
if ($cnt)
{
	?>
    <p>
        <button onclick="document.getElementById('b2').style.display='block';">Показать</button>
    </p><?
}
?><p><b>Итого: <?= $cnt ?></b></p>
    <hr><?

$cnt = 0;
$byXml = [];
?><h2>Картинка для анонса не 150х150</h2>
    <div id="b3" style="display:none;"><?
foreach ($offers['ITEMS'] as $offer)
{
	if ($offer['PREVIEW_PICTURE'])
	{
		$ar = CFile::GetFileArray($offer['PREVIEW_PICTURE']);
		if ($ar['WIDTH'] != 150 || $ar['HEIGHT'] != 150)
		{
			?>[<?= $ar['WIDTH'] ?>x<?= $ar['HEIGHT'] ?>] <?
			?><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=5&type=catalog&ID=<?= $offer['ID'] ?>&lang=ru"
                 target="_blank"><?= $offer['NAME'] ?></a><br/><?
			$cnt++;
		}

		$data = file_get_contents($_SERVER["DOCUMENT_ROOT"] . $ar['SRC']);
		$base64 = base64_encode($data);
		$byXml[$base64][] = $offer['ID'];
	}
}
?>
    </div><?
if ($cnt)
{
	?>
    <p>
        <button onclick="document.getElementById('b3').style.display='block';">Показать</button>
    </p><?
}
?><p><b>Итого: <?= $cnt ?></b></p>
    <hr><?

$cnt = 0;
?><h2>Торговые предложения без детальной картинки</h2>
    <div id="b4" style="display:none;"><?
foreach ($offers['ITEMS'] as $offer)
{
	if (!$offer['DETAIL_PICTURE'])
	{
		?><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=5&type=catalog&ID=<?= $offer['ID'] ?>&lang=ru"
             target="_blank"><?= $offer['NAME'] ?></a><br/><?
		$cnt++;
	}
}
?>
    </div><?
if ($cnt)
{
	?>
    <p>
        <button onclick="document.getElementById('b4').style.display='block';">Показать</button>
    </p><?
}
?><p><b>Итого: <?= $cnt ?></b></p>
    <hr><?

$cnt = 0;
?><h2>Детальная картинка не 300х387</h2>
    <div id="b5" style="display:none;"><?
foreach ($offers['ITEMS'] as $offer)
{
	if ($offer['DETAIL_PICTURE'])
	{
		$ar = CFile::GetFileArray($offer['DETAIL_PICTURE']);
		if ($ar['WIDTH'] != 300 || $ar['HEIGHT'] != 387)
		{
			?>[<?= $ar['WIDTH'] ?>x<?= $ar['HEIGHT'] ?>] <?
			?><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=5&type=catalog&ID=<?= $offer['ID'] ?>&lang=ru"
                 target="_blank"><?= $offer['NAME'] ?></a><br/><?
			$cnt++;
		}
	}
}
?>
    </div><?
if ($cnt)
{
	?>
    <p>
        <button onclick="document.getElementById('b5').style.display='block';">Показать</button>
    </p><?
}
?><p><b>Итого: <?= $cnt ?></b></p>
    <hr><?

$cnt = 0;
?><h2>Дубли картинок для анонса</h2>
    <div id="b6" style="display:none;"><?
foreach ($byXml as $code => $ar)
{
	if (count($ar) > 1)
	{
		?><br/><?
		foreach ($ar as $id)
		{
			?><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=5&type=catalog&ID=<?= $id ?>&lang=ru"
                 target="_blank"><?= $id ?></a> <?
		}
		$cnt++;
	}
}
?>
    </div><?
if ($cnt)
{
	?>
    <p>
        <button onclick="document.getElementById('b6').style.display='block';">Показать</button>
    </p><?
}
?><p><b>Итого: <?= $cnt ?></b></p>
    <hr><?

$cnt = 0;
?><h2>Не заполнена цена</h2>
    <div id="b7" style="display:none;"><?
foreach ($offers['ITEMS'] as $offer)
{
	if (!$offer['PRICE'])
	{
		?><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=5&type=catalog&ID=<?= $offer['ID'] ?>&lang=ru"
             target="_blank"><?= $offer['NAME'] ?></a><br/><?
		$cnt++;
	}
}
?>
    </div><?
if ($cnt)
{
	?>
    <p>
        <button onclick="document.getElementById('b7').style.display='block';">Показать</button>
    </p><?
}
?><p><b>Итого: <?= $cnt ?></b></p>
    <hr><?

$cnt = 0;
?><h2>Не заполнена закупочная цена</h2>
    <div id="b8" style="display:none;"><?
foreach ($offers['ITEMS'] as $offer)
{
	if (!$offer['PRICE_P'])
	{
		?><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=5&type=catalog&ID=<?= $offer['ID'] ?>&lang=ru"
             target="_blank"><?= $offer['NAME'] ?></a><br/><?
		$cnt++;
	}
}
?>
    </div><?
if ($cnt)
{
	?>
    <p>
        <button onclick="document.getElementById('b8').style.display='block';">Показать</button>
    </p><?
}
?><p><b>Итого: <?= $cnt ?></b></p>
    <hr><?

$cnt = 0;
?><h2>Не заполнено описание</h2>
    <div id="b9" style="display:none;"><?
foreach ($offers['ITEMS'] as $offer)
{
	if (!$offer['DETAIL_TEXT'])
	{
		?><a href="/bitrix/admin/iblock_element_edit.php?IBLOCK_ID=5&type=catalog&ID=<?= $offer['ID'] ?>&lang=ru"
             target="_blank"><?= $offer['NAME'] ?></a><br/><?
		$cnt++;
	}
}
?>
    </div><?
if ($cnt)
{
	?>
    <p>
        <button onclick="document.getElementById('b9').style.display='block';">Показать</button>
    </p><?
}
?><p><b>Итого: <?= $cnt ?></b></p>
    <hr><?


require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");