<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var CMain $APPLICATION */

$isCatalog = defined('CATALOG_PAGES') && CATALOG_PAGES === true;

if (!$isCatalog)
{
				?>
			</div>
		</div>
	</div><?
}

?>
<footer id="footer" class="footer"><?

    /*
    ?>
	<div class="footer-newsletter">
		<div class="container">
			<div class="footer-newsletter-wrap">
				<h3 class="footer-newsletter-heading">Рассылка</h3>
				<form class="mailchimp-form">
					<div class="mailchimp-form-content clearfix">
						<label for="subscribe_email" class="hide">Subscribe</label>
						<input type="email" id="subscribe_email" class="form-control" required="required" placeholder="Введите Ваш адрес электронной почты..." name="email">
						<button type="submit" class="btn mailchimp-submit">ОК</button>
					</div>
				</form>
			</div>
		</div>
    </div><?*/

    ?>
	<div class="footer-featured">
		<div class="container">
			<div class="row">
				<div class="footer-featured-col col-md-4 col-sm-6">
					<i class="fa fa-money"></i>
					<h4 class="footer-featured-title">
						100% только сертифицированный продукт
					</h4>
					<!-- free return standard order in 30 days -->
				</div>
				<div class="footer-featured-col col-md-4 col-sm-6">
					<i class="fa fa-globe"></i>
					<h4 class="footer-featured-title">
						Более 7000 наименований
					</h4>
					<!-- free ship for payment over $100 -->
				</div>
				<div class="footer-featured-col col-md-4 col-sm-6">
					<i class="fa fa-clock-o"></i>
					<h4 class="footer-featured-title">
						Гарантия от производителя
					</h4>
					
				</div>
			</div>
		</div>
	</div>
	<div class="footer-widget">
		<div class="container">
			<div class="footer-widget-wrap">
				<div class="row"><?

					$APPLICATION->IncludeComponent('tim:empty', 'bot_menu');

					?>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-copyright text-center">
        © 2017 <a href="http://lema.agency/">Разработано в Lema.Agency</a>
	</div>
</footer>
</div>

<div class="modal fade user-login-modal" id="userloginModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="userloginModalForm" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span>
					</button>
					<h4 class="modal-title">Войти</h4>
				</div>
				<div class="modal-body">
					<div class="user-login-facebook">
						<button class="btn-login-facebook" type="button">
							<i class="fa fa-facebook"></i> Войти с помощью facebook
						</button>
					</div>
					<div class="user-login-or"><span>или</span></div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" id="username" name="login" required class="form-control" value="" placeholder="Введите Email">
					</div>
					<div class="form-group">
						<label for="password">Пароль</label>
						<input type="password" id="password" required value="" name="pwd" class="form-control" placeholder="Введите пароль">
					</div>
					<div class="checkbox clearfix">
						<label class="form-flat-checkbox pull-left">
							<input type="checkbox" name="rememberme" id="rememberme">
							<i></i>&nbsp;Запомнить меня
						</label>
                        <span class="lostpassword-modal-link pull-right">
                            <a href="#lostpasswordModal" data-rel="lostpasswordModal">Забыли пароль?</a>
                        </span>
					</div>
				</div>
				<div class="modal-footer">
                    <div class="user-modal-result"></div>
                    <span class="user-login-modal-register pull-left">
                        <a data-rel="registerModal" href="#">Регистрация</a>
                    </span>
					<button type="submit" class="btn btn-default btn-outline">Войти</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade user-register-modal" id="userregisterModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="userregisterModalForm">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span>
					</button>
					<h4 class="modal-title">Регистрация</h4>
				</div>
				<div class="modal-body">
					<div class="user-login-facebook">
						<button class="btn-login-facebook" type="button">
							<i class="fa fa-facebook"></i> Войти с помощью facebook
						</button>
					</div>
					<div class="user-login-or"><span>или</span></div>
					<div class="form-group">
						<label for="user_email">Email</label>
						<input type="email" id="user_email" name="user_email" required class="form-control" value="" placeholder="Введите Email">
					</div>
					<div class="form-group">
						<label for="user_password">Пароль</label>
						<input type="password" id="user_password" required value="" name="user_password" class="form-control" placeholder="Введите пароль">
					</div>
					<div class="form-group">
						<label for="user_password">Пароль повторно</label>
						<input type="password" id="cuser_password" required value="" name="cuser_password" class="form-control" placeholder="Повторите пароль">
					</div>
				</div>
				<div class="modal-footer">
                    <div class="user-modal-result"></div>
                    <span class="user-login-modal-link pull-left">
                        <a data-rel="loginModal" href="#loginModal">Уже есть аккаунт?</a>
                    </span>
					<button type="submit" class="btn btn-default btn-outline">Регистрация</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade user-lostpassword-modal" id="userlostpasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="userlostpasswordModalForm">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">&times;</span><span class="sr-only">Закрыть</span>
					</button>
					<h4 class="modal-title">Восстановление пароля</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Email:</label>
						<input type="text" name="user_login" required class="form-control" value="" placeholder="Введите Email">
					</div>
				</div>
				<div class="modal-footer">
                    <div class="user-modal-result"></div>
                    <span class="user-login-modal-link pull-left">
                        <a data-rel="loginModal" href="#loginModal">Войти</a>
                    </span>
					<button type="submit" class="btn btn-default btn-outline">Восстановить пароль</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div id="minicart-cont" class="minicart-side"><?

	$APPLICATION->IncludeComponent('tim:empty', 'minicart');

	?>
</div>
<a href="#elFormPhone" class="elPhoneBtn popup-inline" data-rel="magnific-popup-link">
    <div class="circlephone" style="transform-origin: center;"></div>
    <div class="circle-fill" style="transform-origin: center;"></div>
    <div class="img-circle" style="transform-origin: center;">
        <div class="img-circleblock" style="transform-origin: center;"></div>
    </div>
</a>
<div class="engFormPopup zwhite-popup" id="elFormPhone">
    <form>
        <div class="elOrderPopup-pole">
            <div class="it-block">
                <div class="it-title">Имя*</div>
                <input name="NAME" type="text" placeholder="Ваше Имя" value="" required="" title="Ваше Имя">
            </div>
            <div class="it-block">
                <div class="it-title">Телефон*</div>
                <input name="PHONE" type="text" placeholder="Ваш телефон" value="" required="" title="Ваш телефон">
            </div>
        </div>
        <div class="result"></div>
        <div class="elFormPhone-btn">
            <button type="submit">Заказать звонок</button>
        </div>
    </form>
</div>
</body>
</html><?

/*
				?>
				</div><?

				if (!$hideSidebar)
				{
					?>
					<div class="sidebar col-md-3 col-sm-4"><?
						$APPLICATION->IncludeComponent(
							'bitrix:main.include',
							'',
							[
								'AREA_FILE_SHOW' => 'sect',
								'AREA_FILE_SUFFIX' => 'sidebar',
								'AREA_FILE_RECURSIVE' => 'Y',
								'EDIT_MODE' => 'html',
							],
							false,
							['HIDE_ICONS' => 'Y']
						);
						?>
					</div><?
				}

				?>
			</div><?

			$APPLICATION->IncludeComponent(
				'bitrix:main.include',
				'',
				[
					'AREA_FILE_SHOW' => 'sect',
					'AREA_FILE_SUFFIX' => 'bottom',
					'AREA_FILE_RECURSIVE' => 'N',
					'EDIT_MODE' => 'html',
				],
				false,
				['HIDE_ICONS' => 'Y']
			);
			?>
		</div>
	</div>

	<footer class="bx-footer">
		<div class="bx-footer-line">
			<div class="bx-footer-section container"><?
				$APPLICATION->IncludeComponent(
					'bitrix:main.include',
					'',
					[
						'AREA_FILE_SHOW' => 'file',
						'PATH' => '/include/socnet_footer.php',
						'AREA_FILE_RECURSIVE' => 'N',
						'EDIT_MODE' => 'html',
					],
					false,
					['HIDE_ICONS' => 'Y']
				);
				?>
			</div>
		</div>
		<div class="bx-footer-section container bx-center-section">
			<div class="col-sm-5 col-md-3 col-md-push-6">
				<h4 class="bx-block-title"><?
					$APPLICATION->IncludeComponent('bitrix:main.include', '', [
							'AREA_FILE_SHOW' => 'file',
							'PATH' => '/include/about_title.php'
						], false);
					?>
				</h4><?
				
				$APPLICATION->IncludeComponent('bitrix:menu', 'bottom_menu', [
						'ROOT_MENU_TYPE' => 'bottom',
						'MAX_LEVEL' => '1',
						'MENU_CACHE_TYPE' => 'A',
						'CACHE_SELECTED_ITEMS' => 'N',
						'MENU_CACHE_TIME' => '36000000',
						'MENU_CACHE_USE_GROUPS' => 'Y',
						'MENU_CACHE_GET_VARS' => [
						],
					],
					false
				);
				
				?>
			</div>
			<div class="col-sm-5 col-md-3">
				<h4 class="bx-block-title"><?
					$APPLICATION->IncludeComponent('bitrix:main.include', '', [
							'AREA_FILE_SHOW' => 'file',
							'PATH' => '/include/catalog_title.php'
						], false);
					?>
				</h4><?

				$APPLICATION->IncludeComponent('bitrix:menu', 'bottom_menu', [
						'ROOT_MENU_TYPE' => 'left',
						'MENU_CACHE_TYPE' => 'A',
						'MENU_CACHE_TIME' => '36000000',
						'MENU_CACHE_USE_GROUPS' => 'Y',
						'MENU_CACHE_GET_VARS' => [
						],
						'CACHE_SELECTED_ITEMS' => 'N',
						'MAX_LEVEL' => '1',
						'USE_EXT' => 'Y',
						'DELAY' => 'N',
						'ALLOW_MULTI_SELECT' => 'N'
					],
					false
				);

				?>
			</div>
			<div class="col-sm-5 col-md-3 col-md-pull-6">
				<div class="bx-inclogofooter">
					<div class="bx-inclogofooter-block">
						<a class="bx-inclogofooter-logo" href="/"><?
							$APPLICATION->IncludeComponent('bitrix:main.include', '', [
									'AREA_FILE_SHOW' => 'file',
									'PATH' => '/include/company_logo_mobile.php'
								], false);
							?>
						</a>
					</div>
					<div class="bx-inclogofooter-block">
						<div class="bx-inclogofooter-tel"><?
							$APPLICATION->IncludeComponent('bitrix:main.include', '', [
									'AREA_FILE_SHOW' => 'file',
									'PATH' => '/include/telephone.php'
								], false);
							?>
						</div>
						<div class="bx-inclogofooter-worktime"><?
							$APPLICATION->IncludeComponent('bitrix:main.include', '', [
									'AREA_FILE_SHOW' => 'file',
									'PATH' => '/include/schedule.php'
								], false);
							?>
						</div>
					</div>
					<div><?
						$APPLICATION->IncludeComponent('bitrix:main.include', '', [
								'AREA_FILE_SHOW' => 'file',
								'PATH' => '/include/personal.php'
							], false);
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="bx-footer-bottomline">
			<div class="bx-footer-section container">
				<div class="col-sm-6"><?
					$APPLICATION->IncludeComponent('bitrix:main.include', '', [
							'AREA_FILE_SHOW' => 'file',
							'PATH' => '/include/copyright.php'
						], false);
					?>
				</div>
				<div class="col-sm-6 bx-up"><a href="javascript:void(0)" data-role="eshopUpButton"><i
							class="fa fa-caret-up"></i> Наверх</a></div>
			</div>
		</div>
	</footer>

	<div class="col-xs-12 hidden-lg hidden-md hidden-sm"><?
		$APPLICATION->IncludeComponent('bitrix:sale.basket.basket.line', '', [
				'PATH_TO_BASKET' => '/personal/cart/',
				'PATH_TO_PERSONAL' => '/personal/',
				'SHOW_PERSONAL_LINK' => 'N',
				'SHOW_NUM_PRODUCTS' => 'Y',
				'SHOW_TOTAL_PRICE' => 'Y',
				'SHOW_PRODUCTS' => 'N',
				'POSITION_FIXED' => 'Y',
				'POSITION_HORIZONTAL' => 'center',
				'POSITION_VERTICAL' => 'bottom',
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
</body>
</html>