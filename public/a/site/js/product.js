var checkNumberInput = function(input){
        var val = input.val();
        if (val) {
            var filteredVal = val.replace(/[^0-9]+/g, '').replace(/^0+/, ''),
                intVal = parseInt(filteredVal);
            if (intVal<1 || isNaN(intVal)) input.val(1);
            else if (intVal>9999) input.val(9999);
            else if (filteredVal!==val) input.val(filteredVal);
            else return false;
            return true;
        }
    },
    checkEmptyNumberInput = function(input){
        if (!input.val()) {
            input.val(1);
            return true;
        }
        return false;
    },
    stepNumberInput = function(input, positive){
        var val = parseInt(input.val());
        if (val < 1 || isNaN(val)) input.val(1).trigger('change');
        else if (positive) {
            if (val < 9999) input.val(val+1).trigger('change');
        }
        else {
            if (val > 1) input.val(val-1).trigger('change');
        }
    };
$(document).on('input', 'input.number-input', function(){
    checkNumberInput($(this));
}).on('blur', 'input.number-input', function(){
    checkEmptyNumberInput($(this));
}).on('keydown', 'input.number-input', function(e){
    if (e.keyCode === 38) {
        e.preventDefault();
        stepNumberInput($(this), true);
    }
    else if (e.keyCode === 40) {
        e.preventDefault();
        stepNumberInput($(this), false);
    }
}).on('click', '.number-input-plus', function(){
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
