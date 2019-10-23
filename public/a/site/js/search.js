var hideExpanded = function(searchBlock){
        searchBlock.removeClass('expanded').find('.home-search-expanded').slideUp(200);
    },
    showExpanded = function(searchBlock) {
        searchBlock.addClass('expanded').find('.home-search-expanded').slideDown(200);
    },
    maxTakeModal = $('#maxTakeModal'),
    ajaxModels = $('#home-ajax-models'),
    ajaxGenerations = $('#home-ajax-generations');
$('.home-search-toggle').on('click', function(){
    var searchBlock = $(this).parents('.home-search-block');
    if (searchBlock.hasClass('expanded')) hideExpanded(searchBlock);
    else showExpanded(searchBlock);
});
$('.home-search-multi').on('click', function(){
    var self = $(this),
        dataType = self.data('type'),
        dataId = self.data('id'),
        selector = $('.home-search-multi[data-type="'+dataType+'"][data-id="'+dataId+'"]');
    if (self.hasClass('selected')) selector.removeClass('selected');
    else {
        if ($('.search-group-select[data-type="'+dataType+'"].selected').length>=5) maxTakeModal.modal('show');
        else selector.addClass('selected');
    }
});
$('.home-search').on('click', '.home-search-single', function(){
        var self = $(this),
            dataType = self.data('type');
        if (dataType==='mark') {
            ajaxModels.html('');
            ajaxGenerations.html('');
            getData({

            }, self);
        }
});
var getData = function(options, item){
    var searchBlock = item.parents('.home-search-block');
    searchBlock.addClass('loader-shown');
};
