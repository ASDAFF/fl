<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams */

$sections = \Local\Catalog\Section::getAll();

?>
<div class="footer-widget-col col-md-3 col-sm-6">
    <div class="widget widget_text">
        <div class="textwidget">
            <ul class="address">
                <li>
                    <i class="fa fa-home"></i>
                    <h4>Адрес:</h4>
                    <p>г. Москва,<br />ул. Малый Лёвшинский пер., д. 10</p>
                </li>
                <li>
                    <i class="fa fa-mobile"></i>
                    <h4>Телефоны:</h4>
                    <p>+7 (929) 932 42 30<br />+7 (495) 532 79 74</p>
                </li>
                <li>
                    <i class="fa fa-envelope"></i>
                    <h4>Email:</h4>
                    <p><a href="mailto:info@veleslife.ru">info@veleslife.ru</a></p>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="footer-widget-col col-md-3 col-sm-6">
    <div class="widget widget_nav_menu">
        <h3 class="widget-title">
            <span>Информация</span>
        </h3>
        <div class="menu-infomation-container">
            <ul class="menu">
                <li><a href="/about/">О компании</a></li>
                <li><a href="/about/contacts/">Контакты</a></li>
                <li><a href="/about/delivery/">Доставка</a></li>
                <li><a href="/about/guaranty/">Гарантия</a></li>
                <li><a href="/about/howto/">Как купить?</a></li>
            </ul>
        </div>
    </div>
</div><?

$category = \Local\Catalog\Section::getByCode('wood');
?>
<div class="footer-widget-col col-md-3 col-sm-6">
    <div class="widget widget_nav_menu">
        <h3 class="widget-title">
            <span><?= $category['NAME'] ?></span>
        </h3>
        <div class="menu-customer-care-container">
            <ul class="menu"><?

				foreach ($category['ITEMS'] as $id)
				{
					$item = \Local\Catalog\Section::getById($id);
					?>
                    <li><a href="<?= CATALOG_PATH ?><?= $item['CODE'] ?>/"><?= $item['NAME'] ?></a></li><?
				}

				?>
            </ul>
            <!--
            <h3 class="widget-title">
                <span>payment Menthod</span>
            </h3>
            <div class="payment">
                <a href="#"><i class="fa fa-cc-mastercard"></i></a>
                <a href="#"><i class="fa fa-cc-visa"></i></a>
                <a href="#"><i class="fa fa-cc-paypal"></i></a>
                <a href="#"><i class="fa fa-cc-discover"></i></a>
                <a href="#"><i class="fa fa-credit-card"></i></a>
                <a href="#"><i class="fa fa-cc-amex"></i></a>
            </div>
             -->
        </div>
    </div>
</div><?

$category = \Local\Catalog\Section::getByCode('floor');
?>
<div class="footer-widget-col col-md-3 col-sm-6">
    <div class="widget widget_nav_menu">
        <h3 class="widget-title">
            <span>Другие покрытия</span>
        </h3>
        <div class="menu-customer-care-container">
            <ul class="menu"><?

				foreach ($category['ITEMS'] as $id)
				{
					$item = \Local\Catalog\Section::getById($id);
					if ($item['CODE'] == 'wood')
						continue;

					?>
                    <li><a href="<?= CATALOG_PATH ?><?= $item['CODE'] ?>/"><?= $item['NAME'] ?></a></li><?
				}

				?>
            </ul>
        </div>
    </div>
</div><?

/*
?>
<div class="footer-widget-col col-md-3 col-sm-6">
    <div class="widget widget_text">
        <h3 class="widget-title">
            <span>open house</span>
        </h3>
        <div class="textwidget">
            <ul class="open-time">
                <li><span>Mon - Fri:</span><span>8am - 5pm</span> </li>
                <li><span>Sat:</span><span>8am - 11am</span> </li>
                <li><span>Sun: </span><span>Closed</span></li>
            </ul>
            <h3 class="widget-title">
                <span>payment Menthod</span>
            </h3>
            <div class="payment">
                <a href="#"><i class="fa fa-cc-mastercard"></i></a>
                <a href="#"><i class="fa fa-cc-visa"></i></a>
                <a href="#"><i class="fa fa-cc-paypal"></i></a>
                <a href="#"><i class="fa fa-cc-discover"></i></a>
                <a href="#"><i class="fa fa-credit-card"></i></a>
                <a href="#"><i class="fa fa-cc-amex"></i></a>
            </div>
        </div>
    </div>
</div><?*/
