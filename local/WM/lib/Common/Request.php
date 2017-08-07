<?php

namespace WM\Common;


/**
 * Class Request
 * @package WM\Common
 */
class Request extends \Wm\Base\BitrixInstances
{
    /**
     *
     */
    public static function setInstance()
    {
        static::$instance = Context::get()->getRequest();
    }

    /**
     * @return \Bitrix\Main\HttpRequest
     */
    public static function get()
    {
        return parent::get();
    }
}