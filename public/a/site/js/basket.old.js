var Basket = function(){
    this.dom = {
        allPrice: $('.all-price'),
        allSaleBlock: $('.all-sale-block'),
        allSale: $('.all-sale'),
        orderModalToggle: $('#order-modal-toggle'),
        ifCantShop: $('.if-cant-shop'),
        ifCantDelivery: $('.if-cant-delivery'),
        //ORDER
        delivery: $('#form-delivery'),
        orderDeliveryOption: $('.order-delivery-option'),
        forDelivery: $('.for-delivery'),
        region: $('#form-region'),
        cities: $('#form-cities'),
        deliveryPrice: $('.delivery-price'),
        fullPrice: $('.full-price'),
        orderModal: $('#order-modal')
    };

    this.real = {};

    this.options = {
        userSale: parseInt(window.userSale),
        deliveryPrices: window.deliveryPrices,
        hasOldInput: window.hasOldInput,
        oldCityId: window.oldCityId
    };

    this.minimums = window.minimums;

    this.config = {
        actions: window.actions,
        csrf: window.csrf
    };

    this.init = function(){
        this.updatePrices();
        this.addEventListeners();
        this.updateOrderData();
        this.checkOldInput();
    };

    this.updatePrices = function(){
        var self=this,
            allPrice = 0,
            salePrice = 0;
        self.dom.allSaleBlock.hide();
        $.each($('.basket-part-row'), function(i,e){
            var item = $(e),
                numberInput = item.find('.number-input'),
                count = parseInt(numberInput.val()),
                price = parseInt(numberInput.data('price')),
                csCount = parseInt(numberInput.data('cs-count')),
                csPercent = parseInt(numberInput.data('cs-percent')),
                bpSale = item.find('.bp-sale').hide(),
                bpSaleSum = bpSale.find('.bp-sale-sum');
            var selfPrice = count*price;
            if (csCount && csPercent && count>=csCount) {
                bpSaleSum.text(self.parsePrice(selfPrice));
                bpSale.show();
                selfPrice = selfPrice*(1-csPercent/100);
            }
            else if (self.options.userSale) {
                salePrice += (selfPrice*self.options.userSale/100);
            }
            item.find('.bp-sum').text(self.parsePrice(selfPrice));
            allPrice+=selfPrice;
        });
        if (salePrice>0) {
             self.dom.allSale.text(self.parsePrice(allPrice));
             self.real.sum = self.parsePrice(allPrice - salePrice);
             self.dom.allSaleBlock.show();
        }
        else {
            self.real.sum = allPrice;
        }
        if (self.real.sum<self.minimums.shop) {
            self.dom.orderModalToggle.attr('disabled', 'disabled');
            self.dom.ifCantShop.show();
        }
        else {
            self.dom.orderModalToggle.removeAttr('disabled');
            self.dom.ifCantShop.hide();
            if (self.real.sum<self.minimums.delivery) {
                self.dom.orderDeliveryOption.attr('disabled', 'disabled');
                self.dom.delivery.val(0).trigger('change');
                self.dom.ifCantDelivery.show();
                self.initSelect2();
            }
            else {
                self.dom.orderDeliveryOption.removeAttr('disabled');
                self.dom.ifCantDelivery.hide();
                self.initSelect2();
            }
        }
        self.dom.allPrice.text(self.parsePrice(self.real.sum));
        self.updateDeliveryPrice();
    };

    this.addEventListeners = function(){
        var self = this;
        $('.number-btn').on('click', function(){
            self.stepNumberInput($(this));
        });
        $('.delete-basket-item').on('click', function(){
            self.deleteBasketItem($(this));
        });
        //ORDER
        self.dom.delivery.on('change', function(){
            self.deliveryChangeEvent();
        });
        self.dom.region.on('change', function(){
            self.regionChangeEvent();
        });
        self.dom.cities.on('change', function(){
            self.cityChangeEvent();
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

    this.initSelect2 = function(){
        $('.select2').select2();
    };

    this.regionChangeEvent = function() {
        var self = this;
        self.dom.cities.html('');
        var id = self.dom.region.val(),
            this_cities = regions.find(x => x.id==id);
        if (this_cities.length===0) self.renderError();
        $.each(this_cities.cities, function(key, el){
            self.newSelectOption(el.id, el.title).appendTo(self.dom.cities);
        });
        self.cityChangeEvent();
    };

    this.newSelectOption = function(value, title){
        return $('<option></option>').attr('value', value).text(title);
    };

    this.renderError = function(){
        window.location.href = '';
    };

    this.updateOrderData = function(){
        var self = this;
        self.dom.region.trigger('change');
    };

    this.cityChangeEvent = function(){
        var self = this,
            cityId = parseInt(self.dom.cities.val()),
            deliveryPrice = self.options.deliveryPrices[cityId];
        if (typeof deliveryPrice === 'undefined') self.renderError();
        self.real.deliveryPrice = parseInt(deliveryPrice);
        this.updateDeliveryPrice();
    };

    this.updateDeliveryPrice = function(){
        var self = this;
        if (!self.real.deliveryPrice) return false;
        self.dom.deliveryPrice.text(self.parsePrice(self.real.deliveryPrice));
        self.dom.fullPrice.text(self.parsePrice(self.real.deliveryPrice + self.real.sum));
    };

    this.checkOldInput = function(){
        var self = this;
        if (self.options.hasOldInput) {
            if (self.options.oldCityId!==0) self.dom.cities.val(self.options.oldCityId).trigger('change');
            self.deliveryChangeEvent();
            self.dom.orderModal.modal('show');
        }
    };

    this.deliveryChangeEvent = function(){
        var self = this;
        if (self.dom.delivery.val()==='1') self.dom.forDelivery.show();
        else self.dom.forDelivery.hide();
    };

    this.init();
};
var a = new Basket();
