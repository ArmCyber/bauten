var basketCounter = $('#basket-counter');
$('.delete-basket-item').on('click', function(){
    var self=$(this),
        thisId = parseInt(self.data('id')),
        thisPrice = parseFloat(self.data('price'));
    allPrice = parseFloat((allPrice - thisPrice).toFixed(2));
    $('#all-price').text(allPrice);
    var index = basketPartIds.indexOf(thisId);
    if (index!==-1) {
        basketPartIds.splice(index, 1);
        var len = basketPartIds.length;
        $('#sidebar-basket').html(len);
        if (len<10) {
            $('#basket-counter').html(len);
            if (len===0) {
                basketCounter.hide();
                $('.basket-table').remove();
            }
        }
    }
    $.ajax({
        url: deleteItemUrl,
        type: 'post',
        data: {
            _token: csrf,
            item_id: thisId,
        },
        error: function(){
            window.location.href = '';
        }
    });
    $(this).parents('tr').remove();
});
