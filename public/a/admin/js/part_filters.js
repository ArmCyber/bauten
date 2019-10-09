window.selectedFilters = [];
var filtersSelect = $('.filters-select2'),
    exampleFilterBlock = $('.filter-block-example'),
    filterBlocks = $('#filter-blocks');
var appendFilter = function(filterId) {
    filterId = parseInt(filterId);
    var filter = window.filters[filterId];
    if (!filter) {
        alert('Возникла проблема.');
        return false;
    }
    var clone = exampleFilterBlock.clone();
    clone.removeClass('filter-block-example').addClass('filter-block').attr('data-id', filterId).show();
    clone.find('.filter-title').text(filter.title);
    var filterSelect = clone.find('.criteria-select');
    selectedFilters.push(filterId);
    var criteria = filter.criteria||[];
    $.each(criteria, function(key, criterion){
        $('<option value="'+criterion.id+'"></option>').text(criterion.title).appendTo(filterSelect);
    });
    filterSelect.select2();
    clone.appendTo(filterBlocks);
};
var removeFilter = function(filterId) {
    filterId = parseInt(filterId);
    var filterBlock = $('.filter-block[data-id="'+filterId+'"]');
    filterBlock.find('.criteria-select').select2('destroy');
    filterBlock.remove();
    var index = selectedFilters.indexOf(filterId);
    if (index!==-1) selectedFilters.splice(index, 1);
};
filtersSelect.on('change', function(){
    var filters = $(this).val(),
        selectedFiltersClone = window.selectedFilters.slice(0);
    $.each(selectedFiltersClone, function(key, selectedFilter){
        if (filters.indexOf(selectedFilter.toString())===-1) {
            removeFilter(selectedFilter);
        }
    });
    $.each(filters, function(key, filter){
        if (selectedFilters.indexOf(parseInt(filter))===-1) {
            appendFilter(filter);
        }
    });
});
filtersSelect.select2({
    'placeholder': 'Привязанные фильтры'
});
var itemFilterKeys = Object.keys(itemFilters);
if (itemFilterKeys.length) {
    filtersSelect.val(itemFilterKeys).trigger('change');
    setTimeout(function(){
        $.each(itemFilters, function(key, item){
            $('.filter-block[data-id='+key+'] .criteria-select').val(item).trigger('change')
        });
    }, 0);
}
