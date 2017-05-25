/**
 * Панель фильтров
 */
var Filters = {
	price_from: 0,
	price_to: 0,
	price_min: 0,
	price_max: 0,
	price: false,
	sort: '',
	size: '',
	init: function($) {
		this.panel = $('#filters-panel');
		if (!this.panel.length)
			return;

		// внешний вид шапки
		$('.header-container').attr('class', 'header-container header-type-classic header-navbar-classic header-absolute header-transparent');

		this.catalogPath = this.panel.find('input[name=catalog_path]').val();
		this.separator = this.panel.find('input[name=separator]').val();
		this.searchForm = this.panel.find('#filter-search');
		this.searchInput = this.searchForm.find('input[name=q]');
		this.groups = this.panel.find('.widget');
		this.ajaxCont = $('#ajax-cont');
		this.titleCont = $('.page-title');
		this.bcCont = this.titleCont.find('.breadcrumb');
		this.h1Cont = this.titleCont.find('h1');

		this.priceInit($);

		$('.s-filter a').on('click', this.categoryClick);
		$('.f-color li').on('click', this.colorClick);
		$('.f-other a').on('click', this.checkboxClick);
		this.ajaxCont.on('click', '.add_to_cart_button', this.addToCart);
		this.ajaxCont.on('click', '.cur-f a', this.urlClick);
		this.ajaxCont.on('click', '.paginate a', this.urlClick);
		this.ajaxCont.on('change', '#sort', this.sortChange);
		this.ajaxCont.on('change', '#size', this.sizeChange);
		this.bcCont.on('click', 'a', this.urlClick);
		this.groups.find('.title').click(this.toggleGroup);
		this.searchForm.submit(this.searchSubmit);


		$(window).on('popstate', function (e) {
			var url = e.target.location;
			Filters.loadProducts(url, false);
		});
	},
	priceInit: function ($) {
		this.priceDiv = $('.price_slider');
		this.priceLabel = $('.price_label');
		this.priceSubmitBtn = $('#price_submit');
		this.priceLabelFrom = this.priceLabel.find('.from');
		this.priceLabelTo = this.priceLabel.find('.to');
		this.price_min = 0;
		this.price_max = parseInt(this.priceDiv.data('max'));
		if (!this.price_max)
			return;

		this.price_from = parseInt(this.priceDiv.data('from'));
		this.price_to = parseInt(this.priceDiv.data('to'));

		this.priceDiv.show();
		this.priceLabel.show();

		this.priceDiv.slider({
			range: true,
			animate: true,
			step: 100,
			min: this.price_min,
			max: this.price_max,
			values: [this.price_from, this.price_to],
			slide: this.priceSlide
		});

		this.priceSubmitBtn.click(this.priceSubmit);
	},
	searchSubmit: function() {
		Filters.updateProducts();
		return false;
	},
	priceSubmit: function() {
		Filters.updateProducts();
		return false;
	},
	priceSlide: function(event, ui) {
		Filters.price_from = parseInt(ui.values[0]);
		Filters.price_to = parseInt(ui.values[1]);
		Filters.priceLabelFrom.text(Filters.price_from);
		Filters.priceLabelTo.text(Filters.price_to);
	},
	priceCorrect: function(data) {
		if (!Filters.price_max)
			return;

		Filters.price_from = data.FROM;
		Filters.price_to = data.TO;
		Filters.priceDiv.slider('values', [Filters.price_from, Filters.price_to]);
		Filters.priceLabelFrom.text(Filters.price_from);
		Filters.priceLabelTo.text(Filters.price_to);
	},
	toggleGroup: function () {
		var gr = jQuery(this).parent();
		var dropmenu = gr.children('.profiles');
		if (gr.hasClass('closed')) {
			gr.removeClass('closed');
			dropmenu.stop().fadeIn('slow', 'linear');
		}
		else {
			gr.addClass('closed')
			dropmenu.stop().fadeOut('slow', 'linear');
		}
		var val = '';
		Filters.groups.each(function() {
			var s = jQuery(this).hasClass('closed') ? 1 : 0;
			val += s + ',';
		});
		var d = new Date();
		d.setTime(d.getTime() + 8640000000);
		document.cookie = "filter_groups=" + val + "; path=/; expires=" + d.toUTCString();
	},
	categoryClick: function() {
		var a = jQuery(this);
		var li = a.parent();
		li.toggleClass('chosen');
		var checked = li.hasClass('chosen');
		if (!checked) {
			li.find('li.chosen').removeClass('chosen');
			while (li.length) {
				var ul = li.parent();
				li = ul.parent();
				if (!li.is('li'))
					break;

				li.removeClass('chosen');
			}
		}
		else {
			li.find('li:not(.chosen)').addClass('chosen');
			while (li.length) {
				var ul = li.parent();
				li = ul.parent();
				if (!li.is('li'))
					break;

				var all = true;
				ul.children('li').each(function() {
					if (!jQuery(this).hasClass('chosen'))
					{
						all = false;
						return false;
					}
				});
				if (all)
					li.addClass('chosen');
				else
					li.removeClass('chosen');
			}
		}
		Filters.updateProducts();

		return false;
	},
	colorClick: function() {
		var li = jQuery(this);
		li.toggleClass('chosen');
		Filters.updateProducts();
	},
	checkboxClick: function() {
		var a = jQuery(this);
		var li = a.parent();
		li.toggleClass('chosen');
		var checked = li.hasClass('chosen');
		if (!checked)
			li.find('li.chosen').removeClass('chosen');
		else
			li.find('li:not(.chosen)').addClass('chosen');
		Filters.updateProducts();

		return false;
	},
	sortChange: function() {
		var select = jQuery(this);
		Filters.sort = select.val();
		Filters.updateProducts();
	},
	sizeChange: function() {
		var select = jQuery(this);
		Filters.size = select.val();
		Filters.updateProducts();
	},
	updateCb: function(input) {
		var li = input.closest('li');
		var checked = input.prop('checked');
		if (checked)
			li.addClass('checked');
		else
			li.removeClass('checked');
		Filters.updateProducts();
	},
	updateProducts: function() {
		var url = Filters.catalogPath;
		Filters.groups.each(function() {
			var part = '';
			var cb = jQuery(this).find('input[type=checkbox]:checked');
			cb.each(function() {
				if (part)
					part += Filters.separator;
				part += jQuery(this).attr('name');
			});
			var lis = jQuery(this).find('li.chosen');
			lis.each(function() {
				var li = jQuery(this);
				if (!li.parent().parent().is('.chosen')) {
					if (part)
						part += Filters.separator;
					part += li.data('code');
				}
			});
			if (part)
				url += part + '/';
		});
		var params = '';
		var sq = Filters.searchInput.val();
		if (sq) {
			params += params ? '&' : '?';
			params += 'q=' + sq;
		}
		if (Filters.sort) {
			params += params ? '&' : '?';
			params += 'sort=' + Filters.sort;
			Filters.sort = '';
		}
		if (Filters.size) {
			params += params ? '&' : '?';
			params += 'size=' + Filters.size;
			Filters.size = '';
		}
		if (Filters.price_from <= Filters.price_to) {
			if (Filters.price_from > Filters.price_min) {
				params += params ? '&' : '?';
				params += 'p-from=' + Filters.price_from;
			}
			if (Filters.price_to < Filters.price_max) {
				params += params ? '&' : '?';
				params += 'p-to=' + Filters.price_to;
			}
		}
		url += params;
		Filters.loadProducts(url, true);
	},
	loadProducts: function(url, setHistory) {
		Filters.ajaxCont.html('<div class="pp_default"><div class="pp_loaderIcon"></div></div>');
		jQuery.post(url, {
			'mode': 'ajax'
		}, function (resp) {
			Filters.ajaxCont.html(resp.HTML);
			Filters.bcCont.html(resp.BC);
			Filters.h1Cont.html(resp.H1);
			Filters.searchInput.val(resp.SEARCH);
			for (var i in resp.FILTERS) {
				if (i == 'PRICE') {
					Filters.priceCorrect(resp.FILTERS[i]);
				}
				else if (i == 'CATEGORY') {
					for (var j in resp.FILTERS[i]) {
						var cnt = resp.FILTERS[i][j][0];
						var checked = resp.FILTERS[i][j][1];
						var li = Filters.panel.find('li[data-code=' + j + ']');
						if (li.length)
						{
							if (checked)
								li.addClass('chosen');
							else
								li.removeClass('chosen');
							li.children('small').text(cnt);
						}
					}
				}
				else {
					var cnt = resp.FILTERS[i][0];
					var checked = resp.FILTERS[i][1];
					var li = Filters.panel.find('li[data-code=' + i + ']');
					if (li.length)
					{
						if (checked)
							li.addClass('chosen');
						else
							li.removeClass('chosen');
						li.children('small').text(cnt);
					}
				}
			}

			document.title = resp.TITLE;
			if (setHistory)
				history.pushState('', resp.TITLE, url);

			return false;
		});
	},
	urlClick: function() {
		var url = jQuery(this).attr('href');
		if (url == '/')
			return true;

		Filters.loadProducts(url, true);
		return false;
	},
	addToCart: function() {
		var a = jQuery(this);
		var id = a.data('id');
		if (id)
			Cart.add(id, 1);

		return false;
	}
};

/**
 * Карточка товара и быстрый просмотр
 */
var Detail = {
	productId: 0,
	inpack: 0,
	price: 0,
	init: function($) {
		this.product = $('.product');
		if (!this.product.length)
			return;

		this.form = $('form.cart');
		this.form.on('submit', this.addToCart);

		this.total = this.product.find('#js-total');
		this.qty = this.product.find('.qty');
		if (this.total.length) {
			this.quantity = this.product.find('#js-qty');
			this.price = this.total.data('price');
			this.inpack = this.quantity.data('inpack');

			this.qty.on('input', this.qtyChange);
		}
	},
	qtyChange: function() {
		var input = jQuery(this);
		var cnt = input.val();
		if (cnt < 1)
			cnt = 1;
		cnt = parseInt(cnt, 10);
		var total = Math.round(cnt * Detail.inpack * Detail.price);
		Detail.total.text(Cart.format(total));
		var quantity = Math.round(Detail.inpack * cnt * 1000) / 1000;
		Detail.quantity.text(quantity);
	},
	addToCart: function() {

		var id = Detail.form.data('id');
		if (id) {
			var cnt = Detail.qty.val();
			if (cnt < 1)
				cnt = 1;
			Cart.add(id, cnt);
		}

		return false;
	}
};

/**
 * Корзина
 */
var Cart = {
	init: function($) {
		this.cnt = $('#js-cart-count');
		this.minicart = $('#minicart-cont');
		this.cart = $('#cart');

		this.minicart.on('click', '.remove', this.removeMini);
		this.cart.on('input', '.qty', this.qtyInput);
	},
	removeMini: function() {
		var id = jQuery(this).data('id');
		Cart.remove(id);
	},
	qtyInput: function() {
		var input = jQuery(this);
		var tr = input.closest('tr');
		var id = tr.data('id');
		var total = tr.find('.js-total');

		var price = input.data('price');
		var cnt = input.val();
		if (cnt < 1) {
			cnt = 1;
		}

		total.html(Cart.format(price * cnt));

		Cart.updateCount(id, cnt);
	},
	add: function(id, cnt) {
		jQuery.post('/ajax/cart.php', {
			action: 'add',
			id: id,
			cnt: cnt
		}, Cart.afterAjax);
	},
	updateCount: function(id, cnt) {
		jQuery.post('/ajax/cart.php', {
			action: 'cnt',
			id: id,
			cnt: cnt
		}, Cart.afterAjax);
	},
	remove: function(id) {
		jQuery.post('/ajax/cart.php', {
			action: 'remove',
			id: id
		}, Cart.afterAjax);
	},
	afterAjax: function(resp) {
		if (resp.CART)
			Cart.cnt.text(resp.CART.COUNT);
		if (resp.MINI)
			Cart.minicart.html(resp.MINI);
	},
	format: function(n) {
		return Cart.number_format(n, 0, '.', ' ');
	},
	number_format: function (number, decimals, dec_point, thousands_sep) {
		var i, j, kw, kd, km;
		if (isNaN(decimals = Math.abs(decimals)))
			decimals = 2;

		i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

		if ((j = i.length) > 3)
			j = j % 3;
		else
			j = 0;

		km = (j ? i.substr(0, j) + thousands_sep : "");
		kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
		kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");

		return km + kw + kd;
	}
};

/**
 * Старт
 */

(function($){
	$(document).ready(function() {
		Filters.init($);
		Detail.init($);
		Cart.init($);
	});
})(jQuery);

