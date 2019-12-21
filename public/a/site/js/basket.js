var Basket = function(){
    this.dom = {
        allPrice: $('.all-price'),
        allSaleBlock: $('.all-sale-block'),
        allSale: $('.all-sale'),
        orderModalToggle: $('#order-modal-toggle'),
        ifCantShop: $('.if-cant-shop'),
        ifCantDelivery: $('.if-cant-delivery'),
        allCheckbox: $('#all-checkbox'),
        ifNotChecked: $('.if-not-checked'),
        priceBlock: $('.price-block')
    };

    this.real = {};

    this.options = {
        userSale: parseInt(window.userSale),
    };

    this.minimums = window.minimums;

    this.config = {
        actions: window.actions,
        csrf: window.csrf
    };

    this.init = function(){
        this.updatePrices();
        this.addEventListeners();
    };

    this.updatePrices = function(){
        var self=this,
            allPrice = 0,
            salePrice = 0;
        self.dom.allSaleBlock.hide();
        var anyPart = false;
        $.each($('.basket-part-row'), function(i,e){
            var item = $(e),
                numberInput = item.find('.number-input'),
                count = parseInt(numberInput.val()),
                price = parseInt(numberInput.data('price')),
                csCount = parseInt(numberInput.data('cs-count')),
                csPercent = parseInt(numberInput.data('cs-percent')),
                bpSale = item.find('.bp-sale').hide(),
                bpSaleSum = bpSale.find('.bp-sale-sum');
            var selfPrice = count*price,
                updateAllPrice = item.find('.part-checkbox:checked').length!==0;
            if (csCount && csPercent && count>=csCount) {
                bpSaleSum.text(self.parsePrice(selfPrice));
                bpSale.show();
                selfPrice = selfPrice*(1-csPercent/100);
            }
            else if (self.options.userSale && updateAllPrice) {
                salePrice += (selfPrice*self.options.userSale/100);
            }
            item.find('.bp-sum').text(self.parsePrice(selfPrice));
            if (updateAllPrice) {
                allPrice+=selfPrice;
                anyPart = true;
            }
        });
        if (salePrice>0) {
            self.dom.allSale.text(self.parsePrice(allPrice));
            self.real.sum = self.parsePrice(allPrice - salePrice);
            self.dom.allSaleBlock.show();
        }
        else {
            self.real.sum = allPrice;
        }
        if (!anyPart) {
            self.dom.orderModalToggle.attr('disabled', 'disabled');
            self.dom.ifCantShop.hide();
            self.dom.ifNotChecked.show();
            self.dom.priceBlock.hide();
        }
        else if (self.real.sum<self.minimums.shop) {
            self.dom.orderModalToggle.attr('disabled', 'disabled');
            self.dom.ifCantShop.show();
            self.dom.ifNotChecked.hide();
            self.dom.priceBlock.show();
        }
        else {
            self.dom.orderModalToggle.removeAttr('disabled');
            self.dom.ifCantShop.hide();
            self.dom.ifNotChecked.hide();
            self.dom.priceBlock.show();
        }
        self.dom.allPrice.text(self.parsePrice(self.real.sum));
        // self.updateDeliveryPrice();
    };

    this.addEventListeners = function(){
        var self = this;
        $('.number-btn').on('click', function(){
            self.stepNumberInput($(this));
        });
        $('.number-input').on('input', function(){
            var $this = $(this);
            $this.val($this.val().replace(/^0|[^0-9]+/g, ''));
        }).on('change', function(){
            var $this = $(this),
                minimum = parseInt($this.attr('data-minimum')),
                maximum = parseInt($this.attr('data-available')),
                multiplication = parseInt($this.attr('data-multiplication')),
                value = $this.val();
            value = value?parseInt(value):0;
            if (value < minimum) {
                value = minimum;
                $this.val(minimum);
            }
            else if (value > maximum) {
                value = maximum;
                $this.val(maximum);
            }
            else if (value%multiplication !== 0) {
                var x = Math.floor(value/multiplication);
                value = x*multiplication;
                $this.val(value);
            }
            var row = $this.parents('.basket-part-row');
            row.addClass('loader-shown');
            self.sendAjax(self.config.actions.update, {
                itemId: row.data('id'),
                count: value,
            }, function(){
                self.updatePrices();
                row.removeClass('loader-shown');
            });
        });
        $('.delete-basket-item').on('click', function(){
            self.deleteBasketItem($(this));
        });
        self.dom.orderModalToggle.on('click', function(){
            if (self.dom.orderModalToggle.is(':disabled')) return false;
            window.location.href = self.config.actions.order;
        });
        $('.part-checkbox').on('change', function(){
            self.changeChecked($(this));
        });
        self.dom.allCheckbox.on('change', function(){
            self.changeAllChecked();
        });
    };

    this.stepNumberInput = function(btn) {
        var self = this,
            positive = btn.hasClass('number-input-plus'),
            row = btn.parents('.basket-part-row'),
            numberInput = row.find('.number-input'),
            count = parseInt(numberInput.val()),
            multiplication = parseInt(numberInput.data('multiplication')),
            minCount = parseInt(numberInput.data('minimum')),
            available = parseInt(numberInput.data('available')),
            newCount;
        if (positive) {
            newCount = (Math.floor(count/multiplication)+1)*multiplication;
            if (newCount>available) return false;
        } else {
            newCount = (Math.ceil(count/multiplication)-1)*multiplication;
            if (newCount<minCount) return false;
        }
        row.addClass('loader-shown');
        self.sendAjax(self.config.actions.update, {
            itemId: row.data('id'),
            count: newCount,
        }, function(){
            numberInput.val(newCount);
            self.updatePrices();
            row.removeClass('loader-shown');
        });
    };

    this.deleteBasketItem = function(btn){
        var self = this,
            row = btn.parents('.basket-part-row');
        self.sendAjax(self.config.actions.delete, {
            itemId: row.data('id')
        });
        row.remove();
        if ($('.basket-part-row').length===0) {
            $('.not-in-stock-hidden').remove();
        }
        else {
            self.updatePrices();
        }
    };

    this.sendAjax = function(url, data, callback){
        var self=this;
        data._token = this.config.csrf;
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            success: function(e){
                if (typeof callback === 'function') callback(e);
            },
            error: function(){
                self.renderError();
            }
        });
    };

    this.parsePrice = function(value){
        return parseFloat(value.toFixed(2));
    };

    this.renderError = function(){
        window.location.href = '';
    };

    this.changeChecked = function(elem) {
        var self = this,
            row = elem.parents('.basket-part-row'),
            newStatus = elem.is(':checked')?1:0;
        self.sendAjax(self.config.actions.check, {
            itemId: row.data('id'),
            status: newStatus
        });
        self.updatePrices();
        if ($('.part-checkbox:not(:checked)').length===0) self.dom.allCheckbox.prop('checked', 'checked');
        else self.dom.allCheckbox.prop('checked', '');
    };

    this.changeAllChecked = function(){
        var self = this,
            newStatus = self.dom.allCheckbox.is(':checked')?1:0;
        self.sendAjax(self.config.actions.check, {
            itemId: 0,
            status: newStatus
        });
        if (newStatus===1) $('.part-checkbox').prop('checked', 'checked');
        else $('.part-checkbox').prop('checked', '');
        self.updatePrices();
    };

    this.init();
};
new Basket();
