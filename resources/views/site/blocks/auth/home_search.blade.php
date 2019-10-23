<div class="home-search">
    <div class="container">
        <div class="home-search-block">
            <div class="home-search-title">ЗАПЧАСТИ</div>
            <div class="home-search-content">
                @foreach($home_catalogs->take($max_take = settings('max_take', 5)) as $catalog)
                    <span class="home-search-option home-search-multi" data-type="product" data-id="{{ $catalog->id }}">{{ $catalog->name }}</span>
                @endforeach
            </div>
            <div class="home-search-buttons">
                <button class="home-search-btn home-search-toggle"></button>
            </div>
            <div class="home-search-expanded" style="display:none">
                <div class="expanded-container">
                    <div class="row row-grid">
                        @foreach($groups as $group)
                            <div class="col-2">
                                <div class="search-group">
                                    <div class="search-group-title">{{ $group->name }}</div>
                                    <div class="search-group-items">
                                        @foreach($group->catalogs as $catalog_item)
                                            <div class="search-group-item"><span class="search-group-select home-search-multi" data-type="product" data-id="{{ $catalog_item->id }}">{{ $catalog_item->name }}</span></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="home-search-block">
            <div class="home-search-title">БРЕНДЫ</div>
            <div class="home-search-content">
                @foreach($brands->take($max_take) as $brand)
                    <span class="home-search-option home-search-multi" data-type="brand" data-id="{{ $brand->id }}">{{ $brand->name }}</span>
                @endforeach
            </div>
            <div class="home-search-buttons">
                <button class="home-search-btn home-search-toggle"></button>
            </div>
            <div class="home-search-expanded" style="display:none">
                <div class="expanded-container">
                    <div class="row row-grid">
                        @foreach($search_brands as $key=>$search_brand_group)
                            <div class="col-2">
                                <div class="search-group">
                                    <div class="search-group-title">{{ $key }}</div>
                                    <div class="search-group-items">
                                        @foreach($search_brand_group as $brand)
                                            <div class="search-group-item"><span class="search-group-select home-search-multi" data-type="brand" data-id="{{ $brand->id }}">{{ $brand->name }}</span></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="home-search-block position-relative">
            <div class="home-search-title">МАРКА</div>
            <div class="home-search-content">
                @foreach($marks->take($max_take) as $mark)
                    <span class="home-search-option home-search-single" data-type="mark" data-id="{{ $mark->id }}">{{ $mark->name }}</span>
                @endforeach
            </div>
            <div class="home-search-buttons">
                <button class="home-search-btn home-search-toggle"></button>
            </div>
            <div class="home-search-expanded" style="display:none">
                <div class="expanded-container">
                    <div class="row row-grid">
                        @foreach($search_marks as $key=>$search_mark_group)
                            <div class="col-2">
                                <div class="search-group">
                                    <div class="search-group-title">{{ $key }}</div>
                                    <div class="search-group-items">
                                        @foreach($search_mark_group as $mark)
                                            <div class="search-group-item"><span class="search-group-select home-search-single" data-type="mark" data-id="{{ $mark->id }}">{{ $mark->name }}</span></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="loader"></div>
        </div>
        <div id="home-ajax-models"></div>
        <div id="home-ajax-generations"></div>
        <div class="home-search-block">
            <div class="home-search-title"><label class="all-inherit" for="home-search-engine">ДВИГАТЕЛЬ</label></div>
            <div class="home-search-content">
                <div class="home-search-input">
                    <input type="text" class="home-search-control" id="home-search-engine">
                </div>
            </div>
            <div class="home-search-buttons">
                <button class="home-search-btn">Применить</button>
                <button class="home-search-btn">Сбросить</button>
            </div>
        </div>
    </div>
</div>
@modal(['id'=>'maxTakeModal', 'centered'=>true, 'closeBtn' => 'Закрыть', 'hide_save_btn'=>true])
    @slot('title')Выберите максимум {{ $max_take }} елементов.@endslot
    <p class="font-14">Выберите максимум {{ $max_take }} елементов.</p>
@endmodal
@push('js')
    @js(aApp('bootstrap/js/bootstrap.js'))
    @js(aSite('js/search.js'))
@endpush
