var Order = function(){
    this.dom = {
        delivery: $('#form-delivery'),
        orderDeliveryOption: $('.order-delivery-option'),
        forDelivery: $('.for-delivery'),
        forPickup: $('.for-pickup'),
        region: $('#form-region'),
        cities: $('#form-cities'),
        deliveryPrice: $('.delivery-price'),
        fullPrice: $('.full-price'),
        formPickupPoint: $('#form-pickup-point')
    };

    this.real = {
        sum: window.sum,
        tempPlacemark: null
    };

    this.options = {
        deliveryPrices: window.deliveryPrices,
        hasOldInput: window.hasOldInput,
        oldCityId: window.oldCityId,
        pickupPoints: window.pickupPoints
    };

    this.config = {
        actions: window.actions,
    };

    this.init = function(){
        this.initYmaps();
        this.initSelect2();
        this.updatePrices();
        this.addEventListeners();
        this.updateOrderData();
        this.checkOldInput();
    };

    this.initYmaps = function(){
        var self = this;
        window.ymaps.ready(init);
        var myMap;
        function init(){
            myMap = new window.ymaps.Map("map", {
                center: [50.3, 57.5],
                zoom: 14,
            });
            self.dom.formPickupPoint.on('change', function(){
                self.pickupPointChangeEvent(myMap);
            });
            self.pickupPointChangeEvent(myMap, false)
        }
    };

    this.showOnMap = function(map, position){
        if (this.real.tempPlacemark!==null) {
            map.geoObjects.remove(this.real.tempPlacemark);
            this.real.tempPlacemark = null;
        }
        this.real.tempPlacemark = new ymaps.Placemark(position);
        map.geoObjects.add(this.real.tempPlacemark);
    };

    this.pickupPointChangeEvent = function(map, animate){
        if (typeof animate==='undefined') animate=true;
        var id = this.dom.formPickupPoint.val(),
            mapData = this.options.pickupPoints[id];
        this.showOnMap(map, [mapData.lat, mapData.lng]);
        if (animate) {
            map.setCenter([mapData.lat, mapData.lng], map.getZoom(), {duration:300});
        }
        else {
            map.setCenter([mapData.lat, mapData.lng]);
        }
    };

    this.addEventListeners = function(){
        var self = this;
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
        this.updatePrices();
    };

    this.updatePrices = function(){
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
        }
    };

    this.deliveryChangeEvent = function(){
        var self = this;
        if (self.dom.delivery.val()==='1') {
            self.dom.forPickup.hide();
            self.dom.forDelivery.show();
        }
        else {
            self.dom.forDelivery.hide();
            self.dom.forPickup.show();
        }
    };

    this.init();
};
new Order();
