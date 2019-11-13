var numberInput = $('input.number-input');
if (numberInput.length) {
    var multiplication = parseInt(numberInput.data('multiplication')),
        minCount = parseInt(numberInput.attr('value')),
        price = parseFloat(numberInput.data('price')),
        available = parseInt(numberInput.data('available')),
        fullPrice = $('#full-price'),
        saleFrom = $('#sale-from');
    var stepNumberInput = function(input, positive){
            var val = Math.round(parseInt(input.val())/multiplication)*multiplication,
                newVal = false;
            if (positive) {
                if (val<available) newVal = val+multiplication;
            }
            else {
                if (val>minCount) newVal = val-multiplication;
            }
            if (newVal) {
                numberInput.val(newVal);
                updatePartFullPrice(newVal);
            }
        };
    $(document).on('click', '.number-input-plus', function(){
        var input = $(this).parent().find('>input.number-input');
        if (input.length) {
            stepNumberInput(input, true);
        }
    }).on('click', '.number-input-minus', function(){
        var input = $(this).parent().find('>input.number-input');
        if (input.length) {
            stepNumberInput(input, false);
        }
    });
}
if ($('#product-thumbs').length) {
    var productThumbs = new Swiper('#product-thumbs', {
        slidesPerView: 4,
    });
    new Swiper('#product-gallery', {
        effect: 'fade',
        thumbs: {
            swiper: productThumbs
        }
    });
}
var toBasket = $('#to-basket'),
    toBasketLoader = toBasket.next(),
    basketCounter = $('#basket-counter');
toBasket.on('click', function(){
    toBasket.removeClass('anim');
    toBasketLoader.show();
    var count = numberInput.val();
    $.ajax({
        url: window.basketUrl,
        type: 'post',
        dataType: 'json',
        data: {
            _token: window.csrf,
            part: window.partId,
            count: count,
        },
        success: function(e) {
            var maxCount = parseInt(e.max_count);
            available = maxCount;
            checkBasketCounter(window.partId);
            var newCsCount = csCount - count;
            if (newCsCount<0) newCsCount = 0;
            csCount = newCsCount;
            if (maxCount<multiplication) {
                $('.product-page-shop').remove();
            }
            else {
                minCount = multiplication;
                numberInput.val(multiplication).trigger('change');
                updatePartFullPrice(multiplication);
            }
            toBasketLoader.hide();
            toBasket.addClass('anim');
        },
        error: function(e) {
            // console.error(e.responseText);
            window.location.href = '';
        }
    });
});
var checkBasketCounter = function(partId) {
    partId = parseInt(partId);
    if (window.basketPartIds.indexOf(partId)===-1) {
        window.basketPartIds.push(partId);
        var length = window.basketPartIds.length;
        if (length>9) length='9+';
        basketCounter.html(length).show();
    }
};
var updatePartFullPrice = function(count) {
    saleFrom.hide();
    var newPrice;
    if (csPercent) {
        newPrice=parseFloat((count*price).toFixed(2));
        if (count>=csCount) {
            var newSalePrice = (count*price) * (1-csPercent/100);
            $('#part-sale-price').text(newPrice);
            saleFrom.show();
            fullPrice.text(newSalePrice);
        }
        else {
            fullPrice.text(newPrice);
        }
    }
};
if ($('.product-page-shop').length) {
    updatePartFullPrice(parseInt(numberInput.val()));
}
