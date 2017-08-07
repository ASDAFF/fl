var Basket = {
    url: null,
    itemClass: null,
    btnClass: null,
    fastOrderClass: null,
    fastOrderBtnClass: null,
    successAddFunction: function(ans) {
        $.fancybox(ans);
    },
    successMessage: '<div class="success">' +
        '<div class="title">Заказ успешно оформлен</div>' +
        '<div class="text">В ближайшее время наш менеджер свяжется с Вами!</div>' +
    '</div>',

    //must be called first
    init: function(basketAjaxUrl) {
        var _this = $.extend(true, {}, this);
        _this.url = basketAjaxUrl;
        return _this;
    },
    setItemClass: function(itemCssClass) {
        this.itemClass = itemCssClass;
        return this;
    },
    setBtnClass: function(btnCssClass) {
        this.btnClass = btnCssClass;
        return this;
    },
    setFastOrderBtnClass: function(btnCssClass) {
        this.fastOrderBtnClass = btnCssClass;
        return this;
    },
    setFastOrderClass: function(cssClass) {
        this.fastOrderClass = cssClass;
        return this;
    },
    setEvents: function() {
        var _this = this;
        $(this.btnClass).off('click').on('click', function(e) {
            e.preventDefault();
            var data = $(this).data();
            data['PRODUCT_ID'] = data['id'];
            if(data['props'])
            {
                var props = data['props'].split(',');
                data['PROPERTIES'] = {};
                for (var code in props)
                {
                    var found = $(this).closest('.catalogFull').find('[data-name="' + props[code] + '"].selected');
                    if(found && found.text())
                    {
                        data['PROPERTIES'][props[code]] = found.text();
                    }
                }
            }
            _this.add(data, $(this).closest(_this.itemClass).get(0));
        })
        return this;
    },
    setSuccessMessage: function(msg) {
        this.successMessage = msg;
        return this;
    },
    add: function(itemInfo, waitElement) {
        var _this = this;
        if(waitElement == 'undefined')
            waitElement = $('body').get(0);
        BX.showWait(waitElement);
        $.post((this.url + (this.url.indexOf('?') !== -1 ? '&' : '?') + 'action=add'), itemInfo, function(ans) {
            _this.successAddFunction(ans);
            BX.closeWait(waitElement);
        }, 'json');
        return this;
    },
    setSuccessAddFunction: function(fn) {
        this.successAddFunction = fn;
        return this;
    },
    setFastOrder: function(formSelector, waitElement) {
        var foForm = $(formSelector),
            _this = this;
        waitElement = waitElement || foForm.find('[type="submit"]').parent().get(0);
        _this.setPlusMinusEvents();
        $(_this.fastOrderBtnClass).off('click').on('click', function(e) {
            e.preventDefault();
            foForm.find('input, textarea').val('');
            foForm.find('input, textarea').css({'border': 'none'});
            foForm.find('.it-error').empty();
            foForm.find('input[name="PRODUCT_ID"]').val($(this).data('id'));
            foForm.find('input[name="QUANTITY"]').val(1);
            $.fancybox(foForm);
        });

        foForm.find('form').off('submit').on('submit', function(e) {
            e.preventDefault();
            var curForm = $(this);
            BX.showWait(waitElement);
            $.post($(this).attr('action'), $(this).serialize(), function(ans) {
                BX.closeWait(waitElement);
                if(ans.errors)
                {
                    foForm.find('.it-error').empty();
                    foForm.find('input, textarea').css({'border': 'none'});
                    for(var inputName in ans.errors)
                    {
                        _this.addErrorToElement(curForm.find('[name="' + inputName + '"]').first(), ans.errors[inputName]);
                    }
                }
                else
                {
                    $.fancybox.close()
                    $.fancybox(_this.successMessage)
                }

            }, 'json')
            return false;
        })
        return this;
    },
    setPlusMinusEvents: function() {
        $('.plus, .minus').off('click').on('click', function(e) {
            e.preventDefault();
            var inp = $(this).parent().find('input').first(),
                n = parseInt(inp.val().replace(/\D+/g, '')) + ($(this).hasClass('plus') ? 1 : -1);
            if(n < 1 || isNaN(n))
                n = 1;
            inp.val(n);
        });
        $('.plus').parent().find('input').off('input change').on('input change', function() {
            var n = parseInt($(this).val().replace(/\D+/g, ''));
            if(n < 1 || isNaN(n))
                n = 1;
            $(this).val(n);
        });
        return this;
    },
    addErrorToElement: function(element, errorText) {
        $(element).css({border: '1px solid red'}).closest('.it-block').find('.it-error').html(errorText)
        return this;
    },
};