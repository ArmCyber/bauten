@extends('site.layouts.app')
@section('main')
    <div class="container pt-2s pb-s">
        <h1 class="h3">Результаты поиска</h1>
        <div class="search-page-data">
            @if(array_key_exists('catalogue', $names))
                <p><b>Запчасть: </b> {{ $names['catalogue'] }}</p>
            @endif
            @if (array_key_exists('brands', $names))
                <p><b>{{ count($names['brands'])==1?'Бренд':'Бренды' }}:</b> {{ implode(', ', $names['brands']) }}</p>
            @endif
            @if (array_key_exists('marks', $names))
                <p><b>{{ count($names['marks'])==1?'Марка':'Марки' }}:</b> {{ implode(', ', $names['marks']) }}</p>
            @endif
            @if (array_key_exists('models', $names))
                <p><b>{{ count($names['models'])==1?'Модель':'Модели' }}:</b> {{ implode(', ', $names['models']) }}</p>
            @endif
            @if (array_key_exists('generations', $names))
                <p><b>{{ count($names['generations'])==1?'Кузов':'Кузовы' }}:</b> {{ implode(', ', $names['generations']) }}</p>
            @endif
            @if (array_key_exists('engines', $names))
                <p><b>{{ count($names['engines'])==1?'Двигатель':'Двигатели' }}:</b> {{ implode(', ', $names['engines']) }}</p>
            @endif
            <div class="pt-3 font-weight-bold">
                @if($items->total() == 0)
                    <span class="text-danger">К сожалению по вашему запросу ничего не найдено.</span>
                @else
                    <span>По вашему запросу найдено {{ $items->total() }} запчаст(ов).</span>
                @endif
            </div>
        </div>
    </div>
    @if($items->total())
        <div class="container pt-s">
            <form id="filter-form" action="javascript:void(0)" method="get">
                @foreach($appends as $key=>$val)
                    <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                @endforeach
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
                                    <option value="price" {!! $filtered['sort'] == 'price'?'selected':'false' !!}>Ценам</option>
{{--                                    <option>Скидкам</option>--}}
{{--                                    <option>Новинкам</option>--}}
                                </select>
                                <select name="sort_type" id="sort-type-select" data-smart-positioning="false">
                                    <option value="0" {!! $filtered['sort_type']=='asc'?'selected':'false' !!}>по возрастанию</option>
                                    <option value="1" {!! $filtered['sort_type']=='desc'?'selected':'false' !!}>по убыванию</option>
                                </select>
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
    @endif
@endsection
@push('css')
    @css(aSite('assets/styler/styler.css'))
@endpush
@push('js')
    <script>
        window.csrf = "{{ csrf_token() }}";
        window.filtersUrl = "{{ route('search') }}";
    </script>
    @js(aSite('assets/styler/styler.js'))
    @js(aSite('js/catalogue.js'))
@endpush
