var PartList = function(params){
    this.dom = {
        sortSelect: $('#sort-select'),
        listWrapper: $('#list-wrapper'),
        listContainer: $('#list-container'),
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
            self.getParts();
        });
        self.dom.listContainer.on('click', 'a.page-link', function(e){
            e.preventDefault();
            self.getParts(parseInt($(this).data('page')));
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
    };

    this.getParts = function(page){
        var self = this,
            filters = [];
        if (typeof page === 'undefined') page = 1;
        $.each($('.filter-checkbox:checked'), function(key, item){
            filters.push($(item).val());
        });
        self.realTime.page = page;
        var sort = self.dom.sortSelect.val(),
            qsParams = {
                sort: sort,
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
        // window.location.href = '';
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
