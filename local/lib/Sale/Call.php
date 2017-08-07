<?
namespace Local\Sale;

use Bitrix\Main\Loader;
use Local\Catalog\Offer;

/**
 * Class Call Обратный звонок
 * @package Local\Sale
 */
class Call
{
	/**
	 * ID инфоблока
	 */
	const IBLOCK_ID = 19;

	public static function add()
	{
		$id = 0;

		$name = trim(htmlspecialchars($_POST['NAME']));
		$phone = trim(htmlspecialchars($_POST['PHONE']));

		$errors = array();

		//check fields
		if(empty($name))
			$errors[] = 'Введите имя';
		if(empty($phone))
			$errors[] = 'Введите номер телефона';

		if (empty($errors))
		{
			$el = new \CIBlockElement();

			$fields = array(
				'IBLOCK_ID' => self::IBLOCK_ID,
				'NAME' => $name,
				'CODE' => $phone,
			);
			$id = $el->Add($fields);
			if ($id)
			{
				$eventFields = array(
					'AUTHOR' => $name,
					'TEXT' => 'Заказан звонок. Тел.: ' . $phone,
					'EMAIL_TO' => 'tim.kukom@gmail.com',
				);
				\CEvent::Send('FEEDBACK_FORM', 's1', $eventFields);
			}
			else
				$errors[] = 'Ошибка добавления заявки. Свяжитесь с администрацией';
		}
        return array(
            'gtmObject' => \WM\Seo\GTMFormSubmit::get()->setEvent()->setElementId('elFormPhone')->setElements(array($name, $phone))->getResult(),
            'errors' => implode('<br>', $errors),
            'id' => $id,
        );
	}

}