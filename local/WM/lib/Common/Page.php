<?php

namespace WM\Common;

/**
 * Class Page
 * @package WM\Common
 */
class Page
{
    /**
     * @param $data
     * @return bool|int
     */
    public static function inDir($data)
    {
        if(is_array($data))
            return preg_match('~^(?:' . join('|', array_map(function ($v) { return preg_quote($v); }, $data)) . ')', Request::get()->getRequestedPageDirectory());
        return 0 === strpos(Request::get()->getRequestedPageDirectory(), $data);
    }

    /**
     * @param $section
     * @return bool
     */
    public static function inRootDir($section)
    {
        $section = is_array($section) ? join('|', array_map('preg_quote', $section)) : preg_quote($section);
        return (bool) preg_match('~^/(?:' . $section . ')~ui', Request::get()->getRequestedPageDirectory());
    }
}