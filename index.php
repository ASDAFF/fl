<?
/** @var CMain $APPLICATION */

define('INDEX_PAGE', true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Напольные покрытия\"");

?>
<!-- test new-->
<div class="container">
    <div class="row row-fluid pt-6 pb-6">
        <div class="text-center col-sm-3">
            <div class="box-ft box-ft-5 black">
                <img src="images/elIndex-ban-1.jpg" alt="">
                <!--<a href="#">
											<span class="bof-tf-title-wrap">
												<span class="bof-tf-title-wrap-2">
													<span class="bof-tf-title">iPad Pro</span>
													<span class="bof-tf-sub-title">Thin.Light.Epic</span>
												</span>
											</span>
                </a>
				-->
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box-ft box-ft-5">
                <img src="images/elIndex-ban-2.jpg" alt="">
                <!-- <a href="#">
											<span class="bof-tf-title-wrap">
												<span class="bof-tf-title-wrap-2">
													<span class="bof-tf-title">Accessories</span>
													<span class="bof-tf-sub-title">
														Personalize your iPad with casesand covers.
													</span>
												</span>
											</span>
                </a>
				-->
            </div>
        </div>
        <div class="col-sm-3">
            <div class="box-ft box-ft-5 mb-3">
                <img src="images/elIndex-ban-3.jpg" alt="">
                <!-- <a href="#">
											<span class="bof-tf-title-wrap">
												<span class="bof-tf-title-wrap-2">
													<span class="bof-tf-title">Mixr</span>
													<span class="bof-tf-sub-title">Sync your sound. And your style. </span>
												</span>
											</span>
                </a>
				-->
            </div>
            <div class="box-ft box-ft-5">
                <img src="images/elIndex-ban-4.jpg" alt="">
				<!--
                <a href="#">
											<span class="bof-tf-title-wrap">
												<span class="bof-tf-title-wrap-2">
													<span class="bof-tf-title">Mac Pro</span>
													<span class="bof-tf-sub-title">Starting at $2,999</span>
												</span>
											</span>
                </a>
				-->
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row shipping-policy">
        <div class="policy-featured-col col-md-4 col-sm-6">
            <i class="fa fa-money"></i>
            <h4 class="policy-featured-title">
                100% ТОЛЬКО СЕРТИФИЦИРОВАННЫЙ ПРОДУКТ
            </h4>
        </div>
        <div class="policy-featured-col col-md-4 col-sm-6">
            <i class="fa fa-globe"></i>
            <h4 class="policy-featured-title">
                Бесплатная консультация
            </h4>
        </div>
        <div class="policy-featured-col col-md-4 col-sm-6">
            <i class="fa fa-clock-o"></i>
            <h4 class="policy-featured-title">
                Доставка по России
            </h4>
        </div>
    </div>
</div>
<div class="container">
    <div class="row row-fluid mb-10">
        <div class="col-sm-12"><?

			$APPLICATION->IncludeComponent('tim:empty', 'hits');

            ?>
        </div>
    </div>
</div>
<div class="container-full">
    <div class="row row-fluid custom-bg-2 mb-5">
        <div class="container">
            <div class="col-sm-7 pt-12">
                <!-- <p class="white italic size-15 mb-0">Информация о</p> -->
                <h2 class="custom_heading white mt-0">Доставка</h2>
                <p class="white">
                    Доставка осуществляется по Москве и Московской области в удобное и согласованное с клиентом
                    время.<br>
                    В города России отгрузка осуществляется через любые транспортные компании, осуществляющие
                    грузоперевозки по РФ.<br>
                    Стоимость доставки зависит от количества и объёма товара. Поэтому каждый заказ рассчитывается
                    индивидуально.<br>
                    Покупатель сам выбирает удобную ему компанию.
                </p>
            </div>
            <div class="col-sm-5 pb-3">
                <div class="special-product">
                    <div class="special-product-wrap">
                        <div class="special-product-image">
                            <a href="#">
                                <img width="470" height="470" src="images/elIndex-ban-470.jpg" alt="special_product"/>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--
<div class="container">
<div class="row row-fluid mt-2">
<div class="col-sm-12">
<div data-layout="masonry" data-masonry-column="4" class="commerce products-masonry masonry">
<div class="masonry-filter">
    <div class="filter-action filter-action-center">
        <ul data-filter-key="filter">
            <li>
                <a data-masonry-toogle="selected" href="#" data-filter-value=".maecenas">Maecenas</a>
            </li>
            <li>
                <a href="#" data-filter-value=".nulla">Aliquam</a>
            </li>
            <li>
                <a href="#" data-filter-value=".donec">Donec</a>
            </li>
        </ul>
    </div>
</div>
<div class="products-masonry-wrap">
<ul class="products masonry-products row masonry-wrap">
<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 maecenas donec">
    <div class="product-container">
        <figure>
            <div class="product-wrap">
                <div class="product-images">
                    <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328.jpg" alt=""/></a>
                    </div>
                    <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328alt.jpg" alt=""/></a>
                    </div>
                </div>
            </div>
            <figcaption>
                <div class="shop-loop-product-info">
                    <div class="info-meta clearfix">
                        <div class="star-rating">
                            <span style="width:0%"></span>
                        </div>
                        <div class="loop-add-to-wishlist">
                            <div class="yith-wcwl-add-to-wishlist">
                                <div class="yith-wcwl-add-button">
                                    <a href="#" class="add_to_wishlist">
                                        Add to Wishlist
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-content-wrap">
                        <h3 class="product_title">
                            <a href="shop-detail-1.html">Schultz Petal Dining</a>
                        </h3>
                        <div class="info-price">
                                                                        <span class="price">
                                                                            <span class="amount">&pound;17.45</span>
                                                                        </span>
                        </div>
                        <div class="loop-action">
                            <div class="loop-add-to-cart">
                                <a href="#" class="add_to_cart_button">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </figcaption>
        </figure>
    </div>
</li>
<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 nulla maecenas">
    <div class="product-container">
        <figure>
            <div class="product-wrap">
                <div class="product-images">
                    <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328.jpg" alt=""/></a>
                    </div>
                    <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328alt.jpg" alt=""/></a>
                    </div>
                </div>
            </div>
            <figcaption>
                <div class="shop-loop-product-info">
                    <div class="info-meta clearfix">
                        <div class="star-rating">
                            <span style="width:0%"></span>
                        </div>
                        <div class="loop-add-to-wishlist">
                            <div class="yith-wcwl-add-to-wishlist">
                                <div class="yith-wcwl-add-button">
                                    <a href="#" class="add_to_wishlist">
                                        Add to Wishlist
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-content-wrap">
                        <h3 class="product_title">
                            <a href="shop-detail-1.html">Jens Risom Lounge</a>
                        </h3>
                        <div class="info-price">
                                                                        <span class="price">
                                                                            <span class="amount">&pound;17.45</span>
                                                                        </span>
                        </div>
                        <div class="loop-action">
                            <div class="loop-add-to-cart">
                                <a href="#" class="add_to_cart_button">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </figcaption>
        </figure>
    </div>
</li>
<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 nulla maecenas">
    <div class="product-container">
        <figure>
            <div class="product-wrap">
                <div class="product-images">
                    <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328.jpg" alt=""/></a>
                    </div>
                    <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328alt.jpg" alt=""/></a>
                    </div>
                </div>
            </div>
            <figcaption>
                <div class="shop-loop-product-info">
                    <div class="info-meta clearfix">
                        <div class="star-rating">
                            <span style="width:0%"></span>
                        </div>
                        <div class="loop-add-to-wishlist">
                            <div class="yith-wcwl-add-to-wishlist">
                                <div class="yith-wcwl-add-button">
                                    <a href="#" class="add_to_wishlist">
                                        Add to Wishlist
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-content-wrap">
                        <h3 class="product_title">
                            <a href="shop-detail-1.html">Hans Wegner Shell Chair</a>
                        </h3>
                        <div class="info-price">
                                                                        <span class="price">
                                                                            <span class="amount">&pound;10.75</span>
                                                                        </span>
                        </div>
                        <div class="loop-action">
                            <div class="loop-add-to-cart">
                                <a href="#" class="add_to_cart_button">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </figcaption>
        </figure>
    </div>
</li>
<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 maecenas donec">
    <div class="product-container">
        <figure>
            <div class="product-wrap">
                <div class="product-images">
                    <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328.jpg" alt=""/></a>
                    </div>
                    <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328alt.jpg" alt=""/></a>
                    </div>
                </div>
            </div>
            <figcaption>
                <div class="shop-loop-product-info">
                    <div class="info-meta clearfix">
                        <div class="star-rating">
                            <span style="width:0%"></span>
                        </div>
                        <div class="loop-add-to-wishlist">
                            <div class="yith-wcwl-add-to-wishlist">
                                <div class="yith-wcwl-add-button">
                                    <a href="#" class="add_to_wishlist">
                                        Add to Wishlist
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-content-wrap">
                        <h3 class="product_title">
                            <a href="shop-detail-1.html">Jaime Hayon Ro Chair</a>
                        </h3>
                        <div class="info-price">
                                                                        <span class="price">
                                                                            <span class="amount">&pound;32.00</span>
                                                                        </span>
                        </div>
                        <div class="loop-action">
                            <div class="loop-add-to-cart">
                                <a href="#" class="add_to_cart_button">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </figcaption>
        </figure>
    </div>
</li>
<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 maecenas donec">
    <div class="product-container">
        <figure>
            <div class="product-wrap">
                <div class="product-images">
                    <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328.jpg" alt=""/></a>
                    </div>
                    <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328alt.jpg" alt=""/></a>
                    </div>
                </div>
            </div>
            <figcaption>
                <div class="shop-loop-product-info">
                    <div class="info-meta clearfix">
                        <div class="star-rating">
                            <span style="width:0%"></span>
                        </div>
                        <div class="loop-add-to-wishlist">
                            <div class="yith-wcwl-add-to-wishlist">
                                <div class="yith-wcwl-add-button">
                                    <a href="#" class="add_to_wishlist">
                                        Add to Wishlist
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-content-wrap">
                        <h3 class="product_title">
                            <a href="shop-detail-1.html">Saarinen Womb Chair</a>
                        </h3>
                        <div class="info-price">
                                                                        <span class="price">
                                                                            <span class="amount">&pound;123.00</span>
                                                                        </span>
                        </div>
                        <div class="loop-action">
                            <div class="loop-add-to-cart">
                                <a href="#" class="add_to_cart_button">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </figcaption>
        </figure>
    </div>
</li>
<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 maecenas">
    <div class="product-container">
        <figure>
            <div class="product-wrap">
                <div class="product-images">
                    <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328.jpg" alt=""/></a>
                    </div>
                    <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328alt.jpg" alt=""/></a>
                    </div>
                </div>
            </div>
            <figcaption>
                <div class="shop-loop-product-info">
                    <div class="info-meta clearfix">
                        <div class="star-rating">
                            <span style="width:80%"></span>
                        </div>
                        <div class="loop-add-to-wishlist">
                            <div class="yith-wcwl-add-to-wishlist">
                                <div class="yith-wcwl-add-button">
                                    <a href="#" class="add_to_wishlist">
                                        Add to Wishlist
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-content-wrap">
                        <h3 class="product_title">
                            <a href="shop-detail-1.html">Citterio Grand Repos</a>
                        </h3>
                        <div class="info-price">
                                                                        <span class="price">
                                                                            <span class="amount">£12.00</span>
                                                                            –
                                                                            <span class="amount">£20.00</span>
                                                                        </span>
                        </div>
                        <div class="loop-action">
                            <div class="loop-add-to-cart">
                                <a href="#" class="add_to_cart_button">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </figcaption>
        </figure>
    </div>
</li>
<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 nulla maecenas donec">
    <div class="product-container">
        <figure>
            <div class="product-wrap">
                <div class="product-images">
                    <span class="onsale">Sale!</span>
                    <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328.jpg" alt=""/></a>
                    </div>
                    <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328alt.jpg" alt=""/></a>
                    </div>
                </div>
            </div>
            <figcaption>
                <div class="shop-loop-product-info">
                    <div class="info-meta clearfix">
                        <div class="star-rating">
                            <span style="width:80%"></span>
                        </div>
                        <div class="loop-add-to-wishlist">
                            <div class="yith-wcwl-add-to-wishlist">
                                <div class="yith-wcwl-add-button">
                                    <a href="#" class="add_to_wishlist">
                                        Add to Wishlist
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-content-wrap">
                        <h3 class="product_title">
                            <a href="shop-detail-1.html">Arne Jacobsen Oxford Chair</a>
                        </h3>
                        <div class="info-price">
                                                                        <span class="price">
                                                                            <del><span class="amount">£20.50</span></del>
                                                                            <ins><span class="amount">£19.00</span></ins>
                                                                        </span>
                        </div>
                        <div class="loop-action">
                            <div class="loop-add-to-cart">
                                <a href="#" class="add_to_cart_button">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </figcaption>
        </figure>
    </div>
</li>
<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 nulla maecenas">
    <div class="product-container">
        <figure>
            <div class="product-wrap">
                <div class="product-images">
                    <span class="onsale">Sale!</span>
                    <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328.jpg" alt=""/></a>
                    </div>
                    <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                        <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328alt.jpg" alt=""/></a>
                    </div>
                </div>
            </div>
            <figcaption>
                <div class="shop-loop-product-info">
                    <div class="info-meta clearfix">
                        <div class="star-rating">
                            <span style="width:80%"></span>
                        </div>
                        <div class="loop-add-to-wishlist">
                            <div class="yith-wcwl-add-to-wishlist">
                                <div class="yith-wcwl-add-button">
                                    <a href="#" class="add_to_wishlist">
                                        Add to Wishlist
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="info-content-wrap">
                        <h3 class="product_title">
                            <a href="shop-detail-1.html">Charles Pollock Executive</a>
                        </h3>
                        <div class="info-price">
                                                                        <span class="price">
                                                                            <del><span class="amount">£20.50</span></del>
                                                                            <ins><span class="amount">£19.00</span></ins>
                                                                        </span>
                        </div>
                        <div class="loop-action">
                            <div class="loop-add-to-cart">
                                <a href="#" class="add_to_cart_button">
                                    Add to cart
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </figcaption>
        </figure>
    </div>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
-->



<!--
<div class="container">
    <div class="row row-fluid mb-6">
        <div class="col-sm-6">
            <div class="box-ft box-ft-5 black">
                <img src="images/thumb_570x190.jpg" alt="">
                <a href="#">
											<span class="bof-tf-title-wrap">
												<span class="bof-tf-title-wrap-2">
													<span class="bof-tf-title">MEGA SALE</span>
													<span class="bof-tf-sub-title">Smart TV </span>
												</span>
											</span>
                </a>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box-ft box-ft-5 black">
                <img src="images/thumb_570x190.jpg" alt="">
                <a href="#">
											<span class="bof-tf-title-wrap">
												<span class="bof-tf-title-wrap-2">
													<span class="bof-tf-title">MOBILE MUSIC</span>
													<span class="bof-tf-sub-title">Feel the real </span>
												</span>
											</span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row row-fluid mb-5">
        <div class="col-sm-12">
            <h3 class="heading-center-custom text-center">
                our of blog
            </h3>
            <div class="post-grid-wrap">
                <ul class="row grid col-3">
                    <li class="col-sm-4 ">
                        <article class="hentry">
                            <div class="hentry-wrap">
                                <div class="entry-featured">
                                    <a href="blog-detail.html" title="Blog-1">
                                        <img width="600" height="450" src="images/blog/blog_370x238.jpg" alt="Blog-1"/>
                                    </a>
                                </div>
                                <div class="entry-info">
                                    <div class="entry-header">
                                        <h3 class="entry-title">
                                            <a href="blog-detail.html">Monogrammed Speedy in Tow </a>
                                        </h3>
                                    </div>
                                    <div class="entry-content">
                                        <p>
                                            The summer holidays are wonderful. Dressing for them can be significantly
                                            less so: Packing light is always at a premium, but one never wants to feel
                                            high, dry, and seriously...
                                        </p>
                                    </div>
                                    <div class="entry-meta">
																<span class="meta-date">
																	Date:
																	<time datetime="2015-08-11T06:27:49+00:00">
																		August 11, 2015
																	</time>
																</span>
                                        <span class="meta-author">
																	By:
																	<a href="#">sitesao</a>
																</span>
                                        <span class="meta-category">
																	Category:
																	<a href="#">Aliquam</a>, <a href="#">Nunc</a>
																</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>
                    <li class="col-sm-4 ">
                        <article class="hentry">
                            <div class="hentry-wrap">
                                <div class="entry-featured">
                                    <a href="blog-detail.html" title="Blog-1">
                                        <img width="600" height="450" src="images/blog/blog_370x238.jpg" alt="Blog-2"/>
                                    </a>
                                </div>
                                <div class="entry-info">
                                    <div class="entry-header">
                                        <h3 class="entry-title">
                                            <a href="blog-detail.html">Summer Classics in Positano </a>
                                        </h3>
                                    </div>
                                    <div class="entry-content">
                                        <p>
                                            The summer holidays are wonderful. Dressing for them can be significantly
                                            less so: Packing light is always at a premium, but one never wants to feel
                                            high, dry, and seriously...
                                        </p>
                                    </div>
                                    <div class="entry-meta">
																<span class="meta-date">
																	Date:
																	<time datetime="2015-08-11T06:27:49+00:00">
																		August 11, 2015
																	</time>
																</span>
                                        <span class="meta-author">
																	By:
																	<a href="#">sitesao</a>
																</span>
                                        <span class="meta-category">
																	Category:
																	<a href="#">Nunc</a>
																</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>
                    <li class="col-sm-4 ">
                        <article class="hentry">
                            <div class="hentry-wrap">
                                <div class="entry-featured">
                                    <a href="blog-detail.html" title="Blog-1">
                                        <img width="600" height="450" src="images/blog/blog_370x238.jpg" alt="Blog-3"/>
                                    </a>
                                </div>
                                <div class="entry-info">
                                    <div class="entry-header">
                                        <h3 class="entry-title">
                                            <a href="blog-detail.html">That Most Modern </a>
                                        </h3>
                                    </div>
                                    <div class="entry-content">
                                        <p>
                                            The summer holidays are wonderful. Dressing for them can be significantly
                                            less so: Packing light is always at a premium, but one never wants to feel
                                            high, dry, and seriously...
                                        </p>
                                    </div>
                                    <div class="entry-meta">
																<span class="meta-date">
																	Date:
																	<time datetime="2015-08-11T06:27:49+00:00">
																		August 11, 2015
																	</time>
																</span>
                                        <span class="meta-author">
																	By:
																	<a href="#">sitesao</a>
																</span>
                                        <span class="meta-category">
																	Category:
																	<a href="#">Nunc</a>, <a href="#">Aliquam</a>
																</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row row-fluid brands mb-3">
        <div class="col-sm-6">
            <h3 class="custom_heading">BRANDS</h3>
            <div class="client client-grid">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="client-item">
                            <a target="_blank" href="#">
                                <img alt="" src="images/brand/brand_170x77.jpg" class="grayscale">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="client-item">
                            <a target="_blank" href="#">
                                <img alt="" src="images/brand/brand_170x77.jpg" class="grayscale">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="client-item">
                            <a target="_blank" href="#">
                                <img alt="" src="images/brand/brand_170x77.jpg" class="grayscale">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="client-item">
                            <a target="_blank" href="#">
                                <img alt="" src="images/brand/brand_170x77.jpg" class="grayscale">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="client-item">
                            <a target="_blank" href="#">
                                <img alt="" src="images/brand/brand_170x77.jpg" class="grayscale">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="client-item">
                            <a target="_blank" href="#">
                                <img alt="" src="images/brand/brand_170x77.jpg" class="grayscale">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <h3 class="custom_heading">WHAT'S CLIENT SAY</h3>
            <div class="testimonial style-2 mb-5">
                <div class="caroufredsel" data-visible-min="1" data-visible-max="2" data-scroll-fx="scroll"
                     data-speed="5000" data-responsive="1" data-infinite="1" data-autoplay="0">
                    <div class="caroufredsel-wrap">
                        <ul class="caroufredsel-items">
                            <li class="caroufredsel-item col-sm-12">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-text">
                                        <span>&ldquo;</span>
                                        Sed a mollis libero. Sed aliquet, tortor vel effics itur finibus, nunc felis
                                        hendrerit nula non auct or lectus erat vel magna.
                                        <span>&rdquo;</span>
                                    </div>
                                    <div class="clearfix">
                                        <div class="testimonial-avatar">
                                            <img src="images/avatar/thumb_50x50.jpg" alt=""/>
                                        </div>
                                        <span class="testimonial-author">tony task</span>
                                        <span class="testimonial-company">Manager Director</span>
                                    </div>
                                </div>
                            </li>
                            <li class="caroufredsel-item col-sm-12">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-text">
                                        <span>&ldquo;</span>
                                        Sed a mollis libero. Sed aliquet, tortor vel effics itur finibus, nunc felis
                                        hendrerit nula non auct or lectus erat vel magna.
                                        <span>&rdquo;</span>
                                    </div>
                                    <div class="clearfix">
                                        <div class="testimonial-avatar">
                                            <img src="images/avatar/thumb_50x50.jpg" alt=""/>
                                        </div>
                                        <span class="testimonial-author">John Smith</span>
                                        <span class="testimonial-company">CEO</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <a href="#" class="caroufredsel-prev hide"></a>
                        <a href="#" class="caroufredsel-next hide"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row row-fluid">
        <div class="col-sm-6 col-lg-3 col-md-3">
            <h4 class="custom_heading">FEATURED</h4>
            <div class="widget commerce">
                <ul class="product_list_widget">
                    <li>
                        <a href="#" title="Urbeats">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/> <span
                                class="product-title">Urbeats</span>
                        </a>
                        <del><span class="amount">&pound;20.50</span></del>
                        <ins><span class="amount">&pound;19.00</span></ins>
                    </li>
                    <li>
                        <a href="#" title="Epson Color Printer">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/> <span
                                class="product-title">Epson Color Printer</span>
                        </a>
                        <span class="amount">&pound;17.50</span>
                    </li>
                    <li>
                        <a href="#" title="Screen Holder">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/> <span
                                class="product-title">Screen Holder</span>
                        </a>
                        <del><span class="amount">&pound;23.00</span></del>
                        <ins><span class="amount">&pound;20.00</span></ins>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 col-md-3">
            <h4 class="custom_heading">TOP RATE</h4>
            <div class="widget commerce">
                <ul class="product_list_widget">
                    <li>
                        <a href="#" title="Epson Color Printer">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/>
                            <span class="product-title">Epson Color Printer</span>
                        </a>
                        <div class="star-rating">
                            <span style="width:100%"></span>
                        </div>
                        <span class="amount">&pound;17.50</span>
                    </li>
                    <li>
                        <a href="#" title="Urbeats">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/>
                            <span class="product-title">Urbeats</span>
                        </a>
                        <div class="star-rating">
                            <span style="width:80%"></span>
                        </div>
                        <span class="amount">&pound;12.00</span>
                        &ndash;
                        <span class="amount">&pound;20.00</span>
                    </li>
                    <li>
                        <a href="#" title="Macbook Pro">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/>
                            <span class="product-title">Macbook Pro</span>
                        </a>
                        <div class="star-rating">
                            <span style="width:100%"></span>
                        </div>
                        <del><span class="amount">&pound;20.50</span></del>
                        <ins><span class="amount">&pound;19.00</span></ins>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 col-md-3">
            <h4 class="custom_heading">HOT SALE</h4>
            <div class="widget commerce">
                <ul class="product_list_widget">
                    <li>
                        <a href="#" title="Urbeats">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/> <span
                                class="product-title">Urbeats</span>
                        </a>
                        <del><span class="amount">&pound;20.50</span></del>
                        <ins><span class="amount">&pound;19.00</span></ins>
                    </li>
                    <li>
                        <a href="#" title="Epson Color Printer">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/> <span
                                class="product-title">Epson Color Printer</span>
                        </a>
                        <span class="amount">&pound;17.50</span>
                    </li>
                    <li>
                        <a href="#" title="Screen Holder">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/> <span
                                class="product-title">Screen Holder</span>
                        </a>
                        <del><span class="amount">&pound;23.00</span></del>
                        <ins><span class="amount">&pound;20.00</span></ins>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 col-md-3">
            <h4 class="custom_heading">BEST SELLING</h4>
            <div class="widget commerce">
                <ul class="product_list_widget">
                    <li>
                        <a href="#" title="Urbeats">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/> <span
                                class="product-title">Urbeats</span>
                        </a>
                        <del><span class="amount">&pound;20.50</span></del>
                        <ins><span class="amount">&pound;19.00</span></ins>
                    </li>
                    <li>
                        <a href="#" title="Epson Color Printer">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/> <span
                                class="product-title">Epson Color Printer</span>
                        </a>
                        <span class="amount">&pound;17.50</span>
                    </li>
                    <li>
                        <a href="#" title="Screen Holder">
                            <img width="100" height="100" src="images/products/product_60x60.jpg" alt=""/> <span
                                class="product-title">Screen Holder</span>
                        </a>
                        <del><span class="amount">&pound;23.00</span></del>
                        <ins><span class="amount">&pound;20.00</span></ins>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
-->
<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");