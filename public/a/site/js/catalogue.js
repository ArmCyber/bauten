$('.criterion-checkbox:checked').parents('.products-filter').addClass('filter-expanded');
$('.filter-name').on('click', function(){
    var filter = $(this).parent();
    if (filter.hasClass('filter-expanded')) filter.removeClass('filter-expanded');
    else {
        // $('.products-filter.filter-expanded').removeClass('filter-expanded');
        filter.addClass('filter-expanded');
    }
});
$('#sort-select').styler();
// $('#sort-type-select').styler();
var blocked = false;
$('#filter-form').on('submit', function(e){
    if (blocked) {
        e.preventDefault();
        return false;
    } else blocked = true;
    var self = $(this),
        criterionCheckboxes = $('.criterion-checkbox:checked');
    if (criterionCheckboxes.length) {
        var criteria = '';
        $.each(criterionCheckboxes, function(i,e){
            if (criteria) criteria+='_';
            criteria+=$(e).val();
        });
        $('<input name="filters" type="hidden">').val(criteria).prependTo(self);
    }
    self.prop('action', window.filtersUrl);
    self.submit();
});
