<?php

namespace WM\Common;

/**
 * Class User
 * @package WM\Common
 */
class User extends \Wm\Base\GlobalVars
{
    /**
     * set global variable name
     */
    public static function setVarName()
    {
        static::$varName = 'USER';
    }

    /**
     * @return \CUser
     */
    public static function get()
    {
        return parent::get();
    }

    /**
     * @return bool
     */
    public static function isGuest()
    {
        return !static::isAuthed();
    }

    /**
     * @return bool
     */
    public static function isAuthed()
    {
        return static::get()->IsAuthorized();
    }

    /**
     * @return bool
     */
    public static function isAdmin()
    {
        return static::get()->IsAuthorized() && static::get()->IsAdmin();
    }
}