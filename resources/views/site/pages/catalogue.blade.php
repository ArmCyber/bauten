@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    @breadcrumb(['pages'=>[['title'=>$page_title,'url'=>false],['title'=>$catalogue_title]]])@endbreadcrumb
    <form id="filter-form" action="{{ url()->current() }}" method="get">
        <div class="products-block">
            @if($has_filter = (count($filters)>0))
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
                    <div class="pt-2 text-right">
                        <button class="home-search-btn filter-apply">Применить</button>
                    </div>
                </div>
            @endif
            <div class="products-content">
                <div class="products-sort">
                    <div>
                        <span class="sort-select-title">Сортировать по</span>
                        <select name="sort" id="sort-select">
                            <option value="price">Ценам</option>
{{--                            <option>Дате</option>--}}
{{--                            <option>Именам</option>--}}
                        </select>
                        <select name="sort_type" id="sort-type-select">
                            <option value="asc">по возрастанию</option>
                            <option value="desc">по убыванию</option>
                        </select>
                        <button class="home-search-btn filter-apply">Применить</button>
                    </div>
                </div>
                <div class="product-page-items">
                    <div class="row row-grid">
                        @foreach($items as $item)
                            <div class="col-12 col-sm-6 col-md-4 {!! $has_filter?'col-xl-4':'col-xl-3' !!}">
                                @component('site.components.part', ['item'=>$item])@endcomponent
                            </div>
                        @endforeach
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
    <script>
        window.csrf = "{{ csrf_token() }}";
    </script>
    @js(aSite('assets/styler/styler.js'))
    @js(aSite('js/catalogue.js'))
@endpush
