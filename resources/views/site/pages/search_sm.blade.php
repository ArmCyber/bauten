@extends('site.layouts.app')
@section('main')
    <div class="container pt-2s pb-s">
        <h1 class="cat-title">Результаты поиска</h1>
        @if ($items_count==0)
            <span class="text-danger">К сожалению по вашему запросу ничего не найдено.</span>
        @endif
    </div>
    @if($items_count)
        <div class="container pt-s">
            <form id="filter-form" action="javascript:void(0)" method="get">
{{--                @foreach($appends as $key=>$val)--}}
{{--                    <input type="hidden" name="{{ $key }}" value="{{ $val }}">--}}
{{--                @endforeach--}}
                <div class="products-block">
                    @if($has_filter = (count($filters)>0))
                        <button id="mobile-filters-toggle"><i class="fas fa-filter"></i></button>
                        <div class="products-filters">
                            <div class="d-block d-xl-none clearfix">
                                <button id="close-filters" type="button" class="close" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
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
                            {{--                    <div class="pt-2 text-right">--}}
                            {{--                        <button class="home-search-btn filter-apply">Применить</button>--}}
                            {{--                    </div>--}}
                        </div>
                    @endif
                    <div class="products-content">
                        <div class="products-sort">
                            <input type="hidden" name="c_sort" value="{{ $filtered['sort'] }}" id="c_sort">
                            <input type="hidden" name="c_sort_type" value="{{ $filtered['sort_type'] }}" id="c_sort_type">
                            <div>
                                <span class="sort-select-title">Сортировать по</span>
                                <select name="sort" id="sort-select" data-smart-positioning="false" style="display: none">
                                    <option value="new" {!! $filtered['sort'] == 'new'?'selected':null !!}>Новинкам</option>
                                    <option value="sale" {!! $filtered['sort'] == 'sale'?'selected':null !!}>Скидкам</option>
                                    @if (in_array($filtered['sort'], ['code', 'name', 'brand', 'price']))
                                        <option value="other" selected>Другое</option>
                                    @endif
                                </select>
                                <span class="view-toggles">
                            <a href="javascript:void(0)" id="view-list"><i class="fas fa-th-list"></i></a>
                            <a href="javascript:void(0)" id="view-grid"><i class="fas fa-th-large"></i></a>
                        </span>
                            </div>
                        </div>
                        <div id="list-wrapper" class="position-relative loader-shown">
                            <div class="product-page-items" id="list-container"></div>
                            <div class="loader" style="background-color: transparent"></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif
@endsection
@push('css')
    @css(aSite('assets/styler/styler.css'))
@endpush
@push('js')
{{--    <script>--}}
{{--        window.csrf = "{{ csrf_token() }}";--}}
{{--        window.filtersUrl = "{{ route('search_sm') }}";--}}
{{--     </script>--}}
    @js(aSite('assets/styler/styler.js'))
    @js(aSite('js/part-list.js'))
{{--    @js(aSite('js/catalogue.js'))--}}
    <script>
        new PartList({
            url: "{{ route('ajax.search_sm', ['q'=>$search_val]) }}",
            realUrl: "{{ route('search_sm', ['q'=>$search_val]) }}",
            page: {{ $currentPaginationPage }},
            viewType: '{{ session('view_type', 'list') }}'
        });
    </script>
@endpush
