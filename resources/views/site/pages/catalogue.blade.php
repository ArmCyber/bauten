@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    @breadcrumb(['pages'=>[['title'=>$page_title,'url'=>false],['title'=>$catalogue_title]]])@endbreadcrumb
    <form id="filter-form" action="javascript:void(0)">
        <div class="products-block">
            <div class="products-filters">
                @foreach($filters as $filter)
                    <div class="products-filter">
                        <div class="filter-name">{{ $filter->title }}</div>
                        <div class="filter-content">
                            <div class="filter-values">
                                @foreach($filter->criteria as $criterion)
                                    <label class="filter-value">
                                        <input type="checkbox" class="filter-checkbox" name="criterion[]" value="{{ $criterion->id }}">
                                        <span>{{ $criterion->title }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
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
                        <select name="sort_type" id="sort-type-select">
                            <option>по возрастанию</option>
                            <option>по убыванию</option>
                        </select>
                    </div>
                </div>
                <div class="product-page-items">
                    <div class="row row-grid">
                        @foreach($items as $item)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-6 col-xl-4">
                                @component('site.components.part', ['item'=>$item])@endcomponent
                            </div>
                        @endforeach
                        {{--@for($i=1; $i<=4; $i++)
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
                        @endfor--}}
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('css')
    @css(aSite('assets/styler/styler.css'))
@endpush
@push('js')
    @js(aSite('assets/styler/styler.js'))
    @js(aSite('js/catalogue.js'))
@endpush
