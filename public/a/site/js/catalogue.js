$('.filter-name').on('click', function(){
    var filter = $(this).parent();
    if (filter.hasClass('filter-expanded')) filter.removeClass('filter-expanded');
    else {
        $('.products-filter.filter-expanded').removeClass('filter-expanded');
        filter.addClass('filter-expanded');
    }
});
