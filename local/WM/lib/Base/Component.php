<?php

namespace WM\Base;

/**
 * Class Component
 * @package WM\Base
 */
abstract class Component
{
    /**
     * @var string component name
     */
    protected static $componentName = '';
    /**
     * @var array component params
     */
    protected static $params = array();

    /**
     * @param string $template - component template
     * @param array $params - component params
     * @param null $parentComponent - parent component
     * @param array $arFunctionParams - function params
     * @return component
     * @throws \Exception
     */
    public static function inc($template = '', array $params=array(), $parentComponent=null, array $arFunctionParams=array())
    {
        global $APPLICATION;

        if(empty(static::$componentName))
            throw new \Exception('Empty component name!');

        $params = static::getParams($params);
        if(empty($params))
            throw new \Exception('Empty component params!');

        return $APPLICATION->includeComponent(static::$componentName, $template, $params, $parentComponent, $arFunctionParams);
    }

    /**
     * @param string $component - component name
     * @param string $template - component template
     * @param array $params - component params
     * @param null $parentComponent - parent component
     * @param array $arFunctionParams - function params
     * @return component
     */
    public static function includeComponent($component, $template = '', array $params=array(), $parentComponent=null, array $arFunctionParams=array())
    {
        global $APPLICATION;
        return $APPLICATION->IncludeComponent($component, $template, $params, $parentComponent, $arFunctionParams);
    }

    /**
     * @param array $params
     * @return array
     */
    public static function getParams(array $params = array())
    {
        if(!empty($params))
            foreach($params as $k => $v)
                static::$params[$k] = $v;
        return static::$params;
    }
}
