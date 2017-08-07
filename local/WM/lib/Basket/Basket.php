<?php

namespace WM\Basket;

use Bitrix\ABTest\Helper;
use \WM\Forms\Form,
    \WM\IBlock\Element;


class Basket extends \WM\Base\StaticInstance
{
    protected $basket = null;
    protected $currency = null;
    protected $lid = null;
    protected $fUserId = null;

    public function __construct()
    {
        //load modules
        $this->loadModules(array('sale', 'catalog', 'iblock'));

        //set variables
        $this->setVariables();
    }
    protected function loadModules(array $modules = array())
    {
        if(empty($modules))
            return ;
        foreach($modules as $module)
            \Bitrix\Main\Loader::includeModule($module);
    }
    protected function setVariables()
    {
        $this->lid = \Bitrix\Main\Context::getCurrent()->getSite();
        $this->currency = \Bitrix\Currency\CurrencyManager::getBaseCurrency();
        $this->fUserId = \Bitrix\Sale\Fuser::getId();

        $this->basket = \Bitrix\Sale\Basket::loadItemsForFUser($this->fUserId, $this->lid);
    }
    public function getFUserId()
    {
        return $this->fUserId;
    }

    public function getBasket()
    {
        return $this->basket;
    }

    public function getItemsCount()
    {
        return count($this->getBasket()->getQuantityList());
    }
    public function getGoodsCount()
    {
        return array_sum($this->getBasket()->getQuantityList());
    }

    public function add(array $items = array())
    {
        $basket = $this->getBasket();
        if(empty($basket))
            return false;

        $iblockId = null;
        $properties = array();
        foreach($items as $k => $itemInfo)
        {
            $quantity = empty($itemInfo['QUANTITY']) ? 1 : (int) $itemInfo['QUANTITY'];
            if ($item = $this->getBasketItem($itemInfo['PRODUCT_ID'])) {
                $item->setField('QUANTITY', $item->getQuantity() + $quantity);
            }
            else {
                $item = $basket->createItem('catalog', $itemInfo['PRODUCT_ID']);
                $fields = array(
                    'QUANTITY' => $quantity,
                    'CURRENCY' => (isset($itemInfo['CURRENCY']) ? $itemInfo['CURRENCY'] : $this->currency),
                    'LID' => (isset($itemInfo['LID']) ? $itemInfo['LID'] : $this->lid),
                    'PRODUCT_PROVIDER_CLASS' => '\\CCatalogProductProvider',
                );
                if(isset($itemInfo['PRICE']))
                {
                    $fields['PRICE'] = $itemInfo['PRICE'];
                    $fields['CUSTOM_PRICE'] = 'Y';
                }
                $item->setFields($fields);
            }
            if(!empty($itemInfo['PROPERTIES']))
            {

                if(empty($iblockId))
                    $iblockId = Element::getById($itemInfo['PRODUCT_ID']);
                if(empty($properties))
                {
                    $res = \CIBlockElement::GetProperty($iblockId, $itemInfo['PRODUCT_ID'], array(), array('CODE' => ['LENGTH_NEW', 'SIZE_NEW']));
                    while($ob = $res->GetNext())
                    {
                        $properties[$ob['CODE']] = array(
                            'NAME' => $ob['NAME'],
                            'CODE' => $ob['CODE'],
                            'VALUE' => '',
                            'SORT' => $ob['SORT'],
                        );
                    }
                }
                $addProps = array();
                foreach($itemInfo['PROPERTIES'] as $code => $value)
                {
                    if(isset($properties[$code]))
                    {
                        $properties[$code]['VALUE'] = $value;
                        $addProps[] = $properties[$code];
                    }
                }

                $item->getPropertyCollection()->setProperty($addProps);
            }
        }
        return $basket->save();
    }
    public function delete($itemIds = array())
    {
        $itemIds = (array) $itemIds;

        $basket = $this->getBasket();
        if(empty($basket))
            return false;
        foreach($itemIds as $id)
            $basket->getItemById($id)->delete();
        return $basket->save();
    }

    public function getBasketItems()
    {
        return $this->getBasket()->getBasketItems();
    }
    public function getBasketItemsWithFields($iblockId)
    {
        $items = $this->getBasketItems();
        $fields = array();

        foreach($items as $item)
            $fields[$item->getProductId()] = null;

        $fields = Element::getListD7($iblockId, array('filter' => array('ID' => array_keys($fields))));

        return array(
            'items' => $items,
            'fields' => $fields,
        );
    }
    public function getBasketItemsWithProps(array $propCodes)
    {
        $items = array();
        foreach($this->getBasket()->getBasketItems() as $item)
        {
            $props = array();
            foreach($propCodes as $propCode)
                $props[$propCode] = $item->getField($propCode);
            $items[$item->getId()] =$props;
        }
        return $items;
    }

    public function getBasketItem($productId)
    {
        foreach($this->getBasket() as $item)
            if($item->getProductId() == $productId)
                return $item;
        return false;
    }
    public function clear()
    {
        \CSaleBasket::DeleteAll();
    }

    public function fastOrderAction(Form $form, $iblockId, array $addParams, $messageId, array $messageParams=array(), $cp1251 = false)
    {
        if($form->validate())
        {
            $status = true;

            \Bitrix\Main\Loader::includeModule('iblock');

            $res = \CIBlockElement::GetByID((int) $form->getField('PRODUCT_ID'));
            if(!($row = $res->GetNext()))
                $status = false;

            $getFieldMethod = $cp1251 ? 'getFieldCP1251' : 'getField';

            $defMsgParams = array(
                'NAME' => $form->{$getFieldMethod}('NAME'),
                'PHONE' => $form->getField('PHONE'),
                'QUANTITY' => $form->getField('QUANTITY'),
                'PRODUCT' => $this->encodeWithCharset($row['NAME'], $cp1251),
                'PRODUCT_URL' => Helper::getFullUrl($row['DETAIL_PAGE_URL']),
            );
            foreach($defMsgParams as $k => $v)
                if(empty($messageParams[$k]))
                    $messageParams[$k] = $v;

            $status = $status && $form->sendMessage($messageId, $messageParams);

            $status = $status && $form->addRecord($iblockId, $addParams);

            if($status)
                return array('status' => $status);

            return array('errors' => $form->getErrors());
        }
        else
            return array('errors' => $form->getErrors());
    }

    public function getFormattedPrice()
    {
        return SaleFormatCurrency($this->getBasket()->getPrice(), $this->currency);
    }
    public function getFormattedBasePrice()
    {
        return SaleFormatCurrency($this->getBasket()->getBasePrice(), $this->currency);
    }

    public function addAction(array $data = array())
    {
        return $this->add(array($data));
    }

    public function deleteAction($data = array())
    {
        return $this->delete(array($data));
    }
    public function compareAction(array $data = array())
    {

    }

    public static function encodeWithCharset($value, $cp1251 = false)
    {
        return $cp1251 ? Helper::enc(Helper::utf8ToCP1251($value)) : Helper::enc($value);
    }
}