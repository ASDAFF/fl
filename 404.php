<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

/** @var CMain $APPLICATION */

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->AddChainItem('404');

?>
<div class="content-container">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="main-content">
					<div class="not-found-wrapper">
						<span class="not-found-title">Ошибка</span>
						<span class="not-found-subtitle">404</span>
						<div class="widget widget_search">
							<p>Неправильно набран адрес, или такой страницы на сайте больше не существует.</p>
							<div class="search-wrapper">
								<form id="searchform" action="<?= CATALOG_PATH ?>">
									<label for="s" class="sr-only">Поиск</label>
									<input type="search" id="s" name="s" class="form-control rounded" value=""
									       placeholder="Поиск по товарам&hellip;"/>
									<input type="submit" id="searchsubmit" class="hidden" name="submit"
									       value="Искать"/>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div><?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>