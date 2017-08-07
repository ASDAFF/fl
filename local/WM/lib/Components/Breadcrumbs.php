<?php

namespace WM\Components;

/**
 * Class Breadcrumbs
 * @package WM\Components
 */
class Breadcrumbs extends \WM\Base\Component
{
    protected static $componentName = 'bitrix:breadcrumb';
    protected static $params = array(
        'START_FROM' => '0',
        'PATH' => '',
        'SITE_ID' => SITE_ID,
    );
}