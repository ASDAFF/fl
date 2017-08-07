<?php

namespace WM\Common;


/**
 * Class Server
 * @package WM\Common
 */
class Server extends \Wm\Base\BitrixInstances
{
    /**
     *
     */
    public static function setInstance()
    {
        static::$instance = Context::get()->getServer();
    }

    /**
     * @return \Bitrix\Main\Server
     */
    public static function get()
    {
        return parent::get();
    }
}