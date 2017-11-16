<?
namespace Local\Catalog;

/**
 * Class Filter Панель фильтров, формирование свойств страницы, в зависимости от выбранных фильтров
 * @package Local\Catalog
 */
class Filter
{
	/**
	 * Путь для кеширования
	 */
	const CACHE_PATH = 'Local/Catalog/Filter/';

	/**
	 * Разделитель вариантов в URL
	 */
	const SEPARATOR = '/';

	/**
	 * @var array Полная структура панели фильтров
	 */
	private static $GROUPS = [];

	/**
	 * @var array Фильтры для выборки элементов
	 */
	private static $FILTER_BY_KEY = [];

	/**
	 * @var array Информация по элементам, выбранным по фильтрам
	 */
	private static $DATA_BY_KEY = [];

	/**
	 * @var string Ключ фильтра
	 */
	private static $PRODUCTS_KEY = [];

	/**
	 * @var bool неверный урл
	 */
	private static $e404 = false;

	/**
	 * Возвращает данные для построения панели фильтров, хлебные крошки и ID отфильтрованных элементов
	 * @param array $searchIds элементы, отфильтрованные поисковым запросом
	 * @param string $searchQuery
	 * @param array $urlParams
	 * @return array
	 */
	public static function getData($searchIds = [], $searchQuery = '', $urlParams = [])
	{
		// Получаем все свойства для фильтров в сгруппированном виде
		self::$GROUPS = self::getGroups();
		// Помечаем выбранные пользователем варианты
		$cnt = self::setChecked($urlParams);
		if (self::$e404)
			return ['404' => true];
		// Формируем фильтры для каждого свойства, чтобы отсеять варианты с учетом пользовательских фильтров
		self::getUserFilter($searchIds);
		// Получаем элементы для всех фильтров
		self::getProductsByFilters();
		// Скрываем варианты, которые не попали в пользовательский фильтр
		self::hideVars();

		// Возвращаем данные в компонент
		return [
			// Данные для построения панели
			'GROUPS' => self::$GROUPS,
			// Количество выбранных фильтров
			'CHECKED_CNT' => $cnt,
			// Разделитель
			'SEPARATOR' => self::SEPARATOR,
			// Фильтер для товаров на странице
			'PRODUCTS_FILTER' => self::$FILTER_BY_KEY[self::$PRODUCTS_KEY],
			// Хлебные крошки
			'BC' => self::getBreadCrumb($searchQuery),
			// Плашки выбранных фильтров
			'CUR_FILTERS' => self::getCurrentFilters($searchQuery),
			// Seo
			'SEO' => self::getSeoValues($searchQuery),
			// текущий урл
			'URL' => self::getUrlWithoutGroup($searchQuery),
		];
	}

	/**
	 * Возвращает все свойства, которые участвуют в фильтрации каталога
	 * @return array
	 */
	public static function getGroups()
	{
		$return = [];

		$return[] = [
			'NAME' => 'Цена',
			'TYPE' => 'price',
		];
		$return[] = [
			'NAME' => 'Производитель',
			'TYPE' => 'brand',
			'BC' => true,
			'ITEMS' => Brand::getGroup(),
			'MULTI' => true,
			'MAX' => 6,
		];
		$return[] = [
			'NAME' => 'Страна',
			'TYPE' => 'country',
			'ITEMS' => Country::getGroup(),
			'MULTI' => true,
			'MAX' => 6,
		];
		$return[] = [
			'NAME' => 'Категория',
			'TYPE' => 'category',
			'BC' => true,
			'TREE' => Section::getTree(),
			'ITEMS' => Section::getGroup(),
			'MULTI' => true,
		];
		$flags = Flags::getAll();
		foreach ($flags as $name => $items)
			$return[] = array(
				'NAME' => $name,
				'ITEMS' => $items,
			);
		$return[] = [
			'NAME' => 'Порода дерева',
			'TYPE' => 'country',
			'ITEMS' => Wood::getGroup(),
			'MULTI' => true,
			'MAX' => 6,
		];
		$return[] = [
			'NAME' => 'Цвет',
			'TYPE' => 'color',
			'ITEMS' => Color::getGroup(),
			'MULTI' => true,
			'MAX' => 16,
		];
		$return[] = [
			'NAME' => 'Класс защиты',
			'TYPE' => 'protection',
			'ITEMS' => Protection::getGroup(),
			'MULTI' => true,
		];
		$return[] = [
			'NAME' => 'Вид рисунка',
			'TYPE' => 'picture',
			'ITEMS' => Pkind::getGroup(),
			'MULTI' => true,
		];
		$return[] = [
			'NAME' => 'Тип замка',
			'TYPE' => 'joint',
			'ITEMS' => Joint::getGroup(),
			'MULTI' => true,
		];

		return $return;
	}

	/**
	 * По текущему URL определяет какие из вариантов фильтров нажаты
	 * @param $urlParams
	 * @return int
	 */
	private static function setChecked($urlParams)
	{
		$url = urldecode($_SERVER['REQUEST_URI']);
		$urlDirs = explode('/', $url);

		$urlCodes = [];
		for ($i = 2; $i < count($urlDirs) - 1; $i++)
		{
			$parts = explode(self::SEPARATOR, $urlDirs[$i]);
			foreach ($parts as $part)
				$urlCodes[$part] = true;
		}

		$allCnt = 0;
		foreach (self::$GROUPS as &$group)
		{
			$cnt = 0;
			if ($group['TYPE'] == 'price')
			{
				if (isset($urlParams['p-from']))
				{
					$group['FROM'] = intval($urlParams['p-from']);
					$cnt++;
				}
				if (isset($urlParams['p-to']))
				{
					$group['TO'] = intval($urlParams['p-to']);
					$cnt++;
				}
			}
			else
			{
				foreach ($group['ITEMS'] as $code => &$item)
				{
					if ($urlCodes[$code])
					{
						$item['CHECKED'] = true;
						$cnt++;
						unset($urlCodes[$code]);
					}
				}
				unset($item);
			}

			if ($group['TYPE'] == 'category')
				self::setChildrenChecked($group['TREE'], $group['ITEMS']);

			$group['CHECKED_CNT'] = $cnt;
			$allCnt += $cnt;
		}
		unset($group);

		if ($urlCodes)
			self::$e404 = true;

		return $allCnt;
	}

	/**
	 * Устанавливает всем потомках статус
	 * @param $section
	 * @param $items
	 * @param bool $parentChecked
	 */
	private static function setChildrenChecked(&$section, &$items, $parentChecked = false)
	{
		$checked = false;
		if ($section['NAME'])
		{
			$code = $section['CODE'];
			$checked = $items[$code]['CHECKED'] || $parentChecked;
			$section['TREE_CHECKED'] = $checked;
			$items[$code]['TREE_CHECKED'] = $checked;
		}

		foreach ($section['ITEMS'] as &$sect)
			self::setChildrenChecked($sect, $items, $checked);
		unset($sect);
	}

	/**
	 * Формирует фильтры для каждого свойства, чтобы отсеять варианты с учетом пользовательских фильтров
	 * @param array $searchIds
	 */
	public static function getUserFilter($searchIds = [])
	{
		// Коды свойств, участвующие в фильтрации
		// По ключу _PRODUCTS будет фильтр по всем свойствам, т.е. итоговый фильтр для элементов
		$codes = [
			'_ALL' => '_ALL',
			'_PRODUCTS' => '_PRODUCTS',
			'PRICE' => 'PRICE',
		];
		foreach (self::$GROUPS as $group)
		{
			foreach ($group['ITEMS'] as $item)
				$codes[$item['CODE']] = $item['CODE'];
		}

		// Формируем фильтры для каждого свойства, некоторые могут оказаться одинаковыми
		$filters = [];
		foreach ($codes as $code)
		{
			$filters[$code] = [
				'KEY' => '',
				'DATA' => [],
			];

			if ($code == '_ALL')
				continue;

			if ($searchIds)
			{
				$filters[$code]['KEY'] = 'search';
				$filters[$code]['DATA']['ID'] = $searchIds;
			}

			foreach (self::$GROUPS as $group)
			{
				if ($group['TYPE'] == 'price')
				{
					if ('PRICE' == $code)
						continue;

					if (isset($group['FROM']))
					{
						$filters[$code]['DATA']['PRICE']['FROM'] = $group['FROM'];
						$filters[$code]['KEY'] .= '|f#' . $group['FROM'];
					}
					if (isset($group['TO']))
					{
						$filters[$code]['DATA']['PRICE']['TO'] = $group['TO'];
						$filters[$code]['KEY'] .= '|t#' . $group['TO'];
					}
				}
				else
				{
					foreach ($group['ITEMS'] as $item)
					{
						if ($item['CODE'] == $code)
							continue;

						if ($item['CHECKED'])
						{
							if ($group['MULTI'])
							{
								$filters[$code]['DATA'][$item['CODE']][$item['ID']] = $item['ID'];
								$filters[$code]['KEY'] .= '|c' . $item['ID'];
							}
							else
							{
								$filters[$code]['DATA'][$item['CODE']] = true;
								$filters[$code]['KEY'] .= '|' . $item['CODE'];
							}
						}
					}
				}
			}
		}

		self::$FILTER_BY_KEY = [];
		foreach ($codes as $code)
		{
			$key = $filters[$code]['KEY'];
			self::$FILTER_BY_KEY[$key] = $filters[$code]['DATA'];
		}

		// Теперь полученные фильтры добавим обратно в свойства
		foreach (self::$GROUPS as &$group)
		{
			if ($group['TYPE'] == 'price')
				$group['KEY'] = $filters['PRICE']['KEY'];
			else
			{
				foreach ($group['ITEMS'] as &$item)
					$item['KEY'] = $filters[$item['CODE']]['KEY'];
				unset($item);
			}
		}
		unset($group);

		// Общий фильтр
		self::$PRODUCTS_KEY = $filters['_PRODUCTS']['KEY'];
	}

	/**
	 * Получаем данные для всех фильтров
	 */
	public static function getProductsByFilters()
	{
		self::$DATA_BY_KEY = [];
		foreach (self::$FILTER_BY_KEY as $key => $filter)
			self::$DATA_BY_KEY[$key] = Offer::getDataByFilter($filter);
	}

	/**
	 * Помечаем скрытыми варианты свойств, которых нет среди товаров, отфильтрованных пользователем
	 * (выставляем количество товаров CNT, если оно = 0, то вариант считается скрытым)
	 */
	public static function hideVars()
	{
		foreach (self::$GROUPS as &$group)
		{
			$cntGroup = 0;

			if ($group['TYPE'] == 'price')
			{
				// Цены - для всех товаров
				$data = self::$DATA_BY_KEY[''];
				$group['MIN'] = floor($data['PRICE']['MIN'] / 100) * 100;
				$group['MAX'] = ceil($data['PRICE']['MAX'] / 100) * 100;
				$cntGroup = $group['MIN'] == $group['MAX'] ? 0 : 1;
			}
			else
			{
				foreach ($group['ITEMS'] as &$item)
				{
					$data = self::$DATA_BY_KEY[$item['KEY']];
					if ($group['MULTI'])
						$item['CNT'] = intval($data[$item['CODE']][$item['ID']]);
					else
						$item['CNT'] = intval($data[$item['CODE']]);

					$data = self::$DATA_BY_KEY[''];
					if ($group['MULTI'])
						$item['ALL_CNT'] = intval($data[$item['CODE']][$item['ID']]);
					else
						$item['ALL_CNT'] = intval($data[$item['CODE']]);

					$cntGroup += $item['CNT'];
				}
				unset($item);

				// выбранные элементы наверх
				if ($group['MAX'])
				{
					$items1 = [];
					$items2 = [];
					foreach ($group['ITEMS'] as $code => $item)
						if ($item['CHECKED'])
							$items1[$code] = $item;
						else
							$items2[$code] = $item;

					uasort($items2, 'self::cntCmp');

					$group['ITEMS'] = [];
					foreach ($items1 as $code => $item)
						$group['ITEMS'][$code] = $item;
					foreach ($items2 as $code => $item)
						$group['ITEMS'][$code] = $item;
				}
			}

			$group['CNT'] = $cntGroup;
		}
		unset($group);
	}

	public static function cntCmp($a, $b)
	{
		return $b['CNT'] - $a['CNT'];
	}

	/**
	 * Формирует массив для добавления в хлебные крошки
	 * @param $searchQuery
	 * @return array
	 */
	private static function getBreadCrumb($searchQuery)
	{
		$href = CATALOG_PATH;
		$return = [];

		if ($searchQuery)
			$return[] = [
				'NAME' => 'Результаты поиска',
				'HREF' => $href . '?q=' . $searchQuery,
			];

		foreach (self::$GROUPS as $group)
		{
			if (!$group['CNT'])
				continue;

			if (!$group['BC'])
				continue;

			$cnt = 0;
			$singleCode = '';

			foreach ($group['ITEMS'] as $code => $item)
			{
				if ($item['CHECKED'] && $item['CNT'])
				{
					$singleCode = $code;
					$cnt++;
				}
			}

			if ($cnt == 1)
			{
				$item = $group['ITEMS'][$singleCode];
				$href .= $singleCode . '/';
				$return[] = [
					'NAME' => $item['NAME'],
					'HREF' => $href,
				];
			}
		}

		return $return;
	}

	/**
	 * Возвращает url для быстрых плашек
	 * @param string $searchQuery
	 * @param bool $groupKey
	 * @return string
	 */
	private static function getUrlWithoutGroup($searchQuery = '', $groupKey = false)
	{
		$href = CATALOG_PATH;
		$params = '';

		if ($searchQuery)
		{
			$params .= $params ? '&' : '?';
			$params .= 'q=' . $searchQuery;
		}

		foreach (self::$GROUPS as $key => $group)
		{
			if ($groupKey === $key)
				continue;

			if ($group['TYPE'] == 'price')
			{
				if (isset($group['FROM']) && $group['FROM'] > $group['MIN'])
				{
					$params .= $params ? '&' : '?';
					$params .= 'p-from=' . $group['FROM'];
				}
				if (isset($group['TO']) && $group['TO'] < $group['MAX'])
				{
					$params .= $params ? '&' : '?';
					$params .= 'p-to=' . $group['TO'];
				}
			}
			else
			{
				$part = '';
				foreach ($group['ITEMS'] as $code => $item)
				{
					if ($item['CHECKED'])
					{
						if ($part)
							$part .= self::SEPARATOR;
						$part .= $code;
					}
				}
				if ($part)
					$href .= $part . '/';
			}
		}

		return $href . $params;
	}

	/**
	 * Формирует массив для отображения плашек выбранных фильтров
	 * @param $searchQuery
	 * @return array
	 */
	private static function getCurrentFilters($searchQuery)
	{
		$return = [];

		if ($searchQuery)
		{
			$return[] = [
				'NAME' => '<b>Поиск</b>: ' . $searchQuery,
				'HREF' => self::getUrlWithoutGroup(),
			];
		}

		foreach (self::$GROUPS as $key => $group)
		{
			if (!$group['CNT'])
				continue;

			$name = '';
			if ($group['TYPE'] == 'price')
			{
				if (isset($group['FROM']) && $group['FROM'] > $group['MIN'])
					$name = 'от ' . $group['FROM'];
				if (isset($group['TO']) && $group['TO'] < $group['MAX'])
					$name .= ' до ' . $group['TO'];
			}
			else
			{
				foreach ($group['ITEMS'] as $code => $item)
				{
					if ($item['CHECKED'])
					{
						if ($group['TYPE'] == 'color')
						{
							$bg = 'background:#' . $code;
							$name .= '<b class="color"><span style="' . $bg . '"></span></b>';
						}
						else
						{
							if ($name)
								$name .= ', ';
							$name .= $item['NAME'];
						}
					}
				}
			}
			if ($name)
			{
				$return[] = [
					'NAME' => '<b>' . $group['NAME'] . '</b>: ' . $name,
					'HREF' => self::getUrlWithoutGroup($searchQuery, $key),
				];
			}
		}

		return $return;
	}

	/**
	 * Формирует данные для Seo
	 * @param $searchQuery
	 * @return array
	 */
	private static function getSeoValues($searchQuery)
	{
		if ($searchQuery)
		{
			return [
				'H1' => 'Результаты поиска по запросу «' . $searchQuery . '»',
				'TITLE' => 'Результаты поиска по запросу «' . $searchQuery . '»',
			];
		}

		$name = 'Все товары';
		$suffix = '';
		$prefix = '';

		$href = CATALOG_PATH;
		$parts = [];

		foreach (self::$GROUPS as $group)
		{
			if (!$group['CNT'])
				continue;

			$itemsCnt = 0;
			$lastItem = false;
			$part = '';
			foreach ($group['ITEMS'] as $code => $item)
			{
				if ($item['CHECKED'] && $item['CNT'])
				{
					if ($part)
						$part .= self::SEPARATOR;
					$part .= $code;
					$itemsCnt++;
					$lastItem = $item;
				}
			}
			if ($part)
			{
				$href .= $part . '/';
				$parts[] = $part;
			}

			if (!$itemsCnt)
				continue;

			if ($group['TYPE'] == 'category')
			{
				if ($itemsCnt == 1)
					$name = $lastItem['NAME'];
			}

			if ($group['TYPE'] == 'brand')
			{
				if ($itemsCnt == 1)
					$suffix .= ' ' . $lastItem['NAME'];
			}
			if ($group['TYPE'] == 'country')
			{
				if ($itemsCnt == 1)
					$suffix .= ' ' . $lastItem['NAME'];
			}
			if ($group['TYPE'] == 'wood')
			{
				if ($itemsCnt == 1)
					$suffix .= ' ' . $lastItem['NAME'];
			}

		}

		if ($prefix)
			$name = strtolower($name);

		$h1 = $prefix . $name . $suffix;
		$title = $h1;
		$description = $h1;
		$text = '';
		$noindex = false;

		return [
			'H1' => $h1,
			'TITLE' => $title,
			'DESCRIPTION' => $description,
			'TEXT' => $text,
			'URL' => $href,
			'PARTS' => $parts,
			'NOINDEX' => $noindex,
		];
	}

}