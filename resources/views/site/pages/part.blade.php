@extends('site.layouts.app')
@section('main')
<div class="container pt-s">
    @breadcrumb(['pages'=>[['title'=>$page_title,'url'=>false],['title'=>$item->catalogue->name, 'url'=>route('catalogue', ['url'=>$item->catalogue->url])]]])@endbreadcrumb
    <div class="product-page">
        <div class="product-page-head">
            <div class="row l-m">
                @if(($item->image && $item->show_image) || count($gallery))
                    @php $images_av=true; @endphp
                    <div class="col-12 col-md-5">
                        <div class="product-images">
                            <div class="product-gallery-lg">
                                <div id="product-gallery" class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @if($item->image && $item->show_image)
                                            <div class="swiper-slide"><div class="product-gallery-item"><img src="{{ asset('u/parts/'.$item->image) }}" alt="{{ $item->name }}" title="{{ $item->title }}"></div></div>
                                        @endif
                                        @foreach($gallery as $gallery_item)
                                            <div class="swiper-slide"><div class="product-gallery-item"><img src="{{ $gallery_item->image() }}" alt="{{ $gallery_item->alt }}" title="{{ $gallery_item->title }}"></div></div>
                                            @push('gallery_thumbs')
                                                <div class="swiper-slide pr-thumb-slide"><div class="product-gallery-item pr-thumb-item"><img src="{{ $gallery_item->image() }}" alt="{{ $gallery_item->alt }}" title="{{ $gallery_item->title }}"></div></div>
                                            @endpush
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if(count($gallery))
                                <div id="product-thumbs" class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide pr-thumb-slide"><div class="product-gallery-item pr-thumb-item"><img src="{{ asset('u/parts/'.$item->image) }}" alt="{{ $item->name }}" title="{{ $item->title }}"></div></div>
                                        @stack('gallery_thumbs')
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="col-12{!! isset($images_av)?' col-md-7':' mt-3' !!}">
                    <div class="product-page-content">
                        <div class="product-page-info">
                            <h1 class="product-page-title">{{ $item->name }}</h1>
                            <div class="product-page-codes">
                                <div class="product-page-code">Артикул: <span>{{ $item->code }}</span></div>
                                @if($item->oem)
                                    <div class="product-page-code">ОЕМ: <span>{{ $item->oem }}</span></div>
                                @endif
                            </div>
                        </div>
                        @if($item->description)
                            <div class="product-page-description">{!! $item->description !!}</div>
                        @endif
                        <div class="product-page-pricing">
                            <div class="product-page-price">
                                Цена: <span class="ppp">{{ $item->price }}</span> <span class="kzt"></span>
                            </div>
{{--                            <div class="product-page-mincount">Мин. количество: 40 шт.</div>--}}
                        </div>
                        {{--<div class="product-page-form">
                            <div class="product-page-count">
                                <div class="number-group">
                                    <button class="number-btn number-input-minus">-</button>
                                    <input type="text" value="1" maxlength="4" class="number-input">
                                    <button class="number-btn number-input-plus">+</button>
                                </div>
                            </div>
                            <div class="product-page-submit"><button>В корзину</button></div>
                        </div>
                        <div class="product-page-price mt-3">Общая стоимность: <span class="ppp">48000</span> <span class="kzt"></span></div>--}}
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
                        <div class="pr-specs-item"><div class="pr-specs-key">Бренд</div><div class="pr-specs-value">{{ $item->brand->name }}</div></div>
                        @foreach($item_filters as $item_filter)
                            <div class="pr-specs-item"><div class="pr-specs-key">{{ $item_filter[0]->filter->title }}</div><div class="pr-specs-value">
                                @foreach($item_filter as $item_criterion) @if(!$loop->first)<br>@endif <span>{{ $item_criterion->title }}</span> @endforeach
                            </div></div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if(count($item->cars))
                <div class="product-table">
                    <div class="prod-tbl-title">Применяемость по автомобилям</div>
                    <div class="prod-tbl-block">
                        <table>
                            <thead>
                            <tr>
                                <th>Марка</th>
                                <th>Модель</th>
                                <th>Модификация</th>

                            </tr>
                            <tbody>
                            @foreach($item->cars as $car)
                                <tr><td class="tbl-mark">{{ $car->mark->name??'?' }}</td><td>{{ $car->model_id==0?'-':($car->model->name??'?') }}</td><td>{{ $car->generation_id!=0?$car->generation->full_name:'-' }}</td></tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
            @if(count($item_engine_filters))
                <div class="product-page-specs mt-4">
                    <div class="prod-tbl-title">Применяемость по двигателям</div>
                    <div class="pr-specs-content">
                        <div class="pr-specs-tbl">
                            @foreach($item_engine_filters as $item_filter)
                                <div class="pr-specs-item"><div class="pr-specs-key">{{ $item_filter[0]->filter->title }}</div><div class="pr-specs-value">
                                        @foreach($item_filter as $item_criterion) @if(!$loop->first)<br>@endif <span>{{ $item_criterion->title }}</span> @endforeach
                                    </div></div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
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
@endpush
@push('js')
    @js(aApp('swiper/swiper.js'))
    @js(aSite('js/product.js'))
@endpush
