<!DOCTYPE html>
<html dir="ltr" lang="{!! app()->getLocale() !!}"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <link href="{!! aAdmin('img/favicon.ico') !!}" rel="shortcut icon" type="image/x-icon">
    <title>@yield('title', $title??null) - {!! config('admin.author') !!}</title>
    @css(aApp('jquery-ui/jquery-ui.css'))
    @css(aApp('font-awesome/css/all.css'))
    @css(aApp('themify-icons/themify-icons.css'))
    @css(aApp('material-design-iconic-font/css/materialdesignicons.min.css'))
    @css(aAdmin('dist/css/init.css'))
    @css(aApp('labelauty/labelauty.css'))
    @css(aApp('toastr/build/toastr.min.css'))
    @css(aAdmin('css/main.css'))
    @stack('css')
</head><body>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper">
    <header class="topbar" data-navbarbg="skin5">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <div class="navbar-header" data-logobg="skin5">
                <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                <a class="navbar-brand justify-content-center" href="{!! route(config('admin.homepage')) !!}">
                    <b class="logo-icon p-l-10">
                        <img src="{!! aAdmin('img/author-logo.png') !!}" alt="homepage" class="light-logo" />
                    </b>
                </a>
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
            </div>
            <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                <ul class="navbar-nav float-left mr-auto">
                    <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                </ul>
                <ul class="navbar-nav float-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{!! aAdmin('img/avatar.jpg') !!}" alt="user" class="rounded-circle" style="width:50px; height:50px;"></a>
                        <div class="dropdown-menu dropdown-menu-right user-dd animated p-b-0">
                            <a class="dropdown-item" href="{!! route('admin.profile.main') !!}"><i class="fas fa-cog m-r-5 m-l-5"></i> Настройки профиля</a>
                            <a class="dropdown-item" href="{!! route('page') !!}" target="_blank"><i class="fa fa-home m-r-5 m-l-5"></i> Посмотреть сайт</a>
                            <a class="dropdown-item" href="javascript:void(0)" id="logout-user" data-action="{!! route('admin.logout') !!}"><i class="fa fa-power-off m-r-5 m-l-5"></i> Выйти</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="left-sidebar" data-sidebarbg="skin5">
        <div class="scroll-sidebar">
            <nav class="sidebar-nav">
                <ul id="sidebarnav" class="p-t-10">@include('admin.includes.sidebar')</ul>
            </nav>
        </div>
    </aside>
    <div class="page-wrapper">
        <div class="page-breadcrumb">
            <div class="clearfix">
                <div class="page-breadcrumb-title">
                    <h4 class="page-title">@yield('title', $title??null) @yield('titleSuffix')</h4>
                    @if(!empty($back_url))
                        <div class="page-title-back"><a class="text-cyan" href="{{$back_url}}"><i class="fas fa-long-arrow-alt-left"></i> Назад</a></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>
<script>
    var dir = '{!! url(config('admin.prefix')) !!}',
        csrf = '{!! csrf_token() !!}';
</script>
@js(aApp('jquery/jquery.js'))
@js(aApp('jquery-ui/jquery-ui.js'))
@js(aApp('popper.js/popper.js'))
@js(aApp('bootstrap/js/bootstrap.js'))
@js(aApp('perfect-scrollbar/perfect-scrollbar.jquery.min.js'))
@js(aApp('jquery.sparkline/sparkline.js'))
@js(aAdmin('dist/js/waves.js'))
@js(aAdmin('dist/js/sidebarmenu.js'))
@js(aAdmin('dist/js/custom.js'))
@js(aApp('labelauty/labelauty.js'))
@js(aApp('z-select/z-select.js'))
@js(aApp('toastr/build/toastr.min.js'))
{!! Notify::render() !!}
@js(aAdmin('js/app.js'))
@stack('js')
</body></html>