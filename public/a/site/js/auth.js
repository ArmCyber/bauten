$('.action-logout').on('click', function(){
    $('<form action="/logout" method="post"></form>').appendTo('body').submit();
});
