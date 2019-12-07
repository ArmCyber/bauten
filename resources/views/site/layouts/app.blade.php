<!doctype html><html lang="ru"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $seo['title']??null }}</title>
    @if(!empty($seo['keywords'])) <meta name="keywords" content="{{ $seo['keywords'] }}"> @endif
    @if(!empty($seo['description'])) <meta name="description" content="{{ $seo['description'] }}"> @endif
    <link rel="shortcut icon" href="{!! asset('favicon.ico') !!}" type="image/x-icon">
    @css(aApp('bootstrap/css/bootstrap.css'))
    @css(aApp('font-awesome/css/all.css'))
    @css(aSite('assets/mmenu-light/mmenu-light.css'))
    @css(aSite('css/app.css'))
    @empty($skip_inner_css)
        @css(aSite('css/inner.css'))
    @endempty
    @auth
        @css(aSite('css/authenticated.css'))
    @endauth
    @stack('css')
</head><body>
    <div id="page" class="page">
        <header id="header">
            <div id="header-top">
                <div class="container ht-container">
                    <div class="ht-sm">
                        <a href="{{ route('page') }}" class="ht-brand"><img src="{{ $info->data->logo() }}" alt="Bauten"></a>
                    </div>
                    <div class="ht-lg">
                        @isset($requisites['phone'][0])
                        <a href="tel:{{ $requisites['phone'][0] }}" class="ht-tel">{{ $requisites['phone'][0] }}</a>
                        @endisset
                    </div>
                    <div class="ht-sm text-right">
                        <div class="ht-auth">
                            @auth
                                <a href="{{ route('cabinet.main') }}" class="ht-login">{{ $user->name }}</a>
                                <a href="javascript:void(0)" class="ht-login-right action-logout">выйти</a>
                            @else
                                <a href="{{ route('login') }}" class="ht-login login">Вход</a>
                                <a href="{{ route('register') }}" class="ht-login-right">Регистрация</a>
                            @endauth
                        </div>
                        <div class="ht-hamburger" id="menu-toggle">
                            <button class="hamburger">
                                <span class="ic-hamburger"><span></span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="header-menu">
                <div class="container header-menu-container">
                    <nav id="menu">
                        @foreach($menu as $menu_item)
                            @if ($menu_item->static=='catalogs')
                                <div class="menu-item has-fluid-dropdown{{ ($active_page??null)==$menu_item->id?' active':'' }}">
                                    <a href="javascript:void(0)">{{ $menu_item->title }}</a>
                                    <div class="fluid-dropdown" style="display: none">
                                        <div class="fluid-dropdown-content">
                                            <div class="menu-catalog-blocks">
                                                @foreach($groups as $group)
                                                    <div class="menu-catalog-block">
                                                        <div class="menu-catalog-letter"><a href="{{ $url = route('group', ['url'=>$group->url]) }}">{{ $group->name }}</a></div>
                                                        <div class="menu-catalog-links">
                                                            @push('menu_mobile_catalogs')
                                                                <li class="font-weight-bold"><a href="{{ $url }}">{{ $group->name }}</a></li>
                                                            @endpush
                                                            @foreach($group->catalogs as $catalog_item)
                                                                <div class="menu-catalog-link"><a href="{{ $url = route('catalogue', ['url'=>$catalog_item->url]) }}">{{ $catalog_item->name }}</a></div>
                                                                @push('menu_mobile_catalogs')
                                                                    <li><a href="{{ $url }}">{{ $catalog_item->name }}</a></li>
                                                                @endpush
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @push('menu_mobile')
                                    <li>
                                        <span>{{ $menu_item->title }}</span>
                                        <ul>
                                            @stack('menu_mobile_catalogs')
                                        </ul>
                                    </li>
                                @endpush
                            @else
                                <div class="menu-item{{ ($active_page??null)==$menu_item->id?' active':'' }}"><a href="{{ $url = route('page', ['url'=>$menu_item->url]) }}">{{ $menu_item->title }}</a></div>
                                @push('menu_mobile')
                                    <li><a href="{{ $url }}">{{ $menu_item->title }}</a></li>
                                @endpush
                                @push('footer_links')
                                    <div class="footer-link"><a href="{{ $url }}">{{ $menu_item->title }}</a></div>
                                @endpush
                            @endif
                        @endforeach
                    </nav>
                    @auth
                        <div class="header-menu-search">
                            <form action="{{ route('search_sm') }}" class="header-search-form" method="get" autocomplete="off">
                                <input id="live-search" class="header-search-input ui search" type="text" name="q" placeholder="Поиск" value="{{ $search_val??null }}">
                                <button class="header-search-btn"><i class="fas fa-search"></i></button>
                            </form>
                            <div class="header-search-results" style="display:none"></div>
                        </div>
                        <div class="header-menu-buttons">
                            <a href="{{ route('cabinet.basket') }}" class="header-menu-button"><i class="fas fa-shopping-basket"></i><span id="basket-counter" @if(($basket_parts_count = count($basket_part_ids))==0)style="display: none"@endif>{{ $basket_parts_count>9?'9+':$basket_parts_count }}</span></a>
                        </div>
                    @endauth
                </div>
                <nav id="menu-mobile"><ul>@stack('menu_mobile')</ul></nav>
            </div>
        </header>
        <main id="main" @isset($main_class) class="{{ $main_class }}" @endif>@yield('main')</main>
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <div class="footer-main">
                            <div>
                                <img class="footer-logo" src="{{ $info->data->logo_footer() }}" alt="Bauten">
                            </div>
                            <div class="footer-contacts">
                                @foreach($requisites['address']??[] as $address)
                                    <div>{{ $address }}</div>
                                @endforeach
                                @foreach($requisites['phone']??[] as $phone)
                                    <div><a href="tel:{{ $phone }}">{{ $phone }}</a></div>
                                @endforeach
                            </div>
                            <div class="footer-socs">
                                @foreach($info->socials as $social)
                                    @if (!$social->active || !$social->url) @continue @endif
                                    <a href="{{ url($social->url) }}" class="footer-soc" target="_blank">@if($social->icon)<img src="{{ $social->icon() }}" alt="{{ $social->title }}">@endif<span>{{ $social->title }}</span></a>
                                @endforeach
                            </div>
                            <div class="footer-payments">
                                @foreach($info->payment_logos as $payment_logo)
                                    @if(!$payment_logo->active || !$payment_logo->logo) @continue @endif
                                    <img src="{{ $payment_logo->logo() }}" alt="{{ $payment_logo->alt }}" title="{{ $payment_logo->title() }}">
                                @endforeach
                            </div>
                            <div class="footer-copy d-none d-lg-block">
                                <p>© ТОО "Bauten" 2006-{!! now()->year !!} Все права защищены.</p>
{{--                                <p><a href="https://studionomad.kz" target="_blank">Дизайн и разработка сайта</a> от STUDIONOMAD</p>--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 footer-lists">
                        <div class="footer-list">@stack('footer_links')</div>
                        <div class="footer-list">
                            @foreach($home_catalogs as $catalog)
                                <div class="footer-link"><a href="{{ route('catalogue', ['url'=>$catalog->url]) }}">{{ $catalog->name }}</a></div>
                            @endforeach
                        </div>
                        <div class="footer-list">
                            @foreach($footer_pages as $footer_page)
                                <div class="footer-link"><a href="{{ route('page', ['url'=>$footer_page->url]) }}">{{ $footer_page->title }}</a></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 d-lg-none">
                        <div class="footer-copy text-center">
                            <p>© ТОО "Bauten" 2006-{!! now()->year !!} Все права защищены.</p>
{{--                            <p><a href="https://studionomad.kz" target="_blank">Дизайн и разработка сайта</a> от STUDIONOMAD</p>--}}
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @js(aApp('jquery/jquery.js'))
    @js(aSite('assets/mmenu-light/mmenu-light.js'))
    @js(aSite('js/base.js'))
    @auth
        <script>
            window.basketPartIds = {!! $basket_part_ids->toJson() !!};
        </script>
        @js(aSite('js/authenticated.js'))
    @endauth
    @stack('js')
</body></html>
