@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    <div class="breadcrumb page-breadcrumb">
        <div class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></div>
        <div class="breadcrumb-item"><a href="javascript:void(0)">Каталог</a></div>
        <div class="breadcrumb-item">Аккумуляторы</div>
    </div>
    <div class="products-block">
        <div class="products-filters">
            <form action="javascript:void(0)">
                @foreach(['height'=>'Высота', 'length'=>'Длина', 'width'=>'Ширина', 'brand'=>'Бренд', 'capacity'=>'Ёмкость', 'polarity'=>'Полярность', 'terminal_location'=>'Расположение клемм'] as $filter_name=>$filter_title)
                    <div class="products-filter">
                        <div class="filter-name">{{ $filter_title }}</div>
                        <div class="filter-content">
                            <div class="filter-values">
                                @for($i=1;$i<20;$i++)
                                    <label class="filter-value">
                                        <input type="checkbox" class="filter-checkbox" name="{{ $filter_name }}[]" value="{{ $i }}">
                                        <span>{{ $i }}</span>
                                    </label>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
        <div class="products-content">
            <div class="products-sort">
                <div>
                    <span class="sort-select-title">Сортировать по</span>
                    <select name="sort" id="sort-select">
                        <option>Ценам</option>
                        <option>Дате</option>
                        <option>Именам</option>
                    </select>
                </div>
            </div>
            <div class="product-page-items">
                <div class="row row-grid">
                    @for($i=1; $i<=4; $i++)
                        @foreach([['Щетки стеклоочистителя "Torino" бескаркасная с силиконом 14"', '6.300'], ['Набор для утапливания поршней тормозного цил. 12пр', '7.800'], ['Ремкомплект бескамерных шин "AUTOPROFI"', '1.200']] as $item)
                        <div class="col-12 col-sm-6 col-md-4 col-lg-6 col-xl-4">
                            <div class="product-item">
                                <div class="product-image">
                                    <img src="{{ asset('f/cat-page/'.$loop->iteration.'.png') }}" alt="">
                                </div>
                                <div class="product-title">{{ $item[0] }}</div>
                                <div class="product-price"><span class="catalogue-price">Цена: от <span class="cat-price">{{ $item[1] }}</span> <span class="kzt"></span></span></div>
                            </div>
                        </div>
                        @endforeach
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
    @css(aSite('assets/styler/styler.css'))
    @css(aSite('css/inner.css'))
@endpush
@push('js')
    @js(aSite('assets/styler/styler.js'))
    @js(aSite('js/catalogue.js'))
@endpush