<?php

namespace WM\Base;


/**
 * Class GlobalVars
 * @package WM\Base
 */
abstract class GlobalVars
{
    /**
     * @var null
     */
    protected static $object = null;

    /**
     * @var null
     */
    protected static $varName = null;

    /**
     * @return mixed
     */
    abstract static function setVarName();

    /**
     * @return Object
     * @throws \Exception
     */
    public static function get()
    {
        if(static::$object === null)
        {
            static::setVarName();

            if(empty(static::$varName))
                throw new \Exception('Empty global variable name!');
            if(empty($GLOBALS[static::$varName]))
                throw new \Exception('Empty global array with this name (' . static::$varName . ')!');
            static::$object = $GLOBALS[static::$varName];
        }

        return static::$object;
    }

    /**
     * @param $name
     * @param $arguments
     * @return bool
     */
    public function __call($name, $arguments)
    {
        if(method_exists(static::$object, $name))
            return static::$object->$name($arguments);
        return false;
    }
}