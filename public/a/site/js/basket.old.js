var basketCounter = $('#basket-counter'),
    allPriceBlock = $('.all-price'),
    cities = $('#form-cities'),
    forDelivery = $('.for-delivery'),
    deliveryPriceBlock = $('.delivery-price'),
    fullPriceBlock = $('.full-price'),
    formDelivery = $('#form-delivery');
var parsePrice = function(value){
    return parseFloat(parseFloat(value).toFixed(2));
};
var updateAllPrice = function(value) {
    allPriceBlock.text(value);
    updateFullPrice();
};

var updateFullPrice = function(){
    var price_all = parseFloat($(allPriceBlock[0]).text()),
        price_delivery = parseFloat(deliveryPriceBlock.text()),
        price_full = parsePrice(price_all + price_delivery);
    fullPriceBlock.text(Math.ceil(price_full));
};

$('.delete-basket-item').on('click', function(){
    var self=$(this),
        thisId = parseInt(self.data('id')),
        thisPrice = parseFloat(self.data('price'));
    allPrice = parsePrice(allPrice - thisPrice);
    updateAllPrice(allPrice);
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
$('#form-region').on('change', function(){
    cities.html('');
    var id = $(this).val();
    var this_cities = regions.find(x => x.id==id);
    $.each(this_cities.cities, function(key, el){
        $('<option></option>').attr('value', el.id).text(el.title).appendTo(cities);
    });
    cities.trigger('change');
});
formDelivery.on('change', function(){
    if ($(this).val()==='1') forDelivery.show();
    else forDelivery.hide();
});
cities.on('change', function(){
    var self = $(this),
        selfId = parseInt(self.val()),
        deliveryPrice = deliveryPrices[selfId];
    deliveryPriceBlock.text(deliveryPrice);
    updateFullPrice();
});
