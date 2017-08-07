<?php

namespace WM\Common;

/**
 * Class Asset
 * @package WM\Common
 */
class Asset extends \Wm\Base\BitrixInstances
{
    /**
     *
     */
    public static function setInstance()
    {
        static::$instance = \Bitrix\Main\Page\Asset::getInstance();
    }

    /**
     * @return \Bitrix\Main\Page\Asset
     */
    public static function get()
    {
        return parent::get();
    }
}