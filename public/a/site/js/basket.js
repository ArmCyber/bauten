var Basket = function(){
    this.dom = {
        allPrice: $('.all-price'),
        allSaleBlock: $('.all-sale-block'),
        allSale: $('.all-sale'),
        orderModalToggle: $('#order-modal-toggle'),
        ifCantShop: $('.if-cant-shop'),
        //ORDER
        delivery: $('#form-delivery'),
    };

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
        //ORDER
        this.initSelect2();
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
        var sum;
        if (salePrice>0) {
             self.dom.allSale.text(self.parsePrice(allPrice));
             sum = self.parsePrice(allPrice - salePrice);
             self.dom.allSaleBlock.show();
        }
        else {
            sum = allPrice;
        }
        if (sum<self.minimums.shop) {
            self.dom.orderModalToggle.attr('disabled', 'disabled');
            self.dom.ifCantShop.show();
        }
        else {
            self.dom.orderModalToggle.removeAttr('disabled');
            self.dom.ifCantShop.hide();
        }
        self.dom.allPrice.text(self.parsePrice(sum));
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
                window.location.href = '';
            }
        });
    };

    this.parsePrice = function(value){
        return parseFloat(value.toFixed(2));
    };

    this.initSelect2 = function(){
        $('.select2').select2();
    };

    this.init();
};
var a = new Basket();
