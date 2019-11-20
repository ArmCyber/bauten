var Search = function(){
    this.dom = {
        searchCatalogue: $('.home-search-catalogue'),
        brandsBlock: $('.home-block-brand'),
        searchEngine: $('#home-search-engine'),
    };

    this.options = {
        max: 5
    };

    this.urls = window.urls;

    this.init = function(){
        this.initPlugins();
        this.addEventListeners();
    };

    this.initPlugins = function(){
        this.dom.searchEngine.select2({
            minimumInputLength: 3,
            maximumSelectionLength: this.options.max,
            ajax: {
                url: this.urls.engines
            }
        });
    };

    this.addEventListeners = function(){
        var self = this;
        $('.home-search-toggle').on('click', function(){
            self.toggleExpand($(this));
        });
        $('.home-search-catalogue').on('click', function(){
            self.toggleCatalogueSelect($(this));
        });
        $('.home-search-brand').on('click', function(){
            self.toggleBrandSelect($(this));
        });
    };

    this.toggleCatalogueSelect = function(elem){
        $('.home-search-brand.home-search-disabled').removeClass('home-search-disabled');
        if (elem.hasClass('selected')) {
            $('.home-search-catalogue.selected').removeClass('selected');
        } else {
            $('.home-search-catalogue.selected').removeClass('selected');
            var id = elem.data('id');
            $('.home-search-catalogue[data-id="'+id+'"]').addClass('selected');
            this.checkDisabledBrands(id);
        }
        this.checkExceeded(this.dom.brandsBlock);
    };

    this.checkExceeded = function(block) {
        if(block.find('.search-group-select.selected').length>=this.options.max) block.addClass('max-exceeded');
        else block.removeClass('max-exceeded');
    };

    this.toggleBrandSelect = function(elem){
        var self = this;
        if (elem.hasClass('home-search-disabled')) return false;
        var id = elem.data('id');
        if (elem.hasClass('selected')) {
            $('.home-search-brand[data-id="'+id+'"]').removeClass('selected');
        }
        else {
            if (self.dom.brandsBlock.hasClass('max-exceeded')) return false;
            $('.home-search-brand[data-id="'+id+'"]').addClass('selected');
        }
        self.checkExceeded(self.dom.brandsBlock);
    };

    this.checkDisabledBrands = function(id) {
        var self = this;
        self.dom.brandsBlock.addClass('loader-shown');
        this.sendAjax('disabledBrands', {
            catalogueId: id
        }, true, function(e){
            self.dom.brandsBlock.removeClass('loader-shown');
            if (e.items.length) {
                $.each(e.items, function(key, id) {
                    $('.home-search-brand[data-id="'+id+'"]').removeClass('selected').addClass('home-search-disabled');
                });
            }
        });
        self.checkExceeded(self.dom.brandsBlock);
    };

    this.toggleExpand = function(btn) {
        var block = btn.parents('.home-search-block');
        if (block.hasClass('expanded')) {
            block.removeClass('expanded').find('.home-search-expanded').slideUp(200);
        }
        else {
            block.addClass('expanded').find('.home-search-expanded').slideDown(200);
        }
    };

    this.sendAjax = function(action, data, json, callback){
        if (typeof json === 'undefined') json=false;
        var self = this;
        $.ajax({
            url: self.urls[action],
            data: data,
            type: 'get',
            dataType: json?'json':'html',
            success: function(e){
                if (typeof callback === 'function') callback(e);
            },
            error: function(e){
                console.error(e.responseText);
            }
        });
    };

    this.init();
};
var a = new Search();
