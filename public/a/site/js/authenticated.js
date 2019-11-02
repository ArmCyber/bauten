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
