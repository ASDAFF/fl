<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/** @var CMain $APPLICATION */
/** @var CUser $USER */
$isCatalog = defined('CATALOG_PAGES') && CATALOG_PAGES === true;
$isIndex = defined('INDEX_PAGE') && INDEX_PAGE === true;
$isCart = defined('CART_PAGE') && CART_PAGE === true;
$isAuthorized = $USER->IsAuthorized();

?><!doctype html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head><?

	$APPLICATION->IncludeComponent('bitrix:main.include', '', [
		'AREA_FILE_SHOW' => 'file',
		'PATH' => '/include/head_top.php'
	]);

    ?>
    <meta name="geo.placename" content="Малый Левшинский пер., 10, Москва, Россия, 119034" />
    <meta name="geo.position" content="55.7417850;37.5903110" />
    <meta name="geo.region" content="RU-" />
    <meta name="ICBM" content="55.7417850, 37.5903110" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<title><? $APPLICATION->ShowTitle() ?></title>
	<link rel="shortcut icon" href="/favicon.png"><?

	$APPLICATION->ShowHead();

	$assets = \Bitrix\Main\Page\Asset::getInstance();
	$assets->addCss('/css/settings.css');
	$assets->addCss('/css/bootstrap.min.css');
	$assets->addCss('/css/swatches-and-photos.css');
	$assets->addCss('/css/prettyPhoto.css');
	$assets->addCss('/css/jquery.selectBox.css');
	$assets->addCss('/css/font-awesome.min.css');
	$assets->addCss('https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic');
	$assets->addCss('https://fonts.googleapis.com/css?family=Roboto+Condensed:400,400i,700,700i&amp;subset=cyrillic');
	$assets->addCss('/css/elegant-icon.css');
    $assets->addCss('/css/cs-select.css');
    $assets->addCss('/css/cs-skin-elastic.css');
	$assets->addCss('/css/style.css');
	$assets->addCss('/css/commerce.css');
	$assets->addCss('/css/custom.css');
	$assets->addCss('/css/magnific-popup.css');


	$assets->addJs('/js/jquery.js');
	$assets->addJs('/js/jquery-migrate.min.js');
	$assets->addJs('/js/jquery.themepunch.tools.min.js');
	$assets->addJs('/js/jquery.themepunch.revolution.min.js');
	$assets->addJs('/js/easing.min.js');
	$assets->addJs('/js/imagesloaded.pkgd.min.js');
	$assets->addJs('/js/bootstrap.min.js');
	$assets->addJs('/js/superfish-1.7.4.min.js');
	$assets->addJs('/js/jquery.appear.min.js');
	$assets->addJs('/js/script.js');
	$assets->addJs('/js/swatches-and-photos.js');
	$assets->addJs('/js/jquery.cookie.min.js');
	$assets->addJs('/js/jquery.prettyPhoto.js');
	$assets->addJs('/js/jquery.prettyPhoto.init.min.js');
	$assets->addJs('/js/jquery.selectBox.min.js');
	$assets->addJs('/js/jquery.touchSwipe.min.js');
	$assets->addJs('/js/jquery.transit.min.js');
	$assets->addJs('/js/jquery.carouFredSel.js');
	$assets->addJs('/js/jquery.magnific-popup.js');
	$assets->addJs('/js/isotope.pkgd.min.js');
	$assets->addJs('/js/jquery.parallax.js');
	$assets->addJs('/js/core.min.js');
	$assets->addJs('/js/widget.min.js');
	$assets->addJs('/js/mouse.min.js');
	$assets->addJs('/js/slider.min.js');
	$assets->addJs('/js/jquery-ui-touch-punch.min.js');
	$assets->addJs('/js/catalog.js');
    $assets->addJs('/js/engine-select-classie.js');
    $assets->addJs('/js/engine-select-selectFx.js');
    
    //ecommerce
	\WM\Seo\ECommerce::get()->show();

	?>
</head>
<body><?

$APPLICATION->IncludeComponent('bitrix:main.include', '', [
	'AREA_FILE_SHOW' => 'file',
	'PATH' => '/include/body_top.php'
]);

//
// Панель битрикса
//
?>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div><?


?>
<div class="offcanvas open">
	<div class="offcanvas-wrap">
		<div class="offcanvas-user clearfix">
			<a class="offcanvas-user-wishlist-link" href="/personal/wishlist/">
				<i class="fa fa-heart-o"></i> Избранное
			</a><?
            if ($isAuthorized)
            {
                ?>
                <a class="offcanvas-user-account-link" href="/personal/"><i class="fa fa-user"></i> Личный кабинет</a>
                <a class="offcanvas-user-account-link" href="/?logout=yes"><i class="fa fa-user"></i> Выйти</a><?
            }
            else
            {
                ?>
                <a class="offcanvas-user-account-link" href="/login/"><i class="fa fa-user"></i> Вход</a>
                <a class="offcanvas-user-account-link" href="/login/?register=yes"><i class="fa fa-user"></i> Регистрация</a><?
            }
            ?>
		</div><?

		$APPLICATION->IncludeComponent('tim:empty', 'main_menu', ['TYPE' => 'offcanvas']);

		?>
	</div>
</div>
<div id="wrapper" class="wide-wrap">
<div class="offcanvas-overlay"></div>

<header class="header-container header-type-classic header-navbar-classic header-scroll-resize">
	<div class="topbar">
		<div class="container topbar-wap">
			<div class="row">
                <div class="col-sm-6 col-lg-8 col-md-6">
                    <div class="elTop-menu">
                        <a href="/about/contacts/">Контакты</a>
                        <a href="/about/delivery/">Доставка</a>
                        <a href="/about/guaranty/">Гарантия</a>
                        <a href="/about/howto/">Как купить</a>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-2 col-md-3">
                    <div class="mag-inf">
                        Режим работы:<br>
                        ежедневно с 7:30 до 22:00
                    </div>
                </div>
                <div class="col-sm-3 col-lg-2 col-md-3">
                    <div class="user-login">


                        <ul class="nav top-nav"><?
                            if ($isAuthorized)
                            {
                            ?>
                            <li><a href="/personal/"><i class="fa fa-user"></i> Личный кабинет</a><?
                                }
                                else
                                {
                                ?>
                            <li><a data-rel="loginModal" href="/personal/"><i class="fa fa-user"></i> Вход</a><?
                                }
                                ?>
                        </ul>
                    </div>
                </div>
			</div>
		</div>
	</div>
    <div class="container">
        <div class="elTop-blocks">
        <div class="block">
            <a <?if ($APPLICATION->GetCurDir()!==SITE_DIR) echo 'href="/"'?>>
                <img class="logo" alt="" src="/images/logo.png">
            </a>
        </div>
        <div class="block">
            <div class="icon"><img src="/images/head-block-1.png"></div>
            <div class="text">Быстро доставляем заказы по всей России</div>
        </div>
        <div class="block">
            <div class="icon"><img src="/images/head-block-2.png"></div>
            <div class="text">Более 7000 образцов от 100 производителей</div>
        </div>
        <div class="block">
            <div class="icon"><img src="/images/head-block-3.png"></div>
            <div class="text">Бесплатная доставка от 50м<small>2</small></div>
        </div>
        <div class="block">
			<a href="tel:+78043336964" class="elTop-phone-number">+7 (804) 333 69 64</a>
            <a href="tel:+74955327974" class="elTop-phone-number">+7 (495) 532 79 74</a>
            <a href="#elFormPhone" class="popup-inline">
                <span class="elTop-phone-text">Бесплатный звонок</span>
            </a>
        </div>
    </div>
    </div>
    <?

	if (!$isCart)
	{
		?>
		<div class="navbar-container">
		<div class="navbar navbar-default navbar-scroll-fixed">
			<div class="navbar-default-wrap">
				<div class="container">
					<div class="row">
						<div class="navbar-default-col">
							<div class="navbar-wrap">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar bar-top"></span>
										<span class="icon-bar bar-middle"></span>
										<span class="icon-bar bar-bottom"></span>
									</button>
									<a class="navbar-search-button search-icon-mobile" href="#">
										<i class="fa fa-search"></i>
									</a>
									<a class="cart-icon-mobile" href="#">
										<i class="elegant_icon_bag"></i><span>0</span>
									</a>
									<a class="navbar-brand" href="/">
<!--										<img class="logo" alt="" src="/images/logo.png">-->
										<img class="logo-fixed" alt="" src="/images/logo.png">
										<img class="logo-mobile" alt="" src="/images/logo.png">
									</a>
								</div><?

								$APPLICATION->IncludeComponent('tim:empty', 'main_menu', ['TYPE' => 'primary']);

								$cart = \Local\Sale\Cart::getSummary();
								?>
								<div class="header-right">
									<div class="navbar-search">
										<a class="navbar-search-button" href="#">
											<i class="fa fa-search"></i>
										</a>

										<div class="search-form-wrap show-popup hide"></div>
									</div>
									<div class="navbar-minicart navbar-minicart-topbar">
										<div class="navbar-minicart">
											<a class="minicart-link" href="/personal/cart/">
												<span class="minicart-icon">
													<i class="fa fa-shopping-cart"></i>
													<span id="js-cart-count"><?= $cart['COUNT'] ?></span>
												</span>
											</a>
										</div>
									</div>
									<div class="navbar-wishlist">
										<a class="wishlist" href="/personal/wishlist/">
											<i class="fa fa-heart-o"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="header-search-overlay hide">
				<div class="container">
					<div class="header-search-overlay-wrap">
						<form class="searchform" action="<?= CATALOG_PATH ?>">
							<input type="search" class="searchinput" name="q" autocomplete="off" value=""
							       placeholder="Поиск по каталогу..."/>
						</form>
						<button type="button" class="close">
							<span aria-hidden="true" class="fa fa-times"></span>
							<span class="sr-only">Закрыть</span>
						</button>
					</div>
				</div>
			</div>
		</div>
		</div><?
	}

	?>
</header><?

if (!$isCatalog && !$isIndex)
{
	?>
	<div class="heading-container">
		<div class="container heading-standar">
			<div class="page-breadcrumb"><?

				$APPLICATION->IncludeComponent('bitrix:breadcrumb', '', [
						'START_FROM' => '0',
						'PATH' => '',
						'SITE_ID' => '-'
					],
					false,
					['HIDE_ICONS' => 'Y']
				);

				?>
			</div>
		</div>
	</div><?
}

if (!$isCatalog)
{
	?>
	<div class="content-container no-padding">
		<div class="container-full">
			<div class="main-content"><?
}

if (!$isCatalog && !$isIndex)
{
	?>
	<div class="container">
		<h1><? $APPLICATION->ShowTitle(false); ?></h1>
	</div><?
}

