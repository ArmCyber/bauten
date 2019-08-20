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
                        <div class="filter-values">
                            @for($i=1;$i<20;$i++)
                                <label class="filter-value">
                                    <input type="checkbox" class="filter-checkbox" name="{{ $filter_name }}[]" value="{{ $i }}">
                                    <span>{{ $i }}</span>
                                </label>
                            @endfor
                        </div>
                    </div>
                @endforeach
            </form>
        </div>
        <div class="products-content">
            <div class="products-sort">

            </div>
            <div class="product-items">
                <div class="row">
                    @for($i=1; $i<12; $i++)
                        <div class="col-3">
                            <div class="product-item">

                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
    @css(aSite('css/catalogue.css'))
@endpush
@push('js')

@endpush
