document.addEventListener(
    "DOMContentLoaded", () => {
        const node = document.querySelector("#cabinet-menu-mobile");
        const menu = new MmenuLight(node, {
            title: $(node).data('name')
        });

        menu.enable( "(max-width: 1199px)" );
        menu.offcanvas({
            position:'right',
        });

        document.querySelector( '#cabinet-menu-toggle' )
            .addEventListener( 'click', ( evnt ) => {
                menu.open();
                evnt.preventDefault();
                evnt.stopPropagation();
            });
    });
(function(){
    var basketCounter = $('#basket-counter');

    $('.action-logout').on('click', function(){
        $('<form action="/logout" method="post"></form>').appendTo('body').submit();
    });

    $(document).on('click', '.product-favourite', function(){
        var self = $(this);
        if (self.data('blocked') === true) return false;
        self.data('blocked', true);
        var id = self.data('id');
        $.ajax({
            url: '/cabinet/favourites/add',
            type: 'post',
            data: {
                itemId: id,
                action: self.hasClass('saved')?'delete':'add'
            },
            error: function(){
                self.toggleClass('saved');
                self.data('blocked', false);
            },
            success: function(){
                self.data('blocked', false);
            }
        });
        self.toggleClass('saved');
    });
    var blocked = false;
    $('#live-search').on('input', function(){
        var el = $(this),
            results = $('.header-search-results'),
            value = $.trim(el.val());
        results.hide();
        if (value.length>=3) $.ajax({
            url: '/search-sm/live',
            type: 'get',
            data: {
                q: value,
            },
            success: function(e){
                if (e && !blocked) {
                    results.html(e).show();
                }
                else results.hide();
            }
        });
    }).on('focus', function(){
        blocked = false;
    }).on('blur', function(){
        blocked = true;
        setTimeout(function(){
            $('.header-search-results').hide();
        }, 100);
    });
    $('.header-search-form').on('submit', function(e){
        if (!$.trim($(this).find('input').val())) e.preventDefault();
    });
    $(document).on('input', '.live-basket-input', function(){
        var self = $(this);
        self.val(self.val().replace(/^0|[^0-9]+/g, ''));
    }).on('change', '.live-basket-input', function(){
        var self = $(this),
            minimum = parseInt(self.attr('data-minimum')),
            maximum = parseInt(self.attr('data-available')),
            multiplication = parseInt(self.attr('data-multiplication')),
            value = self.val();
        value = value?parseInt(value):0;
        if (value < minimum) self.val(minimum);
        else if (value > maximum) self.val(maximum);
        else if (value%multiplication !== 0) {
            var x = Math.floor(value/multiplication);
            self.val(x*multiplication);
        }
        else return true;
    }).on('click', '.live-num-plus', function(){
        stepNumberInput($(this).siblings('.live-basket-input'),true)
    }).on('click', '.live-num-minus', function(){
        stepNumberInput($(this).siblings('.live-basket-input'),false)
    }).on('keydown', '.live-basket-input', function(e){
        if (e.keyCode === 38) {
            e.preventDefault();
            stepNumberInput($(this), true);
        }
        else if (e.keyCode === 40) {
            e.preventDefault();
            stepNumberInput($(this), false);
        }
    }).on('click', '.live-to-basket', function(){
        var $this = $(this);
        setTimeout(function(){
            var section = $this.parents('.to-basket-section'),
                group = section.find('.live-basket-group'),
                input = group.find('.live-basket-input'),
                value = input.val(),
                partId = parseInt(input.data('id')),
                multiplication = parseInt(input.attr('data-multiplication'));
            if (group.hasClass('loader-shown')) return false;
            group.addClass('loader-shown');
            group.removeClass('anim');
            if (!value || isNaN(value)) renderError();
            value = parseInt(value);
            $.ajax({
                url: '/cabinet/basket/add',
                type: 'get',
                dataType: 'json',
                data: {
                    part: partId,
                    count: value,
                },
                success: function(e) {
                    var maxCount = parseInt(e.max_count);
                    checkBasketCounter(partId);
                    if (maxCount<multiplication) {
                        $('.live-basket-input[data-id="'+partId+'"]').parents('.to-basket-section').html('');
                    }
                    else {
                        input.attr('data-minimum', multiplication);
                        input.attr('data-available', e.max_count);
                        input.val(multiplication).trigger('change');
                    }
                    group.removeClass('loader-shown');
                    group.addClass('anim')
                },
                error: function(e) {
                    renderError()
                }
            });
        },0);
    });
    var renderError = function(){
        window.location.href = '';
    };
    var stepNumberInput = function(input, positive){
        var val = input.val(),
            multiplication = parseInt(input.attr('data-multiplication'));
        val = isNaN(val)?0:parseInt(input.val());
        if (positive) val+=multiplication;
        else val-=multiplication;
        input.val(val).trigger('change');
    };
    var checkBasketCounter = function(partId) {
        partId = parseInt(partId);
        if (window.basketPartIds.indexOf(partId)===-1) {
            window.basketPartIds.push(partId);
            var length = window.basketPartIds.length;
            if (length>9) length='9+';
            basketCounter.html(length).show();
        }
    };
})();
