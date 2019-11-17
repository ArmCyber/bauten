var Search = function(){
    this.dom = {
        searchCatalogue: $('.home-search-catalogue'),
    };

    this.init = function(){
        this.addEventListeners();
    };

    this.addEventListeners = function(){
        var self = this;
        $('.home-search-toggle').on('click', function(){
            self.toggleExpand($(this));
        });
        $('.home-search-catalogue').on('click', function(){
            self.toggleCatalogueSelect($(this));
        });
    };

    this.toggleCatalogueSelect = function(elem){
        var self = $(this),
            block = elem.parents('.home-search-block');
        if (elem.hasClass('selected')) {
            //unselect
        } else {
            $('.home-search-catalogue.selected').removeClass('selected');
            var id = elem.data('id');

        }
    };

    this.toggleExpand = function(btn) {
        var self = this,
            block = btn.parents('.home-search-block');
        if (block.hasClass('expanded')) {
            block.removeClass('expanded').find('.home-search-expanded').slideUp(200);
        }
        else {
            block.addClass('expanded').find('.home-search-expanded').slideDown(200);
        }
    };

    this.init();
};
var a = new Search();
