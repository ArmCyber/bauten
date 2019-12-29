var PartList = function(params){
    this.dom = {
        sortSelect: $('#sort-select'),
        listWrapper: $('#list-wrapper'),
        listContainer: $('#list-container'),
        cSort: $('#c_sort'),
        cSortType: $('#c_sort_type'),
        filtersContainer: $('.products-filters'),
        mobileFiltersToggle: $('#mobile-filters-toggle'),
        viewToggle: {
            list: $('#view-list'),
            grid: $('#view-grid')
        }
    };

    this.realTime = {
        ajax: false,
        page: 1,
    };

    this.params = params;

    this.init = function(){
        this.initPlugins();
        this.addEventListeners();
        this.getParts(this.params.page);
    };

    this.initPlugins = function(){
        this.dom.sortSelect.styler();
        this.dom.viewToggle[this.params.viewType].addClass('active');
    };

    this.addEventListeners = function(){
        var self = this;
        $('.criterion-checkbox:checked').parents('.products-filter').addClass('filter-expanded');
        $('.filter-name').on('click', function(){
            var filter = $(this).parent();
            if (filter.hasClass('filter-expanded')) filter.removeClass('filter-expanded');
            else {
                // $('.products-filter.filter-expanded').removeClass('filter-expanded');
                filter.addClass('filter-expanded');
            }
        });
        $('.filter-checkbox').on('change', function(){
            self.getParts();
        });
        self.dom.sortSelect.on('change', function(){
            self.dom.sortSelect.find('option[value="other"]').remove();
            self.dom.sortSelect.trigger('refresh');
            $('.sort_asc').removeClass('sort_asc');
            $('.sort_desc').removeClass('sort_desc');
            self.getParts();
        });
        self.dom.listContainer.on('click', 'a.page-link', function(e){
            e.preventDefault();
            self.getParts(parseInt($(this).data('page')));
        }).on('click', '.c-sorting', function(){
            if (self.dom.sortSelect.val()!=='other') {
                if (self.dom.sortSelect.find('option[value="other"]').length===0)self.dom.sortSelect.append('<option value="other">Другое</option>');
                self.dom.sortSelect.val('other').trigger('refresh');
            }
            var $this = $(this);
            self.dom.cSort.val($this.attr('data-sort'));
            self.dom.cSortType.val($this.hasClass('sort_asc')?'desc':'asc');
            self.getParts();
        });
        self.dom.viewToggle.list.on('click', function(){
            self.dom.viewToggle.grid.removeClass('active');
            self.dom.viewToggle.list.addClass('active');
            self.params.viewType = 'list';
            self.getParts(self.realTime.page);
        });
        self.dom.viewToggle.grid.on('click', function(){
            self.dom.viewToggle.grid.addClass('active');
            self.dom.viewToggle.list.removeClass('active');
            self.params.viewType = 'grid';
            self.getParts(self.realTime.page);
        });
        self.dom.mobileFiltersToggle.on('click', function(){
            self.dom.filtersContainer.animate({left: 0}, 300);
            $('body').css('overflow', 'hidden');
        });
        $('#close-filters').on('click', function(){
            self.dom.filtersContainer.animate({left: '-100%'}, 300);
            $('body').css('overflow', '');
        });
    };

    this.getParts = function(page){
        var self = this,
            filters = [];
        if (typeof page === 'undefined' || page===false) page = 1;
        $.each($('.filter-checkbox:checked'), function(key, item){
            filters.push($(item).val());
        });
        self.realTime.page = page;
        var sort = self.dom.sortSelect.val(),
            sort_type = 'asc';
        if (sort === 'other') {
            sort = self.dom.cSort.val();
            sort_type = self.dom.cSortType.val();
        }
        var qsParams = {
                sort: sort,
                sort_type: sort_type,
                page: page,
                view_type: self.params.viewType,
            };
        if (filters.length) qsParams.filters = filters.join('_');
        var qs = $.param(qsParams);
        history.replaceState(null, null, self.params.realUrl+(self.params.realUrl.indexOf('?')===-1?'?':'&')+qs);
        self.dom.listWrapper.addClass('loader-shown');
        self.sendAjax(self.params.url, qsParams, function(e){
            self.dom.listContainer.html(e);
            self.dom.listWrapper.removeClass('loader-shown');
        });
    };

    this.renderError = function(){
        window.location.href = '';
    };

    this.sendAjax = function(url, data, callback){
        var self=this;
        if (self.realTime.ajax) {
            self.realTime.ajax.abort();
            self.realTime.ajax = false;
        }
        self.dom.listContainer.html('');
        data._ = new Date().getTime();
        self.realTime.ajax = $.ajax({
            url: url,
            type: 'get',
            data: data,
            success: function(e){
                self.realTime.ajax = false;
                if (typeof callback === 'function') callback(e);
            },
            error: function(e){
                if (e.statusText!=='abort') self.renderError();
            }
        });
    };

    this.init();
};
