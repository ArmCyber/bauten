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
            if (self.hasClass('selected')) self.removeClass('selected');
            else getData(self, function(e){
                ajaxModels.html(e);
                ajaxModels.children().slideDown(200);
            });
        }
        else if (dataType==='model') {
            ajaxGenerations.html('');
            if (self.hasClass('selected')) self.removeClass('selected');
            else getData(self, function(e){
                ajaxGenerations.html(e);
                ajaxGenerations.children().slideDown(200);
            });
        }
        else if (dataType==='generation') {
            if (self.hasClass('selected')) self.removeClass('selected');
            else {
                $('.home-search-single[data-type="'+dataType+'"]').removeClass('selected');
                self.addClass('selected');
            }
        }
});
var getData = function(item, callback){
    var searchBlock = item.parents('.home-search-block'),
        dataType = item.data('type');
    searchBlock.addClass('loader-shown');

    $('.home-search-single[data-type="'+dataType+'"]').removeClass('selected');
    $.ajax({
        url: window.ajaxUrl,
        type: 'get',
        data: {
            'type': dataType,
            'key': item.data('id'),
        },
        success: function(e){
            if (e) callback(e);
            item.addClass('selected');
            searchBlock.removeClass('loader-shown');
        },
        error: function(e) {
            window.location.href='';
        }
    });
};
$('#home-search-clear').on('click', function(){
    ajaxModels.html('');
    ajaxGenerations.html('');
    $('.home-search-multi.selected, .home-search-single.selected').removeClass('selected');
});

