var numberInput = $('input.number-input');
if (numberInput.length) {
    var multiplication = parseInt(numberInput.data('multiplication')),
        minCount = parseInt(numberInput.attr('value')),
        price = parseFloat(numberInput.data('price')),
        available = parseInt(numberInput.data('available')),
        fullPrice = $('#full-price');
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
                fullPrice.text(parseFloat((newVal*price).toFixed(2)));
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
            if (maxCount<multiplication) {
                $('.product-page-shop').delete();
            }
            else {
                minCount = multiplication;
                numberInput.val(multiplication).trigger('change');
                fullPrice.text(parseFloat((multiplication*price).toFixed(2)));

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
