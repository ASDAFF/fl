<?
namespace Local\Catalog;

use Bitrix\Main\Loader;
use Local\System\Http;

/**
 * Class Price Работа с ценами
 * @package Local\Catalog
 */
class Price
{
	private static $dataByUrl = [];

	/**
	 * @var Http
	 */
	private static $http;

	/**
	 * Функция-агент битрикса - обновляет цены с Я-магазина
	 * @return string
	 */
	public static function yaMagazinImport()
	{
		self::yaMagazinImportStart();
		return '\Local\Catalog::yaMagazinImport();';
	}

	private static function yaMagazinImportStart()
	{
		$host = 'http://www.ya-magazin.ru';
		self::$http = new Http();
		require($_SERVER['DOCUMENT_ROOT'] . '/local/lib/phpQuery-onefile.php');

		Loader::includeModule('catalog');

		$iblockElement = new \CIBlockElement();
		$pr = new \CPrice();

		$offers = Offer::getAll_(true);

		$prices = [];
		$res = \CPrice::GetList();
		while ($item = $res->Fetch())
			$prices[$item['PRODUCT_ID']] = $item;

		foreach ($offers['ITEMS'] as $offer)
		{
			$price = $prices[$offer['ID']];
			$price1 = $offer['PRICE_WO_DISCOUNT'];
			$priceP = $offer['PRICE_P'];

			$tmp = explode('|', $offer['CODE']);
			$href = $tmp[0];
			$url = $host . $href;
			$name = $offer['YA_NAME'];
			$newPrices = self::getPriceYaMagazin($url, $name);

			if (!$price)
			{
				$fields = [
					'PRODUCT_ID' => $offer['ID'],
					'PRICE' => $offer['PRICE'],
					'CATALOG_GROUP_ID' => 1,
					'CURRENCY' => 'RUB',
				];
				$x = $pr->Add($fields);
			}

		}


		foreach ($offers['ITEMS'] as $offer)
		{
			$update = [];
			if ($offer['PRICE'] != $offer['PRICE_WO_DISCOUNT'])
				$update['PRICE_WO_DISCOUNT'] = $offer['PRICE'];

			if ($update)
				$iblockElement->SetPropertyValuesEx($offer['ID'], 5, $update);
		}



	}

	private static function getPriceYaMagazin($url, $yaName)
	{

		if (self::$dataByUrl[$url])
		{
			$data = self::$dataByUrl[$url];
		}
		else
		{
			$data = self::$http->get($url);
			self::$dataByUrl[$url] = $data;
		}

		$doc = \phpQuery::newDocument($data);

		$trs = $doc->find('table.classic tr');
		foreach ($trs as $i => $tr)
		{
			if (!$i)
				continue;

			$row = pq($tr);
			$tds = $row->children('td');
			$name = '';
			$pr = 0;
			$prt = 0;
			foreach ($tds as $j => $tdi)
			{
				$td = pq($tdi);
				if ($j == 0)
				{
					$offerImg = $td->find('img');
					$font = $td->find('font');
					$font->remove();
					$td->find('.just_bt')->remove();
					$offerImg->remove();
					$name = $td->text();
				}
				elseif ($j == 2)
				{
					$price = $td->find('input[name=price]');
					$pr = intval($price->attr('value'));
					$priceTax = $td->find('.div_taxes');
					$prt = intval($priceTax->text());
				}
			}

			if ($name == $yaName)
			{
				return [
					'PRICE' => $pr,
					'PRICE_P' => $prt,
				];
			}
		}

		return [];
	}
}
