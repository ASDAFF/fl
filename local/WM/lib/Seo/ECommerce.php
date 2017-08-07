<?php

namespace WM\Seo;

use \WM\Common\App,
    \WM\Common\Helper;

\Bitrix\Main\Loader::includeModule('sale');
\Bitrix\Main\Loader::includeModule('iblock');

/**
 * Class ECommerce
 * @package WM\Seo
 */
class ECommerce extends \WM\Base\StaticInstance
{
    /**
     * @var loaded order
     */
    protected $order = null;
    /**
     * @var iblock id
     */
    protected $iblockId = null;

    /**
     * @var array of order properties
     */
    protected $properties = array();
    /**
     * @var array of product categories
     */
    protected $categories = array();
    /**
     * @var array of products
     */
    protected $products = array();

    /**
     * @var pay system name
     */
    protected $paySystemName = null;

    /**
     * @var delivery system name
     */
    protected $deliveryName = null;


    /**
     * @param $iblockId id of iblock
     */
    public function setIblockId($iblockId)
    {
        $this->iblockId = $iblockId;
        return $this;
    }

    /**
     * @param $orderId id of order
     * @return $this
     */
    public function load($orderId)
    {
        $this->order = \Bitrix\Sale\Order::load((int) $orderId);
        return $this;
    }

    /**
     * @param $orderNumber account number of order
     * @return $this
     */
    public function loadByAccNumber($orderNumber)
    {
        $this->order = \Bitrix\Sale\Order::loadByAccountNumber($orderNumber);
        return $this;
    }

    /**
     * @return array of order properties
     */
    public function getOrderProps()
    {
        //check order loaded
        $this->checkOrder();

        $ret = array();
        $this->properties = $this->order->getPropertyCollection();
        if(empty($this->properties))
            return $ret;
        foreach($this->properties->getArray()['properties'] as $prop)
            $ret[$prop['CODE']] = current($prop['VALUE']);
        return $ret;
    }

    /**
     * @param bool $needUpdate
     * @return name of pay system
     */
    public function getPaymentName($needUpdate = false)
    {
        //check order loaded
        $this->checkOrder();

        if(empty($this->paySystemName) || $needUpdate)
        {
            $paySystem = $this->order->getPaymentCollection();
            foreach ($paySystem as $payment)
            {
                $this->paySystemName = $payment->getPaymentSystemName();
                break;
            }
        }
        return $this->paySystemName;
    }

    /**
     * @param bool $needUpdate
     * @return name of delivery system
     */
    public function getDeliveryName($needUpdate = false)
    {
        //check order loaded
        $this->checkOrder();

        if(empty($this->deliveryName) || $needUpdate)
        {
            $deliveryIds = $this->order->getDeliverySystemId();
            foreach ($deliveryIds as $deliveryId)
            {
                $delivery = \Bitrix\Sale\Delivery\Services\Manager::getById((int) $deliveryId);
                $this->deliveryName = empty($delivery['NAME']) ? 'Доставка курьером' : $delivery['NAME'];
                break;
            }
        }
        return $this->deliveryName;
    }

    /**
     * @param bool $needUpdate
     * @throws \Exception
     * @return array
     */
    public function getProductCategories($needUpdate = false)
    {
        //check iblock id
        if(empty($this->iblockId))
            throw new \Exception('Wrong IBLOCK');

        //check order loaded
        $this->checkOrder();

        if(empty($this->categories) || $needUpdate)
        {
            //get all product categories
            $this->categories = array();
            foreach ($this->order->getBasket() as $item)
            {
                $this->categories[$item->getProductId()] = null;
            }
            $res = \Bitrix\Iblock\ElementTable::getList(array(
                'filter' => array('IBLOCK_ID' => $this->iblockId, 'ID' => array_keys($this->categories)),
                'select' => array('IBLOCK_SECTION.NAME', 'ID'),
            ));
            while ($row = $res->fetch())
                $this->categories[$row['ID']] = $row['IBLOCK_ELEMENT_IBLOCK_SECTION_NAME'];
        }
        return $this->categories;
    }

    /**
     * @param bool $needUpdate
     * @return array
     */
    public function getProducts($needUpdate = false)
    {
        //check order loaded
        $this->checkOrder();

        if(empty($this->products) || $needUpdate)
        {
            $this->products = array();
            $categories = $this->getProductCategories($needUpdate);
            foreach ($this->order->getBasket() as $item)
            {
                $this->products[] = array(
                    'sku' => $item->getProductId(),
                    'name' => $item->getField('NAME'),
                    'category' => $categories[$item->getProductId()],
                    'price' => $item->getPrice(),
                    'quantity' => $item->getQuantity(),
                );
            }
        }
        return $this->products;
    }

    /**
     * @param bool $needUpdate
     * @return array
     */
    public function getGoogleCode($needUpdate = false)
    {
        //check order loaded
        $this->checkOrder();

        $props = $this->getOrderProps($needUpdate);
        return array(
            'event' => 'ecomEvent',
            'fio' => (empty($props['NAME']) ? $props['COMPANY'] : $props['NAME']),
            'email' => $props['EMAIL'],
            'phone' => $props['PHONE'],
            'address' => $props['ADDRESS'],
            'comment' => (empty($this->order->getField('USER_DESCRIPTION')) ? $this->order->getField('COMMENTS') : $this->order->getField('USER_DESCRIPTION')),
            'delivery' => $this->getDeliveryName($needUpdate),
            'pay_system' => $this->getPaymentName($needUpdate),
            'transactionId' => $this->order->getId(),
            'transactionTotal' => $this->order->getPrice(),
            'transactionProducts' => $this->getProducts($needUpdate),
        );
    }

    /**
     * @param bool $needUpdate
     * @return array
     */
    public function getYandexCode($needUpdate = false)
    {
        //check order loaded
        $this->checkOrder();

        return array(
            'ecommerce' => array(
                'purchase' => array(
                    'actionField' => array(
                        'id' => $this->order->getId(),
                    ),
                    'products' => $this->getProducts($needUpdate),
                ),
            ),
        );
    }

    /**
     * @param bool $return
     * @param bool $needUpdate
     * @return string
     */
    public function jsonResult($return = false, $needUpdate = false)
    {
        $ret  = '<script type="text/javascript">window.dataLayer = window.dataLayer || [];' . PHP_EOL;
        $ret .= 'dataLayer.push(' . Helper::getJson($this->getGoogleCode($needUpdate)) . ');' . PHP_EOL;
        $ret .= 'dataLayer.push(' . Helper::getJson($this->getYandexCode($needUpdate)) . ');' . PHP_EOL;
        $ret .= '</script>' . PHP_EOL;
        if($return)
            return $ret;
        echo $ret;
    }
    /**
     * @param string $name
     */
    public function setViewContent($name = 'ecommerce', $content = null)
    {
        App::get()->AddViewContent($name, (isset($content) ? $content : $this->jsonResult(true)));
    }

    /**
     * @param string $name
     */
    public function show($view = 'ecommerce')
    {
        App::get()->ShowViewContent($view);
    }

    /**
     * @throws \Exception
     */
    protected function checkOrder()
    {
        if(empty($this->order))
            throw new \Exception('Order not loaded');
    }
}