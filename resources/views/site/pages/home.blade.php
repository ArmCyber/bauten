@extends('site.layouts.app')
@section('main')
    <section class="welcome-section" style="background-image: linear-gradient(rgba(0,0,0,.15),rgba(0,0,0,.15)), url('{{ asset('f/welcome.png') }}');">
        <div class="welcome">
            <div class="container">
                <h1 class="welcome-title">Автозапчасти вовремя</h1>
                <div class="welcome-bg">
                    <div class="welcome-text">
                        47 млн. предложений автозапчастей по актуальным ценам, которые привезем в
                        наш офис или доставим курьером.
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-bg">
        <div class="container">
            <h2 class="section-title">Каталог автозапчастей</h2>
            <div class="section-content row row-grid">
                @foreach([['title'=>'Шины','price'=>'7.800',],['title'=>'Диски','price'=>'9.700',],['title'=>'Щетки стеклоочистеля','price'=>'5.300',],['title'=>'Масла','price'=>'1.800',],['title'=>'Аксессуары','price'=>'9.900',],['title'=>'Электро - оборудование','price'=>'5.400',],['title'=>'Автохимия','price'=>'1.200',],['title'=>'Инструменты','price'=>'2.300',],] as $item)
                    <div class="col-4 col-xl-3">
                        <div class="catalogue-item">
                            <div class="catalogue-left">
                                <div><a href="javascript:void(0)" class="catalogue-title">{{ $item['title'] }}</a></div>
                                <div><span class="catalogue-price">Цена: от <span class="cat-price">{{ $item['price'] }}</span> <span class="kzt"></span></span></div>
                            </div>
                            <div class="catalogue-right">
                                <a href="javascript:void(0)"><img src="{{ asset('f/catalogue/'.$loop->iteration.'.png') }}" alt="{{ $item['title'] }}"></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section container">
        <h2 class="section-title">Запчасти по моделям</h2>
        <div class="section-content">
            <div class="home-parts">
                <div class="row row-grid l-m">
                    @foreach(['Audi', 'BMW', 'Chrysler', 'Citroen', 'Daewoo', 'Ford', 'Honda', 'Hyundai', 'Isuzu', 'Kia', 'Lexus'] as $item)
                        <div class="col-3 col-xl-2">
                            <a href="javascript:void(0)" class="part-item">
                                <span class="part-img"><img src="{{ asset('f/parts/'.$loop->iteration.'.png') }}" alt="{{ $item }}"></span>
                                <span class="part-title">{{ $item }}</span>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-3 col-xl-2">
                        <a href="javascript:void(0)" class="part-item card-more">
                            <span class="d-block">Посмотреть все запчасти</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="part-banners">
                <div class="part-banner">
                    <a href="javascript:void(0)" class="force-3-1">
                        <img src="{{ asset('f/home_banner_1.png') }}" alt="">
                    </a>
                </div>
                <div class="part-banner">
                    <a href="javascript:void(0)" class="force-3-1">
                        <img src="{{ asset('f/home_banner_2.png') }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-bg">
        <div class="container">
            <h2 class="section-title">Каталог брендов</h2>
            <div class="section-content row row-grid l-m">
                @foreach(['A-ONE', 'AGP', 'BAUTEN', 'BAW', 'CAMELLIA', 'CASP', 'CFT', 'DEPO', 'VISA', 'DEYE', 'DID'] as $item)
                    <div class="col-3 col-xl-2">
                        <a href="javascript:void(0)" class="brand-item">
                            <span class="brand-img"><img src="{{ asset('f/brands/'.$loop->iteration.'.png') }}" alt="{{ $item }}"></span>
                            <span class="brand-title">{{ $item }}</span>
                        </a>
                    </div>
                @endforeach
                <div class="col-3 col-xl-2">
                    <a href="javascript:void(0)" class="part-item card-more">
                        <span class="d-block">Посмотреть все бренды</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="section container">
        <h2 class="section-title">Новости</h2>
        <div class="section-content row">
            @for($i=1; $i<=3; $i++)
                <div class="col-4">
                    <div class="news-item">
                        <div class="news-img">
                            <a href="javascript:void(0)" class="force-16-9"><img src="{{ asset('f/news/'.$i.'.png') }}" alt="News"></a>
                            <span class="news-date">
                                <span class="news-day">21</span>
                                <span class="news-month">Августа</span>
                                <span class="news-year">2019</span>
                            </span>
                        </div>
                        <div class="news-content">
                            <div class="news-title"><a href="javascript:void(0)">Чинить автомобили по ОСАГО предложили старыми деталями</a></div>
                            <div class="news-short">
                                В России могут разрешить использование старых деталей
                                при ремонте автомобиля в рамках ОСАГО наравне с
                                новыми. При этом согласие владельца машины на это не
                                потребуется.
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </section>
@endsection
@push('css')
    @css(aSite('css/home.css'))
@endpush