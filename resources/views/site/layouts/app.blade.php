<!doctype html><html lang="ru"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bauten</title>
    <link rel="shortcut icon" href="{!! asset('favicon.ico') !!}">
    @css(aApp('bootstrap/css/bootstrap.css'))
    @css(aApp('font-awesome/css/all.css'))
    @css(aSite('css/app.css'))
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
                            <a href="/register" class="ht-login">Регистрация</a>
                        </div>
                        <div class="ht-hamburger">
                            <button class="hamburger">
                                <span class="ic-hamburger"><span></span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="header-menu">
                <nav id="menu" class="container">
                    <div class="menu-item has-fluid-dropdown active">
                        <a href="javascript:void(0)">Каталог</a>
                        <div class="fluid-dropdown">
                            <div class="fluid-dropdown-content">
                                <div class="menu-catalog-blocks">
                                    @foreach($catalogs as $key=>$catalog)
                                        <div class="menu-catalog-block">
                                            <div class="menu-catalog-letter">{{ $key }}</div>
                                            <div class="menu-catalog-links">
                                                @foreach($catalog as $catalog_item)
                                                    <div class="menu-catalog-link"><a href="{{ route('catalogue', ['url'=>$catalog_item->url]) }}">{{ $catalog_item->name }}</a></div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{--<div class="menu-dropdown">
                            <div class="menu-dropdown-content">
                                <a href="javascript:void(0)" class="menu-dropdown-link active">Аксессуары</a>
                                <a href="javascript:void(0)" class="menu-dropdown-link">Шины и диски</a>
                                <a href="javascript:void(0)" class="menu-dropdown-link">Масла</a>
                                <a href="javascript:void(0)" class="menu-dropdown-link">Автостекла</a>
                                <a href="javascript:void(0)" class="menu-dropdown-link">Аккумуляторы</a>
                                <a href="javascript:void(0)" class="menu-dropdown-link">Patron</a>
                            </div>
                        </div>--}}
                    </div>
                    <div class="menu-item"><a href="javascript:void(0)">Интернет магазин</a></div>
                    <div class="menu-item"><a href="javascript:void(0)">Новый интернет магазин</a></div>
                    <div class="menu-item"><a href="javascript:void(0)">Марки</a></div>
                    <div class="menu-item"><a href="javascript:void(0)">Бренды</a></div>
                    <div class="menu-item"><a href="javascript:void(0)">О компании</a></div>
                    <div class="menu-item"><a href="javascript:void(0)">Условия</a></div>
                    <div class="menu-item"><a href="javascript:void(0)">Контакты</a></div>
                </nav>
            </div>
        </header>
        <main id="main">@yield('main')</main>
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
                                <p><a href="https://studionomad.kz" target="_blank">Дизайн и разработка сайта</a> от STUDIONOMAD</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8 footer-lists">
                        <div class="footer-list">
                            <div class="footer-link"><a href="javascript:void(0)">Каталог</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Марки</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Бренды</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">О компании</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Условия</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Контакты</a></div>
                        </div>
                        <div class="footer-list">
                            <div class="footer-link"><a href="javascript:void(0)">Шины</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Жидкости ГУР</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Смазки</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Фаркопы</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Коврики</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Держатели и столики</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Жидкости амортизаторные</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Автосвет</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Провода для прикуривания</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Держатели и столики</a></div>
                        </div>
                        <div class="footer-list">
                            <div class="footer-link"><a href="javascript:void(0)">Публичная оферта</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Условия</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Конфиденциальность</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Оплата и доставка</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Корпоративным клиентам</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Программа лояльности</a></div>
                            <div class="footer-link"><a href="javascript:void(0)">Вакансии</a></div>
                        </div>
                    </div>
                    <div class="col-12 d-lg-none">
                        <div class="footer-copy text-center">
                            <p>© ТОО "Bauten" 2006-{!! now()->year !!} Все права защищены.</p>
                            <p><a href="https://studionomad.kz" target="_blank">Дизайн и разработка сайта</a> от STUDIONOMAD</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    @js(aApp('jquery/jquery.js'))
    @stack('js')
</body></html>
