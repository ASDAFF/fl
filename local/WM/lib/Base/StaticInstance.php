<?php

namespace WM\Base;


/**
 * Class StaticInstance
 * @package WM\Base
 */
abstract class StaticInstance
{
    /**
     * @var static instance of object
     */
    protected static $instance = null;

    /**
     * @return $this
     */
    public static function get()
    {
        if(static::$instance === null)
            static::$instance = new static();
        return static::$instance;
    }
}