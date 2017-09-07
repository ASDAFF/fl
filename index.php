<?
/** @var CMain $APPLICATION */

define('INDEX_PAGE', true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Напольные покрытия\"");

?><!-- test new-->
<div class="container _mobile-none">
    <div class="row row-fluid pt-6 pb-6">
        <div class="text-center col-sm-3">
            <div class="box-ft box-ft-5 black">
                <img src="images/elIndex-ban-1.jpg" alt="">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box-ft box-ft-5">
                <img src="/images/banner.jpg" alt="banner.jpq">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box-ft box-ft-5 mb-3">
                <img src="images/elIndex-ban-3.jpg" alt="">
            </div>
            <div class="box-ft box-ft-5">
                <img src="images/elIndex-ban-4.jpg" alt="">
            </div>
        </div>
    </div>
</div>
<div class="container _mobile-none">
    <div class="row shipping-policy">
        <div class="policy-featured-col col-md-4 col-sm-6">
            <i class="fa fa-money"></i>
            <h4 class="policy-featured-title">
                100% ТОЛЬКО СЕРТИФИЦИРОВАННЫЙ ПРОДУКТ </h4>
        </div>
        <div class="policy-featured-col col-md-4 col-sm-6">
            <i class="fa fa-globe"></i>
            <h4 class="policy-featured-title">
                Бесплатная консультация </h4>
        </div>
        <div class="policy-featured-col col-md-4 col-sm-6">
            <i class="fa fa-clock-o"></i>
            <h4 class="policy-featured-title">
                Доставка по России </h4>
        </div>
    </div>
</div>
<div class="_mobile-br"></div>
<div class="container">
    <div class="row row-fluid mb-10">
        <div class="col-sm-12"><?

            $APPLICATION->IncludeComponent("tim:empty", "hits");

            ?>
        </div>
    </div>
</div>
<div class="container-full">
    <div class="row row-fluid custom-bg-2 mb-5">
        <div class="container">
            <div class="col-sm-7 pt-7">
                <h2 class="custom_heading white mt-0">Доставка</h2>
                <p class="white elIndexBlock-dost-text">
                    Доставка осуществляется по Москве и Московской области в удобное и согласованное с клиентом
                    время.<br>
                    В города России отгрузка осуществляется через любые транспортные компании, осуществляющие
                    грузоперевозки по РФ.<br>
                    Покупатель сам выбирает удобную ему компанию.<br>
                    Стоимость доставки зависит от количества и объёма товара. Поэтому каждый заказ рассчитывается
                    индивидуально.
                </p>
            </div>
            <div class="col-sm-5 pb-3">
                <div class="special-product">
                    <div class="special-product-wrap">
                        <div class="special-product-image">
                            <a href="#"> <img class="elIndexBlock-dost-img" width="470" alt="special_product" src="images/elIndex-ban-470.jpg"
                                              height="470"> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");