<?
/** @var CMain $APPLICATION */

define('INDEX_PAGE', true);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Интернет-магазин \"Напольные покрытия\"");

?><!-- test new-->
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
 <img src="/images/banner.jpg">
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
<div class="container">
	<div class="row row-fluid mb-10">
		<div class="col-sm-12">
			 <?$APPLICATION->IncludeComponent(
	"tim:empty",
	"hits",
	Array(
		"0" => "=",
		"1" => "{",
		"2" => "[",
		"3" => "]",
		"4" => "}"
	)
);?>
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
					 Доставка осуществляется по Москве и Московской области в удобное и согласованное с клиентом время.<br>
					 В города России отгрузка осуществляется через любые транспортные компании, осуществляющие грузоперевозки по РФ.<br>
					 Покупатель сам выбирает удобную ему компанию.<br>
					 Стоимость доставки зависит от количества и объёма товара. Поэтому каждый заказ рассчитывается индивидуально.
				</p>
			</div>
			<div class="col-sm-5 pb-3">
				<div class="special-product">
					<div class="special-product-wrap">
						<div class="special-product-image">
 <a href="#"> <img width="470" alt="special_product" src="images/elIndex-ban-470.jpg" height="470"> </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row row-fluid mt-2">
		<div class="col-sm-12">
			<div data-layout="masonry" data-masonry-column="4" class="commerce products-masonry masonry">
				<div class="masonry-filter">
					<div class="filter-action filter-action-center">
						<ul data-filter-key="filter">
							<li> <a data-masonry-toogle="selected" href="#" data-filter-value=".maecenas">Maecenas</a> </li>
							<li> <a href="#" data-filter-value=".nulla">Aliquam</a> </li>
							<li> <a href="#" data-filter-value=".donec">Donec</a> </li>
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
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328.jpg" height="450" alt=""></a>
									</div>
									<div class="shop-loop-thumbnail shop-loop-back-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328alt.jpg" height="450" alt=""></a>
									</div>
								</div>
							</div>
 <figcaption>
							<div class="shop-loop-product-info">
								<div class="info-meta clearfix">
									<div class="star-rating">
									</div>
									<div class="loop-add-to-wishlist">
										<div class="yith-wcwl-add-to-wishlist">
											<div class="yith-wcwl-add-button">
 <a href="#" class="add_to_wishlist">
												Add to Wishlist </a>
											</div>
										</div>
									</div>
								</div>
								<div class="info-content-wrap">
									<h3 class="product_title"> <a href="shop-detail-1.html">Schultz Petal Dining</a> </h3>
									<div class="info-price">
 <span class="price"> <span class="amount">£17.45</span> </span>
									</div>
									<div class="loop-action">
										<div class="loop-add-to-cart">
 <a href="#" class="add_to_cart_button">
											Add to cart </a>
										</div>
									</div>
								</div>
							</div>
 </figcaption> </figure>
						</div>
 </li>
						<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 nulla maecenas">
						<div class="product-container">
 <figure>
							<div class="product-wrap">
								<div class="product-images">
									<div class="shop-loop-thumbnail shop-loop-front-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328.jpg" height="450" alt=""></a>
									</div>
									<div class="shop-loop-thumbnail shop-loop-back-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328alt.jpg" height="450" alt=""></a>
									</div>
								</div>
							</div>
 <figcaption>
							<div class="shop-loop-product-info">
								<div class="info-meta clearfix">
									<div class="star-rating">
									</div>
									<div class="loop-add-to-wishlist">
										<div class="yith-wcwl-add-to-wishlist">
											<div class="yith-wcwl-add-button">
 <a href="#" class="add_to_wishlist">
												Add to Wishlist </a>
											</div>
										</div>
									</div>
								</div>
								<div class="info-content-wrap">
									<h3 class="product_title"> <a href="shop-detail-1.html">Jens Risom Lounge</a> </h3>
									<div class="info-price">
 <span class="price"> <span class="amount">£17.45</span> </span>
									</div>
									<div class="loop-action">
										<div class="loop-add-to-cart">
 <a href="#" class="add_to_cart_button">
											Add to cart </a>
										</div>
									</div>
								</div>
							</div>
 </figcaption> </figure>
						</div>
 </li>
						<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 nulla maecenas">
						<div class="product-container">
 <figure>
							<div class="product-wrap">
								<div class="product-images">
									<div class="shop-loop-thumbnail shop-loop-front-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328.jpg" height="450" alt=""></a>
									</div>
									<div class="shop-loop-thumbnail shop-loop-back-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328alt.jpg" height="450" alt=""></a>
									</div>
								</div>
							</div>
 <figcaption>
							<div class="shop-loop-product-info">
								<div class="info-meta clearfix">
									<div class="star-rating">
									</div>
									<div class="loop-add-to-wishlist">
										<div class="yith-wcwl-add-to-wishlist">
											<div class="yith-wcwl-add-button">
 <a href="#" class="add_to_wishlist">
												Add to Wishlist </a>
											</div>
										</div>
									</div>
								</div>
								<div class="info-content-wrap">
									<h3 class="product_title"> <a href="shop-detail-1.html">Hans Wegner Shell Chair</a> </h3>
									<div class="info-price">
 <span class="price"> <span class="amount">£10.75</span> </span>
									</div>
									<div class="loop-action">
										<div class="loop-add-to-cart">
 <a href="#" class="add_to_cart_button">
											Add to cart </a>
										</div>
									</div>
								</div>
							</div>
 </figcaption> </figure>
						</div>
 </li>
						<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 maecenas donec">
						<div class="product-container">
 <figure>
							<div class="product-wrap">
								<div class="product-images">
									<div class="shop-loop-thumbnail shop-loop-front-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328.jpg" height="450" alt=""></a>
									</div>
									<div class="shop-loop-thumbnail shop-loop-back-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328alt.jpg" height="450" alt=""></a>
									</div>
								</div>
							</div>
 <figcaption>
							<div class="shop-loop-product-info">
								<div class="info-meta clearfix">
									<div class="star-rating">
									</div>
									<div class="loop-add-to-wishlist">
										<div class="yith-wcwl-add-to-wishlist">
											<div class="yith-wcwl-add-button">
 <a href="#" class="add_to_wishlist">
												Add to Wishlist </a>
											</div>
										</div>
									</div>
								</div>
								<div class="info-content-wrap">
									<h3 class="product_title"> <a href="shop-detail-1.html">Jaime Hayon Ro Chair</a> </h3>
									<div class="info-price">
 <span class="price"> <span class="amount">£32.00</span> </span>
									</div>
									<div class="loop-action">
										<div class="loop-add-to-cart">
 <a href="#" class="add_to_cart_button">
											Add to cart </a>
										</div>
									</div>
								</div>
							</div>
 </figcaption> </figure>
						</div>
 </li>
						<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 maecenas donec">
						<div class="product-container">
 <figure>
							<div class="product-wrap">
								<div class="product-images">
									<div class="shop-loop-thumbnail shop-loop-front-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328.jpg" height="450" alt=""></a>
									</div>
									<div class="shop-loop-thumbnail shop-loop-back-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328alt.jpg" height="450" alt=""></a>
									</div>
								</div>
							</div>
 <figcaption>
							<div class="shop-loop-product-info">
								<div class="info-meta clearfix">
									<div class="star-rating">
									</div>
									<div class="loop-add-to-wishlist">
										<div class="yith-wcwl-add-to-wishlist">
											<div class="yith-wcwl-add-button">
 <a href="#" class="add_to_wishlist">
												Add to Wishlist </a>
											</div>
										</div>
									</div>
								</div>
								<div class="info-content-wrap">
									<h3 class="product_title"> <a href="shop-detail-1.html">Saarinen Womb Chair</a> </h3>
									<div class="info-price">
 <span class="price"> <span class="amount">£123.00</span> </span>
									</div>
									<div class="loop-action">
										<div class="loop-add-to-cart">
 <a href="#" class="add_to_cart_button">
											Add to cart </a>
										</div>
									</div>
								</div>
							</div>
 </figcaption> </figure>
						</div>
 </li>
						<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 maecenas">
						<div class="product-container">
 <figure>
							<div class="product-wrap">
								<div class="product-images">
									<div class="shop-loop-thumbnail shop-loop-front-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328.jpg" height="450" alt=""></a>
									</div>
									<div class="shop-loop-thumbnail shop-loop-back-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328alt.jpg" height="450" alt=""></a>
									</div>
								</div>
							</div>
 <figcaption>
							<div class="shop-loop-product-info">
								<div class="info-meta clearfix">
									<div class="star-rating">
									</div>
									<div class="loop-add-to-wishlist">
										<div class="yith-wcwl-add-to-wishlist">
											<div class="yith-wcwl-add-button">
 <a href="#" class="add_to_wishlist">
												Add to Wishlist </a>
											</div>
										</div>
									</div>
								</div>
								<div class="info-content-wrap">
									<h3 class="product_title"> <a href="shop-detail-1.html">Citterio Grand Repos</a> </h3>
									<div class="info-price">
 <span class="price"> <span class="amount">£12.00</span>
										– <span class="amount">£20.00</span> </span>
									</div>
									<div class="loop-action">
										<div class="loop-add-to-cart">
 <a href="#" class="add_to_cart_button">
											Add to cart </a>
										</div>
									</div>
								</div>
							</div>
 </figcaption> </figure>
						</div>
 </li>
						<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 nulla maecenas donec">
						<div class="product-container">
 <figure>
							<div class="product-wrap">
								<div class="product-images">
 <span class="onsale">Sale!</span>
									<div class="shop-loop-thumbnail shop-loop-front-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328.jpg" height="450" alt=""></a>
									</div>
									<div class="shop-loop-thumbnail shop-loop-back-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328alt.jpg" height="450" alt=""></a>
									</div>
								</div>
							</div>
 <figcaption>
							<div class="shop-loop-product-info">
								<div class="info-meta clearfix">
									<div class="star-rating">
									</div>
									<div class="loop-add-to-wishlist">
										<div class="yith-wcwl-add-to-wishlist">
											<div class="yith-wcwl-add-button">
 <a href="#" class="add_to_wishlist">
												Add to Wishlist </a>
											</div>
										</div>
									</div>
								</div>
								<div class="info-content-wrap">
									<h3 class="product_title"> <a href="shop-detail-1.html">Arne Jacobsen Oxford Chair</a> </h3>
									<div class="info-price">
 <span class="price"> <del><span class="amount">£20.50</span></del> <span class="amount">£19.00</span> </span>
									</div>
									<div class="loop-action">
										<div class="loop-add-to-cart">
 <a href="#" class="add_to_cart_button">
											Add to cart </a>
										</div>
									</div>
								</div>
							</div>
 </figcaption> </figure>
						</div>
 </li>
						<li class="product masonry-item product-no-border style-2 col-md-3 col-sm-6 nulla maecenas">
						<div class="product-container">
 <figure>
							<div class="product-wrap">
								<div class="product-images">
 <span class="onsale">Sale!</span>
									<div class="shop-loop-thumbnail shop-loop-front-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328.jpg" height="450" alt=""></a>
									</div>
									<div class="shop-loop-thumbnail shop-loop-back-thumbnail">
 <a href="shop-detail-1.html"><img width="450" src="images/products/product_328x328alt.jpg" height="450" alt=""></a>
									</div>
								</div>
							</div>
 <figcaption>
							<div class="shop-loop-product-info">
								<div class="info-meta clearfix">
									<div class="star-rating">
									</div>
									<div class="loop-add-to-wishlist">
										<div class="yith-wcwl-add-to-wishlist">
											<div class="yith-wcwl-add-button">
 <a href="#" class="add_to_wishlist">
												Add to Wishlist </a>
											</div>
										</div>
									</div>
								</div>
								<div class="info-content-wrap">
									<h3 class="product_title"> <a href="shop-detail-1.html">Charles Pollock Executive</a> </h3>
									<div class="info-price">
 <span class="price"> <del><span class="amount">£20.50</span></del> <span class="amount">£19.00</span> </span>
									</div>
									<div class="loop-action">
										<div class="loop-add-to-cart">
 <a href="#" class="add_to_cart_button">
											Add to cart </a>
										</div>
									</div>
								</div>
							</div>
 </figcaption> </figure>
						</div>
 </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
--&gt;