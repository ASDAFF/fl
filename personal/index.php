<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");

?>
<div class="container">
    <p><a href="/personal/cart/">Корзина</a></p>
    <p><a href="/personal/profile/">Профиль пользователя</a></p>
    <p><a href="/personal/wishlist/">Избранное</a></p>
</div>
<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>