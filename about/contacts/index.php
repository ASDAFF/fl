<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

/** @global CMain $APPLICATION */

$APPLICATION->SetTitle("Контакты");

?>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<p>
					<b>Телефон:</b> +7 (804) 333 67 54 (звонок бесплатный)<br>
					<b>E-mail:</b>&nbsp;<a href="mailto:info@veleslife.ru">info@veleslife.ru</a><br>
					<b>Юридический адрес:</b> г. Москва, ул. Малый Лёвшинский пер., д. 10
				</p>
				<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A5e1aa8d768a930712fc383ca6de6961590f358c9849f066ea0fcbaac1c944004&amp;width=100%&amp;height=400&amp;lang=ru_RU&amp;scroll=true&amp;id=cmap"></script>
				<br>
				<div id="cmap"></div>
			</div>
		</div>
	</div>
	<br><?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");