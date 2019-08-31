@extends('site.layouts.app')
@section('main')
<div class="container pt-s">
    <div class="breadcrumb page-breadcrumb">
        <div class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></div>
        <div class="breadcrumb-item"><a href="javascript:void(0)">Каталог</a></div>
        <div class="breadcrumb-item">Аккумуляторы</div>
    </div>
    <div class="product-page">
        <div class="product-page-head">
            <div class="row l-m">
                <div class="col-12 col-md-5">
                    <div class="product-images">
                        <div class="product-gallery-lg">
                            <div id="product-gallery" class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"><div class="product-gallery-item"><img src="{{ asset('f/product_item.png') }}" alt=""></div></div>
                                    <div class="swiper-slide"><div class="product-gallery-item"><img src="{{ asset('f/home_banner_1.png') }}" alt=""></div></div>
                                    <div class="swiper-slide"><div class="product-gallery-item"><img src="{{ asset('f/home_banner_2.png') }}" alt=""></div></div>
                                    <div class="swiper-slide"><div class="product-gallery-item"><img src="{{ asset('f/welcome.png') }}" alt=""></div></div>
                                    <div class="swiper-slide"><div class="product-gallery-item"><img src="{{ asset('f/logo.png') }}" alt=""></div></div>
                                </div>
                            </div>
                        </div>
                        <div id="product-thumbs" class="swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide pr-thumb-slide"><div class="product-gallery-item pr-thumb-item"><img src="{{ asset('f/product_item.png') }}" alt=""></div></div>
                                <div class="swiper-slide pr-thumb-slide"><div class="product-gallery-item pr-thumb-item"><img src="{{ asset('f/home_banner_1.png') }}" alt=""></div></div>
                                <div class="swiper-slide pr-thumb-slide"><div class="product-gallery-item pr-thumb-item"><img src="{{ asset('f/home_banner_2.png') }}" alt=""></div></div>
                                <div class="swiper-slide pr-thumb-slide"><div class="product-gallery-item pr-thumb-item"><img src="{{ asset('f/welcome.png') }}" alt=""></div></div>
                                <div class="swiper-slide pr-thumb-slide"><div class="product-gallery-item pr-thumb-item"><img src="{{ asset('f/logo.png') }}" alt=""></div></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="product-page-content">
                        <div class="product-page-info">
                            <h1 class="product-page-title">Ремкомплект бескамерных шин "AUTOPROFI"</h1>
                            <div class="product-page-codes">
                                <div class="product-page-code">Артикул: <span>452156125</span></div>
                                <div class="product-page-code">ОЕМ: <span>452156125</span></div>
                            </div>
                        </div>
                        <div class="product-page-description">
                            <p>
                                Соответствие современным допускам автопроизводителей США, Евросоюза и Японии, что
                                особенно ценно для смешанных автопарков и авторемонтных центров ∙ Соответствие требованиям
                                стандарта удиненной замены ALLISON TES-295, позволяющее гарантировать пробег 100 000 км. ∙
                                Улучшенные  показатели антивибрационной устойчивости ∙ Плавное и четкое переключение передач
                                в течение всего срока службы жидкости ∙ Надежную защиту деталей
                            </p>
                        </div>
                        <div class="product-page-pricing">
                            <div class="product-page-price">
                                Цена: <span class="ppp">1.200</span> <span class="kzt"></span>
                            </div>
                            <div class="product-page-mincount">Мин. количество: 40 шт.</div>
                        </div>
                        <div class="product-page-form">
                            <div class="product-page-count">
                                <div class="number-group">
                                    <button class="number-btn number-input-minus">-</button>
                                    <input type="text" value="1" maxlength="4" class="number-input">
                                    <button class="number-btn number-input-plus">+</button>
                                </div>
                            </div>
                            <div class="product-page-submit"><button>В корзину</button></div>
                        </div>
                        <div class="product-page-price mt-3">Общая стоимность: <span class="ppp">48000</span> <span class="kzt"></span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-page-body">
            <div class="product-page-specs">
                <div class="pr-specs-head">
                    <div class="pr-specs-title">Характеристики</div>
                </div>
                <div class="pr-specs-content">
                    <div class="pr-specs-tbl">
                        <div class="pr-specs-item"><div class="pr-specs-key">Бренд</div><div class="pr-specs-value">MITASU</div></div>
                        <div class="pr-specs-item"><div class="pr-specs-key">Состав</div><div class="pr-specs-value">Синтетическое</div></div>
                        <div class="pr-specs-item"><div class="pr-specs-key">Вязкость</div><div class="pr-specs-value"></div></div>
                        <div class="pr-specs-item"><div class="pr-specs-key">Объем, л</div><div class="pr-specs-value">4</div></div>
                        <div class="pr-specs-item"><div class="pr-specs-key">Тип</div><div class="pr-specs-value">Масло трансмиссионное АКПП</div></div>
                    </div>
                </div>
            </div>
            <div class="product-table">
                <div class="prod-tbl-title">Применяемость по автомобилям</div>
                <div class="prod-tbl-block">
                    <table>
                        <thead>
                        <tr>
                            <th>Марка</th>
                            <th>Модель</th>
                            <th>Поколение</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr><td class="tbl-mark">Nissan</td><td>Tida</td><td>2014 г.</td></tr>
                        <tr><td class="tbl-mark">Nissan</td><td>Tida</td><td>2014 г.</td></tr>
                        <tr><td class="tbl-mark">Nissan</td><td>Tida</td><td>2014 г.</td></tr>
                        <tr><td class="tbl-mark">Nissan</td><td>Tida</td><td>2014 г.</td></tr>
                        <tr><td class="tbl-mark">Nissan</td><td>Tida</td><td>2014 г.</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="product-table">
                <div class="prod-tbl-title">Применяемость по двигателям</div>
                <div class="prod-tbl-block">
                    <table>
                        <thead>
                        <tr>
                            <th>Марка</th>
                            <th>Модель</th>
                            <th>Поколение</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr><td class="tbl-mark">GDI</td><td>3.2</td><td>Турбо</td></tr>
                        <tr><td class="tbl-mark">GDI</td><td>4.5</td><td>Турбо</td></tr>
                        <tr><td class="tbl-mark">GDI</td><td>1.3</td><td>Турбо</td></tr>
                        <tr><td class="tbl-mark">GDI</td><td>4.4</td><td>Турбо</td></tr>
                        <tr><td class="tbl-mark">GDI</td><td>5.3</td><td>Турбо</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pb-s">
    <div class="recommended-products section-bg">
        <div class="container">
            <div class="prod-tbl-title pb-3 pb-lg-5">С этим советуем</div>
            <div class="row row-grid">
                @foreach([['Щетки стеклоочистителя "Torino" бескаркасная с силиконом 14"', '6.300', 1], ['Набор для утапливания поршней тормозного цил. 12пр', '7.800', 2], ['Ремкомплект бескамерных шин "AUTOPROFI"', '1.200', 3],['Щетки стеклоочистителя "Torino" бескаркасная с силиконом 14"', '6.300', 1]] as $item)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                        <div class="product-item">
                            <div class="product-image">
                                <img src="{{ asset('f/cat-page/'.$item[2].'.png') }}" alt="">
                            </div>
                            <div class="product-title">{{ $item[0] }}</div>
                            <div class="product-price"><span class="catalogue-price">Цена: от <span class="cat-price">{{ $item[1] }}</span> <span class="kzt"></span></span></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
    @css(aApp('swiper/swiper.css'))
    @css(aSite('css/inner.css'))
@endpush
@push('js')
    @js(aApp('swiper/swiper.js'))
    @js(aSite('js/product.js'))
@endpush
