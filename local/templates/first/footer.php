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
</div><?

$APPLICATION->IncludeComponent('bitrix:main.include', '', [
	'AREA_FILE_SHOW' => 'file',
	'PATH' => '/include/body_bot.php'
]);

?>
</body>
</html><?
