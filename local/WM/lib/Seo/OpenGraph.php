<?php

namespace WM\Seo;

/**
 * Class OpenGraph
 * @package WM\Seo
 */
class OpenGraph extends \WM\Base\Markup
{
    public function setPrefix()
    {
        static::$PREFIX = 'og:';
    }
}