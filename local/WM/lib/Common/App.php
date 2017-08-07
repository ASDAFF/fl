<?php

namespace WM\Common;

/**
 * Class App
 * @package WM\Common
 */
class App extends \Wm\Base\GlobalVars
{
    /**
     * set global variable name
     */
    public static function setVarName()
    {
        static::$varName = 'APPLICATION';
    }

    /**
     * @return \Bitrix\Main\Application
     */
    public static function get()
    {
        return parent::get();
    }
}