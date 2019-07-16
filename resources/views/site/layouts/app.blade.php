<!doctype html><html lang="ru"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bauten</title>
    <link rel="shortcut icon" href="{!! asset('favicon.ico') !!}">
    @css(aApp('bootstrap/css/bootstrap.css'))
    @css(aSite('css/app.css'))
    @css(aSite('css/main.css'))
    @stack('css')
</head><body>
    <div id="page">
        <header id="header">
            <div id="header-top">
                <div class="container ht-container">
                    <div class="ht-sm">
                        <a href="{{ url('/') }}" class="ht-brand"><img src="{{ asset('t/logo.png') }}" alt=""></a>
                    </div>
                    <div class="ht-lg">
                        <a href="tel:+87776191747" class="ht-tel">8 (777) 619 1747</a>
                    </div>
                    <div class="ht-sm text-right">
                        <a href="javascript:void(0)" class="ht-login">Регистрация</a>
                    </div>
                </div>
            </div>
            <div id="header-menu">
                <nav id="menu" class="container">
                    <div class="menu-item"><a href="javascript:void(0)">Каталог</a></div>
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
                    <div class="col-4">
                        <div class="footer-main">
                            <div>
                                <img class="footer-logo" src="{{ asset('t/logo-footer.png') }}" alt="">
                            </div>
                            <div class="footer-contacts">
                                <div>Алматы Казахстан, с. Мадениет уч. 383</div>
                                <div>Алматы  8 (707) 173 7656</div>
                                <div>Алматы 8 (775) 996 1880</div>
                            </div>
                            <div class="footer-socs">
                                <a href="#" class="footer-soc"><img src="{{ asset('t/messenger.svg') }}" alt="Messenger"><span>Bautenautoparts</span></a>
                            </div>
                            <div class="footer-payments">
                                <img src="{{ asset('t/visa.png') }}" alt="visa">
                                <img src="{{ asset('t/mastercard.png') }}" alt="visa">
                            </div>
                            <div class="footer-copy">
                                <p>© ТОО "Bauten" 2006-{!! now()->year !!} Все права защищены.</p>
                                <p><a href="https://studionomad.kz" target="_blank">Дизайн и разработка сайта</a> от STUDIONOMAD</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 footer-lists">
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
                </div>
            </div>
        </footer>
    </div>
    @stack('js')
</body></html>