@extends('site.layouts.app')
@section('main')
<div class="container pt-2s pb-s">
    <h1 class="h3">{{ $catalogue_title }}</h1>
</div>
<div class="container pt-s">
{{--    @breadcrumb(['pages'=>[['title'=>$page_title,'url'=>false],['title'=>$catalogue_title]]])@endbreadcrumb--}}
    <form id="filter-form" action="javascript:void(0)" method="get">
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
                                            <input type="checkbox" class="filter-checkbox criterion-checkbox" value="{{ $criterion->id }}" {!! in_array($criterion->id, $filtered['criteria'])?'checked':null !!}>
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
                        <select name="sort" id="sort-select" data-smart-positioning="false">
                            <option value="price" {!! $filtered['sort'] == 'price'?'selected':null !!}>Ценам</option>
                            <option value="new" {!! $filtered['sort'] == 'new'?'selected':null !!}>Новинкам</option>
                            <option value="sale" {!! $filtered['sort'] == 'sale'?'selected':null !!}>Скидкам</option>
                        </select>
{{--                        <select name="sort_type" id="sort-type-select" data-smart-positioning="false">--}}
{{--                            <option value="0" {!! $filtered['sort_type']=='asc'?'selected':'false' !!}>по возрастанию</option>--}}
{{--                            <option value="1" {!! $filtered['sort_type']=='desc'?'selected':'false' !!}>по убыванию</option>--}}
{{--                        </select>--}}
                        <button class="home-search-btn filter-apply">Применить</button>
                    </div>
                </div>
                <div class="product-page-items">
                    {{ $items->links() }}
                    <div class="row row-grid">
                        @foreach($items as $item)
                            <div class="col-12 col-sm-6 col-md-4 {!! $has_filter?'col-xl-4':'col-xl-3' !!}">
                                @component('site.components.part', ['item'=>$item])@endcomponent
                            </div>
                        @endforeach
                    </div>
                    <div class="pt-4">
                        {{ $items->links() }}
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
        window.filtersUrl = "{{ url()->current() }}";
    </script>
    @js(aSite('assets/styler/styler.js'))
    @js(aSite('js/catalogue.js'))
@endpush
