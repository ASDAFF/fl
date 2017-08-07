<?php

namespace WM\Forms;


/**
 * Class AjaxForm
 * @package WM\Forms
 */
class AjaxForm extends Form
{
    /**
     * @var null
     */
    protected $iblockId = null;

    /**
     * @param $event
     * @param array $data
     * @param string $siteId
     * @return bool
     */
    public function sendMessage($event, array $data, $siteId = 's1')
    {
        if(!\CEvent::Send($event, $siteId, $data))
        {
            $this->setError('email_send', 'Произошла ошибка при отправке сообщения');
            return false;
        }
        return true;
    }

    /**
     * @param $iblockId
     * @param array $data
     * @return bool
     */
    public function addRecord($iblockId, array $data)
    {
        if(empty($iblockId))
        {
            $this->setError('empty_iblock', 'Не указан инфоблок');
            return false;
        }

        \Bitrix\Main\Loader::IncludeModule('iblock');

        $el = new \CIBlockElement();

        if(!$el->Add(array_merge(array('IBLOCK_ID' => $iblockId), $data)))
        {
            $this->setError('add_record', 'Произошла ошибка при добавлени записи: ' . $el->LAST_ERROR);
            return false;
        }
        return true;
    }
}