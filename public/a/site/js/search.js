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
$('.home-search-single').on('click', function(){
    var self = $(this),
        dataType = self.data('type'),
        dataId = self.data('id');
    if (self.hasClass('selected')) {
        $('.home-search-single[data-type="'+dataType+'"]').removeClass('selected');
    }
    else {
        $('.home-search-single[data-type="'+dataType+'"]').removeClass('selected');
        $('.home-search-single[data-type="'+dataType+'"][data-id="'+dataId+'"]').addClass('selected');
    }
});
$('.home-search').on('click', '.home-search-car', function(){
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
                $('.home-search-car[data-type="'+dataType+'"]').removeClass('selected');
                self.addClass('selected');
            }
        }
});
var getData = function(item, callback){
    var searchBlock = item.parents('.home-search-block'),
        dataType = item.data('type');
    searchBlock.addClass('loader-shown');

    $('.home-search-car[data-type="'+dataType+'"]').removeClass('selected');
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
$('#home-search-engine').select2({
    minimumInputLength: 1,
});
$('#home-search-clear').on('click', function(){
    ajaxModels.html('');
    ajaxGenerations.html('');
    $('.home-search-multi.selected, .home-search-car.selected').removeClass('selected');
    $('#home-search-engine').val('').trigger('change');
});
$('#home-search-apply').on('click', function(){
    var parts = $('.search-group-select[data-type="product"].selected'),
        brands = $('.search-group-select[data-type="brand"].selected'),
        mark = $('.search-group-select[data-type="mark"].selected'),
        model = $('.search-group-select[data-type="model"].selected'),
        generation = $('.search-group-select[data-type="generation"].selected'),
        engine = $('#home-search-engine').val(),
        qs = '';
    if(parts.length>0) {
        qs+='?parts=';
        var thisIds = [];
        var i = 0;
        $.each(parts, function(i,e){
            i++;
            if (i>5) return false;
            thisIds.push($(e).data('id'));
        });
        qs+=thisIds.join(',');
    }
    console.log(qs);
});
