<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arResult */

ob_start();

$l = count($arResult);
if ($l > 1)
{
	$l--;
	?>
	<ul class="breadcrumb"><?
		foreach ($arResult as $i => $item)
		{
			if ($i < $l)
			{
				?>
				<li><span><a href="<?= $item['LINK'] ?>"><span><?= $item['TITLE'] ?></span></a></span></li><?
			}
			else
			{
				?>
				<li><span><?= $item['TITLE'] ?></span></li><?
			}
		}

	?>
	</ul><?
}

$strReturn = ob_get_contents();
ob_end_clean();

return $strReturn;