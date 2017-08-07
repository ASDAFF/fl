<?php

namespace WM\Base;

use \Wm\Common\App,
    \Wm\Common\Helper;

/**
 * Class Markup
 * @package WM\Base
 */
abstract class Markup extends StaticInstance
{
    /**
     * @var array of meta properties
     */
    protected $info = array();

    /**
     * @var string prefix of name (e.g. og:...)
     */
    protected static $PREFIX = '';

    /**
     * @var bool setItems called ?
     */
    protected $fromArray = false;

    /**
     * @override
     * @return void set prefix of name (e.g. og:...)
     */
    abstract function setPrefix();

    /**
     * Markup constructor.
     * @param array $data
     */
    public function __construct(array $data = array())
    {
        $this->setPrefix();

        empty($data) || $this->setItems($data);
    }

    /**
     * @param $type
     * @param $content
     * @return $this
     */
    public function setItem($type, $content)
    {
        $this->info[Helper::enc($type)] = Helper::enc($content);
        $this->fromArray || $this->checkItems();

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setItems(array $data = array())
    {
        $this->fromArray = true;
        foreach($data as $type => $content)
            $this->setItem($type, $content);
        $this->checkItems();
        $this->fromArray = false;

        return $this;
    }

    /**
     * @param string $name
     */
    public function setViewContent($name = 'opengraph', $content = null)
    {
        App::get()->AddViewContent($name, (isset($content) ? $content : $this->getMeta(true)));
    }

    /**
     * @param string $name
     */
    public function show($view = 'opengraph')
    {
        App::get()->ShowViewContent($view);
    }

    /**
     * @param $image
     * @param string $view
     * @return $this
     */
    public function setImage($image, $view = 'opengraph_img')
    {
        $this->setViewContent($view, $image);
        return $this;
    }
    /**
     * @param null $defValue
     * @param string $view
     * @return null|string
     */
    public function getImage($defValue, $view = 'opengraph_img')
    {
        $image = App::get()->GetViewContent($view);
        return trim($image) === '' ? $defValue : $image;
    }
    /**
     * @param $type
     * @return bool|mixed
     */
    public function getItem($type)
    {
        return isset($this->info[$type]) ? $this->info[$type] : false;
    }

    /**
     * @param $type
     * @return bool|string
     */
    public function getItemMeta($type)
    {
        $item = $this->getItem($type);
        if(!$item)
            return false;
        return $this->format($type, $item);
    }

    /**
     * @param bool $return
     * @return string|void
     */
    public function getMeta($return = false)
    {
        $ret = '';
        foreach($this->info as $type => $content)
            $ret .= $this->format($type, $content) . PHP_EOL;
        $ret .= PHP_EOL;
        if($return)
            return $ret;
        echo $ret;
    }

    /**
     *
     */
    protected function checkItems()
    {
        if(isset($this->info['title'], $this->info['title2']))
        {
            if(empty($this->info['title']) && !empty($this->info['title2']))
                $this->info['title'] = $this->info['title2'];
            unset($this->info['title2']);
        }
    }

    /**
     * @param $type
     * @param $content
     * @return string
     */
    protected function format($type, $content)
    {
        return '<meta name="' . static::$PREFIX . $type . '" content="' . $content . '" />';
    }
}