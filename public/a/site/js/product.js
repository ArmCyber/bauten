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
