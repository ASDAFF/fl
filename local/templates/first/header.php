<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var CMain $APPLICATION */
/** @var CUser $USER */

$isCatalog = defined('CATALOG_PAGES') && CATALOG_PAGES === true;
$isIndex = defined('INDEX_PAGE') && INDEX_PAGE === true;
$isCart = defined('CART_PAGE') && CART_PAGE === true;

?><!doctype html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KZSDKVK');</script>
    <!-- End Google Tag Manager -->

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<title><? $APPLICATION->ShowTitle() ?></title>
	<link rel="shortcut icon" href="/images/favicon.ico"><?

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

	?>
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KZSDKVK"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?
//
// Панель битрикса
//
?>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div><?


?>
<div class="offcanvas open">
	<div class="offcanvas-wrap">
		<div class="offcanvas-user clearfix">
			<a class="offcanvas-user-wishlist-link" href="wishlist.html">
				<i class="fa fa-heart-o"></i> Избранное
			</a>
			<a class="offcanvas-user-account-link" href="/personal/">
				<i class="fa fa-user"></i> Войти
			</a>
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
				<div class="col-sm-4 col-left-topbar">
					<div class="left-topbar">
						Более 7 000 напольных покрытий в ассортименте.
					</div>
				</div>
				<div class="col-sm-7 col-left-topbar">
					<div class="right-topbar">
						<a href="tel:+74955327974" class="elTop-phone-number">+7 (495) 532 79 74</a>
						<span class="elTop-adress"></span>
					</div>
				</div>
				<div class="col-sm-1 col-right-topbar">
					<div class="right-topbar">
						<div class="user-login">
							<ul class="nav top-nav">
								<li><a data-rel="loginModal" href="#"> Войти </a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><?

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
										<img class="logo" alt="" src="/images/logo.png">
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
										<a class="wishlist" href="wishlist.html">
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


/*
	?>

<div class="bx-wrapper" id="bx_eshop_wrap">
	<header class="bx-header">
		<div class="bx-header-section container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
					<div class="bx-logo">
						<a class="bx-logo-block hidden-xs" href="/"><?
							$APPLICATION->IncludeComponent('bitrix:main.include', '', [
									'AREA_FILE_SHOW' => 'file',
									'PATH' => '/include/company_logo.php'
								], false);
							?>
						</a>
						<a class="bx-logo-block hidden-lg hidden-md hidden-sm text-center" href="/"><?
							$APPLICATION->IncludeComponent('bitrix:main.include', '', [
									'AREA_FILE_SHOW' => 'file',
									'PATH' => '/include/company_logo_mobile.php'
								], false);
							?>
						</a>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
					<div class="bx-inc-orginfo">
						<div>
							<span class="bx-inc-orginfo-phone"><i class="fa fa-phone"></i><?
								$APPLICATION->IncludeComponent('bitrix:main.include', '', [
										'AREA_FILE_SHOW' => 'file',
										'PATH' => '/include/telephone.php'
									], false);
								?>
							</span>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
					<div class="bx-worktime">
						<div class="bx-worktime-prop"><?
							$APPLICATION->IncludeComponent('bitrix:main.include', '', [
									'AREA_FILE_SHOW' => 'file',
									'PATH' => '/include/schedule.php'
								], false);
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 hidden-xs"><?
					$APPLICATION->IncludeComponent('bitrix:sale.basket.basket.line', '', [
							'PATH_TO_BASKET' => '/personal/cart/',
							'PATH_TO_PERSONAL' => '/personal/',
							'SHOW_PERSONAL_LINK' => 'N',
							'SHOW_NUM_PRODUCTS' => 'Y',
							'SHOW_TOTAL_PRICE' => 'Y',
							'SHOW_PRODUCTS' => 'N',
							'POSITION_FIXED' => 'N',
							'SHOW_AUTHOR' => 'Y',
							'PATH_TO_REGISTER' => '/login/',
							'PATH_TO_PROFILE' => '/personal/'
						],
						false,
						[]
					);
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 hidden-xs"><?
					$APPLICATION->IncludeComponent('tim:empty', 'main_menu');
					?>
				</div>
			</div><?
			
			if (!$isIndexPage)
			{
				?>
				<div class="row">
					<div class="col-lg-12"><?
						$APPLICATION->IncludeComponent('bitrix:search.title', 'visual', [
								'NUM_CATEGORIES' => '1',
								'TOP_COUNT' => '5',
								'CHECK_DATES' => 'N',
								'SHOW_OTHERS' => 'N',
								'PAGE' => '/cat/',
								'CATEGORY_0_TITLE' => GetMessage('SEARCH_GOODS'),
								'CATEGORY_0' => [
									0 => 'iblock_catalog',
								],
								'CATEGORY_0_iblock_catalog' => [
									0 => 'all',
								],
								'CATEGORY_OTHERS_TITLE' => GetMessage('SEARCH_OTHER'),
								'SHOW_INPUT' => 'Y',
								'INPUT_ID' => 'title-search-input',
								'CONTAINER_ID' => 'search',
								'PRICE_CODE' => [
									0 => 'BASE',
								],
								'SHOW_PREVIEW' => 'Y',
								'PREVIEW_WIDTH' => '75',
								'PREVIEW_HEIGHT' => '75',
								'CONVERT_CURRENCY' => 'Y'
							],
							false
						);
						?>
					</div>
				</div><?
			}

			if (!$isIndexPage)
			{
				?>
				<div class="row">
					<div class="col-lg-12" id="navigation"><?
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
				<h1 class="bx-title dbg_title" id="pagetitle"><? $APPLICATION->ShowTitle(false); ?></h1><?
			}
			?>
		</div>
	</header>

	<div class="workarea">
		<div class="container bx-content-seection">
			<div class="row">
				<div class="bx-content <?= ($hideSidebar) ? 'col-xs-12' : 'col-md-9 col-sm-8' ?>">