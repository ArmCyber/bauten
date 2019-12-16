@extends('site.layouts.app')
@section('main')
    <div class="container pt-2s pb-s">
        <h1 class="h3">Результаты поиска</h1>
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
{{--                            <div class="pt-2 text-right">--}}
{{--                                <button class="home-search-btn filter-apply">Применить</button>--}}
{{--                            </div>--}}
                        </div>
                    @endif
                    <div class="products-content">
                        <div class="products-sort">
                            <div>
                                <span class="sort-select-title">Сортировать по</span>
                                <select name="sort" style="display:none" id="sort-select" data-smart-positioning="false">
                                    <option value="price" {!! $filtered['sort'] == 'price'?'selected':null !!}>Ценам</option>
                                    <option value="new" {!! $filtered['sort'] == 'new'?'selected':null !!}>Новинкам</option>
                                    <option value="sale" {!! $filtered['sort'] == 'sale'?'selected':null !!}>Скидкам</option>
                                </select>
                                <span class="view-toggles">
                                    <a href="javascript:void(0)" id="view-list"><i class="fas fa-th-list"></i></a>
                                    <a href="javascript:void(0)" id="view-grid"><i class="fas fa-th-large"></i></a>
                                </span>
{{--                                <select name="sort_type" id="sort-type-select" data-smart-positioning="false">--}}
{{--                                    <option value="0" {!! $filtered['sort_type']=='asc'?'selected':'false' !!}>по возрастанию</option>--}}
{{--                                    <option value="1" {!! $filtered['sort_type']=='desc'?'selected':'false' !!}>по убыванию</option>--}}
{{--                                </select>--}}
{{--                                <button class="home-search-btn filter-apply">Применить</button>--}}
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
