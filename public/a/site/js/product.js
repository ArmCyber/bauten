(function(){var numberInput = $('input.this-number-input');
if (numberInput.length) {
    var multiplication = parseInt(numberInput.data('multiplication')),
        minCount = parseInt(numberInput.attr('value')),
        price = parseFloat(numberInput.data('price')),
        available = parseInt(numberInput.data('available')),
        fullPrice = $('#full-price'),
        allPrice = $('#all-price'),
        saleSumFrom = $('#sale-sum-from'),
        saleSumPrice = $('#sale-sum-price'),
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
    $(document).on('click', '.this-number-input-plus', function(){
        var input = $(this).parent().find('>input.this-number-input');
        if (input.length) {
            stepNumberInput(input, true);
        }
    }).on('click', '.this-number-input-minus', function(){
        var input = $(this).parent().find('>input.this-number-input');
        if (input.length) {
            stepNumberInput(input, false);
        }
    }).on('input', '.this-number-input', function(){
        var self = $(this);
        self.val(self.val().replace(/^0|[^0-9]+/g, ''));
    }).on('change', '.this-number-input', function(){
        var self = $(this),
            minimum = minCount,
            maximum = available,
            val = self.val(),
            value = val?parseInt(val):0;
        if (value < minimum) self.val(minimum);
        else if (value > maximum) self.val(maximum);
        else if (value%multiplication !== 0) {
            var x = Math.floor(value/multiplication);
            self.val(x*multiplication);
        }
        else return true;
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
        type: 'get',
        dataType: 'json',
        data: {
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
    newPrice=parseFloat((count*price).toFixed(2));
    if (csPercent && count>=csCount) {
        var newSalePrice = parseFloat(((count*price) * (1-csPercent/100)).toFixed(2));
        $('#part-sale-price').text(newPrice);
        saleFrom.show();
        fullPrice.text(newSalePrice);
        allPrice.text(newSalePrice);
        if (saleSumFrom.length) saleSumFrom.hide();
    }
    else {
        fullPrice.text(newPrice);
        if (saleSumFrom.length) {
            if (user_sale>0) {
                saleSumPrice.text(newPrice);
                saleSumFrom.show();
                var newSaleSum = parseFloat((count * price * (1-user_sale/100)).toFixed(2));
                allPrice.text(newSaleSum);
            }
            else {
                allPrice.text(newPrice);
                saleSumFrom.hide();
            }
        }
    }
};
if ($('.product-page-shop').length) {
    updatePartFullPrice(parseInt(numberInput.val()));
}
})();
