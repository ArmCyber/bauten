var cInputs = $('.c-inputs'),
    legalPerson = $('#legal-person-radio');
$('.reg-type-radio').on('change', function(){
    if (legalPerson.is(':checked')) cInputs.addClass('lp-checked');
    else cInputs.removeClass('lp-checked');
});
var regionSelect = $('.region-select');
regionSelect.select2();
$('.country-select').select2().on('change', function(){
    regionSelect.html('');
    $.each(regions[$(this).val()], function(key, item){
        $('<option></option>').attr('value',item.id).text(item.title).appendTo(regionSelect);
    });
    regionSelect.trigger('change');
});
