var Search = function(){
    this.dom = {
        catalogueBlock: $('#home-catalogue-block'),
        searchCatalogue: $('.home-search-catalogue'),
        brandsBlock: $('.home-block-brand'),
        searchEngine: $('#home-search-engine'),
        marksBlock: $('#home-marks-block'),
        modelsBlock: $('#home-models-block'),
        modelsRow: $('#home-models-row'),
        generationsBlock: $('#home-generations-block'),
        generationsRow: $('#home-generations-row'),
        clearButton: $('#home-search-clear'),
        applyButton: $('#home-search-apply'),
        brandsBlockContent: $('.home-block-brand .home-search-content'),
        catalogueBlockContent: $('#home-catalogue-block .home-search-content'),
    };

    this.options = {
        max: 5
    };

    this.realTime = {
        carBlocked: false,
        brandBlocked: false,
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
        self.dom.catalogueBlock.on('click', '.home-search-catalogue', function(){
            self.toggleCatalogueSelect($(this));
        });
        self.dom.brandsBlock.on('click', '.home-search-brand', function(){
            self.toggleBrandSelect($(this));
        });
        $('.home-search-mark').on('click', function(){
            self.toggleMarkSelect($(this));
        });
        self.dom.modelsBlock.on('click', '.home-search-model', function(){
            self.toggleModelSelect($(this));
        });
        self.dom.generationsBlock.on('click', '.home-search-generation', function(){
            self.toggleGenerationBlock($(this));
        });
        self.dom.clearButton.on('click', function(){
            self.clearSearch();
        });
        self.dom.applyButton.on('click', function(){
            self.applySearch();
        });
    };

    this.toggleCatalogueSelect = function(elem){
        if (this.realTime.brandBlocked) return false;
        $('.home-search-brand.home-search-disabled').removeClass('home-search-disabled');
        $('.home-search-brand.home-search-temp').remove();
        if (elem.hasClass('selected')) {
            $('.home-search-catalogue.selected').removeClass('selected');
            $('.home-search-catalogue-content').html('');
        } else {
            $('.home-search-catalogue.selected').removeClass('selected');
            var id = elem.data('id');
            $('.home-search-catalogue-content').html('');
            $('.home-search-catalogue-content').append('<span class="home-search-option home-search-catalogue selected" data-id="'+id+'">'+elem.html()+'</span>')
            // console.log('stea haa zapchast@');

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
        if (this.realTime.brandBlocked) return false;
        var self = this;
        if (elem.hasClass('home-search-disabled')) return false;
        var id = elem.data('id');
        if (elem.hasClass('selected')) {
            $('.home-search-brand[data-id="'+id+'"]').removeClass('selected');
            $('.home-search-brand-check-selected[data-id="'+id+'"]').remove();

        }
        else {
            if (self.dom.brandsBlock.hasClass('max-exceeded')) return false;
            $('.home-search-brand-check-selected').each(function () {
                if(!$(this).hasClass('selected')){
                    $(this).remove();
                }
            })
                $('.home-search-brand-content').append('<span class="home-search-option home-search-brand home-search-brand-check-selected selected" data-id="'+id+'">'+elem.html()+'</span>')


            // console.log('stea haa brend@')

            $('.home-search-brand[data-id="'+id+'"]').addClass('selected');
        }
        self.checkDisabledCatalogs();
        self.checkExceeded(self.dom.brandsBlock);
    };

    this.toggleMarkSelect = function(elem){
        var self = this,
            dataId = elem.data('id');
        if (self.realTime.carBlocked) return false;
        if (elem.hasClass('selected')) {
            $('.home-search-mark[data-id="'+dataId+'"]').removeClass('selected');
            $('.home-search-mark-check[data-id="'+dataId+'"]').remove();
        }
        else {
            // console.log('stea haa markeq@')

            if (self.dom.marksBlock.hasClass('max-exceeded')) return false;
            $('.home-search-mark-check').each(function () {
                if(!$(this).hasClass('selected')){
                    $(this).remove();
                }
            })
            $('.home-search-mark[data-id="'+dataId+'"]').addClass('selected');

            $('.home-search-mark-content').append('<span class="home-search-option home-search-mark home-search-mark-check selected" data-id="'+dataId+'">'+elem.html()+'</span>')

        }
        self.checkExceeded(self.dom.marksBlock);
        self.updateModelsSelect();
    };

    this.toggleModelSelect = function(elem) {
        var self = this,
            dataId = elem.data('id');
        if (self.realTime.carBlocked) return false;
        if (elem.hasClass('selected')) {
            $('.home-search-model[data-id="'+dataId+'"]').removeClass('selected');
        }
        else {
            // console.log('stea haa model@')

            if (self.dom.modelsBlock.hasClass('max-exceeded')) return false;
            $('.home-search-model[data-id="'+dataId+'"]').addClass('selected');
        }
        self.checkExceeded(self.dom.modelsBlock);
        self.updateGenerationsSelect();
    };

    this.toggleGenerationBlock = function(elem) {
        var self = this,
            dataId = elem.data('id');
        if (self.realTime.carBlocked) return false;
        if (elem.hasClass('selected')) {
            $('.home-search-generation[data-id="'+dataId+'"]').removeClass('selected');
        }
        else {
            if (self.dom.generationsBlock.hasClass('max-exceeded')) return false;
            $('.home-search-generation[data-id="'+dataId+'"]').addClass('selected');
        }
        self.checkExceeded(self.dom.generationsBlock);
    };

    this.updateModelsSelect = function(){
        var self = this,
            selectedMarks = $('.search-group-select.home-search-mark.selected'),
            selectedMarkIds = [];
        $.each(selectedMarks, function(i,elem){
            selectedMarkIds.push($(elem).data('id'));
        });
        if (!selectedMarkIds.length) {
            if (self.dom.modelsBlock.is(':visible')) {
                self.dom.modelsBlock.slideUp(200, function(){
                    self.dom.modelsRow.html('');
                    self.updateGenerationsSelect();
                });
            }
            else {
                self.updateGenerationsSelect();
            }
            return true;
        }
        if (self.dom.modelsBlock.is(':visible')) self.dom.modelsBlock.addClass('loader-shown');
        else self.dom.marksBlock.addClass('loader-shown');
        self.realTime.carBlocked = true;
        var selectedModels = [];
        $.each($('.search-group-select.home-search-model.selected'), function(key, el){
            selectedModels.push($(el).data('id'));
        });
        self.sendAjax('getModels', {
            marks: selectedMarkIds
        }, false, function(e){
            self.dom.marksBlock.removeClass('loader-shown');
            self.dom.modelsBlock.removeClass('loader-shown');
            self.realTime.carBlocked = false;
            if(!e) {
                if (self.dom.modelsBlock.is(':visible')) {
                    self.dom.modelsBlock.slideUp(200, function(){
                        self.dom.modelsRow.html('');
                        self.updateGenerationsSelect();
                    });
                    return true;
                }
            }
            else {
                self.dom.modelsRow.html(e);
                if (selectedModels.length) {
                    $.each(selectedModels, function(i, id){
                        $('.home-search-model[data-id="'+id+'"]').addClass('selected');
                    });
                }
                self.checkExceeded(self.dom.modelsBlock);
                if (self.dom.modelsBlock.is(':hidden')) {
                    self.dom.modelsBlock.slideDown(200);
                }
            }
            self.updateGenerationsSelect();
        });
    };

    this.updateGenerationsSelect = function(){
        var self = this,
            selectedModels = $('.search-group-select.home-search-model.selected'),
            selectedModelIds = [];
        $.each(selectedModels, function(i,elem){
            selectedModelIds.push($(elem).data('id'));
        });
        if (!selectedModelIds.length) {
            if (self.dom.generationsBlock.is(':visible')) {
                self.dom.generationsBlock.slideUp(200, function(){
                    self.dom.generationsRow.html('');
                });
            }
            return true;
        }
        if (self.dom.generationsBlock.is(':visible')) self.dom.generationsBlock.addClass('loader-shown');
        else self.dom.modelsBlock.addClass('loader-shown');
        self.realTime.carBlocked = true;
        var selectedGenerations = [];
        $.each($('.search-group-select.home-search-generation.selected'), function(key, el){
            selectedGenerations.push($(el).data('id'));
        });
        self.sendAjax('getGenerations', {
            models: selectedModelIds
        }, false, function(e){
            self.dom.modelsBlock.removeClass('loader-shown');
            self.dom.generationsBlock.removeClass('loader-shown');
            self.realTime.carBlocked = false;
            if(!e) {
                if (self.dom.generationsBlock.is(':visible')) {
                    self.dom.generationsBlock.slideUp(200, function(){
                        self.dom.generationsRow.html('');
                    });
                    return true;
                }
            }
            else {
                self.dom.generationsRow.html(e);
                if (selectedGenerations.length) {
                    $.each(selectedGenerations, function(i, id){
                        $('.home-search-generation[data-id="'+id+'"]').addClass('selected');
                    });
                }
                self.checkExceeded(self.dom.generationsBlock);
                if (self.dom.generationsBlock.is(':hidden')) {
                    self.dom.generationsBlock.slideDown(200);
                    return true;
                }
            }
        });
    };

    this.checkDisabledBrands = function(id) {
        var self = this;
        self.dom.brandsBlock.addClass('loader-shown');
        self.realTime.brandBlocked = true;
        this.sendAjax('disabledBrands', {
            catalogueId: id
        }, true, function(e){
            self.dom.brandsBlock.removeClass('loader-shown');
            self.realTime.brandBlocked = false;
            if (e.items.length) {
                $.each(e.items, function(key, id) {
                    $('.home-search-brand[data-id="'+id+'"]').removeClass('selected').addClass('home-search-disabled');
                });
            }
            var append = $('.home-search-option.home-search-brand.home-search-disabled').length;
            if (append>0) {
                $.each($('.search-group-select.home-search-brand:not(.home-search-disabled)'), function(i,e){
                    var elem = $(e),
                        elemId = elem.attr('data-id');
                    if ($('.home-search-option.home-search-brand[data-id="'+elemId+'"]').length!==0) return true;
                    var domElement = $('<span class="home-search-option home-search-brand home-search-temp" data-id="'+elemId+'"></span>');
                    if (elem.hasClass('selected')) domElement.addClass('selected');
                    domElement.html(elem.html());
                    domElement.appendTo(self.dom.brandsBlockContent);
                    append--;
                    if (append === 0) return false;
                });
            }
            self.checkExceeded(self.dom.brandsBlock);
        });
    };

    this.checkDisabledCatalogs = function(){
        $('.home-search-catalogue.home-search-disabled').removeClass('home-search-disabled');
        $('.home-search-catalogue.home-search-temp').remove();
        var self = this,
            selectedBrands = $('.search-group-select.home-search-brand.selected'),
            ids = [];
        $.each(selectedBrands, function(key, elem){
            ids.push($(elem).data('id'));
        });
        if (ids.length) {
            self.realTime.brandBlocked = true;
            self.dom.catalogueBlock.addClass('loader-shown');
            self.sendAjax('disabledCatalogs', {
                ids: ids
            }, true, function(e){
                if (e.items.length) {
                    $.each(e.items, function(key, id){
                        $('.home-search-catalogue[data-id="'+id+'"]').removeClass('selected').addClass('home-search-disabled');
                    });
                }
                var append = $('.home-search-option.home-search-catalogue.home-search-disabled').length;
                if (append>0) {
                    $.each($('.search-group-select.home-search-catalogue:not(.home-search-disabled)'), function(i,e){
                        var elem = $(e),
                            elemId = elem.attr('data-id');
                        if ($('.home-search-option.home-search-catalogue[data-id="'+elemId+'"]').length!==0) return true;
                        var domElement = $('<span class="home-search-option home-search-catalogue home-search-temp" data-id="'+elemId+'"></span>');
                        if (elem.hasClass('selected')) domElement.addClass('selected');
                        domElement.html(elem.html());
                        domElement.appendTo(self.dom.catalogueBlockContent);
                        append--;
                        if (append === 0) return false;
                    });
                }
                self.realTime.brandBlocked = false;
                self.dom.catalogueBlock.removeClass('loader-shown');
            });
        }
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
                window.location.href = '';
            }
        });
    };

    this.clearSearch = function(){
        var self = this;
        $('.home-search-temp').remove();
        $('.home-search-catalogue.selected').removeClass('selected');
        if (self.dom.catalogueBlock.hasClass('expanded')) self.dom.catalogueBlock.find('.home-search-toggle').trigger('click');
        $('.home-search-brand.home-search-disabled').removeClass('home-search-disabled');
        $('.home-search-brand.selected').removeClass('selected');
        self.dom.brandsBlock.removeClass('max-exceeded');
        if (self.dom.brandsBlock.hasClass('expanded')) self.dom.brandsBlock.find('.home-search-toggle').trigger('click');
        $('.home-search-mark.selected').removeClass('selected');
        self.dom.marksBlock.removeClass('max-exceeded');
        if (self.dom.marksBlock.hasClass('expanded')) self.dom.marksBlock.find('.home-search-toggle').trigger('click');
        self.updateModelsSelect();
        self.dom.searchEngine.val('').trigger('change');
        self.realTime.carBlocked = false;
    };

    this.applySearch = function(){
        var query = {};
        var catalogue = $($('.search-group-select.home-search-catalogue.selected')[0]);
        if (catalogue.length) query.ca = catalogue.data('id');
        var brands = $('.search-group-select.home-search-brand.selected');
        if (brands.length) {
            var brandIds = [];
            $.each(brands, function(i, item){
                brandIds.push($(item).data('id'));
            });
            query.br = brandIds.join('-');
        }
        var marks = $('.search-group-select.home-search-mark.selected');
        if (marks.length) {
            var markIds = [];
            $.each(marks, function(i, item){
                markIds.push($(item).data('id'));
            });
            query.ma = markIds.join('-');
        }
        var models = $('.search-group-select.home-search-model.selected');
        if (models.length) {
            var modelIds = [];
            $.each(models, function(i, item){
                modelIds.push($(item).data('id'));
            });
            query.mo = modelIds.join('-');
        }
        var generations = $('.search-group-select.home-search-generation.selected');
        if (generations.length) {
            var generationIds = [];
            $.each(generations, function(i, item){
                generationIds.push($(item).data('id'));
            });
            query.ge = generationIds.join('-');
        }
        var engines = this.dom.searchEngine.val();
        if (engines.length) query.en=engines.join('-');
        if (!Object.keys(query).length) return false;
        var qs = $.param(query);
        window.location.href = this.urls.search+'?'+qs;
    };
    this.init();
};
new Search();
