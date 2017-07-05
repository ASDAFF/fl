<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

global $APPLICATION;
$aMenuLinks = $APPLICATION->IncludeComponent('bitrix:menu.sections', '', array(
    'IS_SEF' => 'Y',
    'SEF_BASE_URL' => '',
    'IBLOCK_ID' => "1", //id инфоблока каталога
    'DEPTH_LEVEL' => 10, //уровень вложенности
    'CACHE_TYPE' => 'A',
), false, Array('HIDE_ICONS' => 'Y'));