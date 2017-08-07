<?php

namespace WM\Components;

/**
 * Class IncludeArea
 * @package WM\Components
 */
class IncludeArea extends \WM\Base\Component
{
    protected static $componentName = 'bitrix:main.include';
    protected static $params = array(
        'AREA_FILE_SHOW' => 'file',
        'PATH' => 'include/file.php',
    );
}
