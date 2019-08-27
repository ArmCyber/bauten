var cInputs = $('.c-inputs'),
    legalPerson = $('#legal-person-radio');
$('.reg-type-radio').on('change', function(){
    if (legalPerson.is(':checked')) cInputs.addClass('lp-checked');
    else cInputs.removeClass('lp-checked');
});
