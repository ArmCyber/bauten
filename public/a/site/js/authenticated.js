$('.action-logout').on('click', function(){
    $('<form action="/logout" method="post"></form>').appendTo('body').submit();
});
$('.product-favourite').on('click', function(){
    var self = $(this);
    if (self.data('blocked') === true) return false;
    self.data('blocked', true);
    var id = self.data('id');
    $.ajax({
        url: '/cabinet/favourites/add',
        type: 'post',
        data: {
            itemId: id,
            action: self.hasClass('saved')?'delete':'add'
        },
        error: function(){
            self.toggleClass('saved');
            self.data('blocked', false);
        },
        success: function(){
            self.data('blocked', false);
        }
    });
    self.toggleClass('saved');
});
var blocked = false;
$('#live-search').on('input', function(){
    var el = $(this),
        results = $('.header-search-results'),
        value = $.trim(el.val());
    results.hide();
    if (value.length>=3) $.ajax({
        url: '/search-sm/live',
        type: 'get',
        data: {
            q: value,
        },
        success: function(e){
            if (e && !blocked) {
                results.html(e).show();
            }
            else results.hide();
        }
    });
}).on('focus', function(){
    blocked = false;
}).on('blur', function(){
    blocked = true;
    setTimeout(function(){
        $('.header-search-results').hide();
    }, 100);
});
$('.header-search-form').on('submit', function(e){
    if (!$.trim($('#live-search').val())) e.preventDefault();
});
