<div class="home-search">
    <div class="container">
        <div class="home-search-block">
            <div class="home-search-title">ЗАПЧАСТИ</div>
            <div class="home-search-content">
                @foreach($home_catalogs->take(settings('max_take', 5)) as $catalog)
                    <span class="home-search-option" data-type="product" data-id="{{ $catalog->id }}">{{ $catalog->name }}</span>
                @endforeach
            </div>
            <div class="home-search-buttons">
                <button class="home-search-btn">Еще</button>
            </div>
            <div class="home-search-expanded">
                <div class="expanded-container">
                    <div class="row row-grid">
                        @foreach($groups as $group)
                            <div class="col-2">
                                <div class="search-group">
                                    <div class="search-group-title">{{ $group->name }}</div>
                                    <div class="search-group-items">
                                        @foreach($group->catalogs as $catalog_item)
                                            <div class="search-group-item"><span class="search-group-select" data-type="product" data-id="{{ $catalog_item->id }}">{{ $catalog_item->name }}</span></div>
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
                @foreach($brands->take(settings('max_take', 5)) as $brand)
                    <span class="home-search-option" data-type="brand" data-id="{{ $brand->id }}">{{ $brand->name }}</span>
                @endforeach
            </div>
            <div class="home-search-buttons">
                <button class="home-search-btn">Еще</button>
            </div>
            <div class="home-search-expanded">
                <div class="expanded-container">
                    <div class="row row-grid">
                        @foreach($search_brands as $key=>$search_brand_group)
                            <div class="col-2">
                                <div class="search-group">
                                    <div class="search-group-title">{{ $key }}</div>
                                    <div class="search-group-items">
                                        @foreach($search_brand_group as $brand)
                                            <div class="search-group-item"><span class="search-group-select" data-type="brand" data-id="{{ $brand->id }}">{{ $brand->name }}</span></div>
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
            <div class="home-search-title">МАРКА</div>
            <div class="home-search-content">
                <span class="home-search-option">Toyota</span>
                <span class="home-search-option">Mitsubishi</span>
                <span class="home-search-option">Nissan</span>
                <span class="home-search-option">Mazda</span>
                <span class="home-search-option">Honda</span>
                <span class="home-search-option">Subaru</span>
                <span class="home-search-option">Hyundai</span>
                <span class="home-search-option">Daewoо</span>
            </div>
            <div class="home-search-buttons">
                <button class="home-search-btn">Еще</button>
            </div>
        </div>
        <div class="home-search-block">
            <div class="home-search-title">МОДЕЛЬ</div>
            <div class="home-search-content">

            </div>
            <div class="home-search-buttons">
                <button class="home-search-btn">Еще</button>
            </div>
        </div>
        <div class="home-search-block">
            <div class="home-search-title">МОДИФИКАЦИЯ</div>
            <div class="home-search-content">

            </div>
            <div class="home-search-buttons">
                <button class="home-search-btn">Еще</button>
            </div>
        </div>
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
@push('js')
    @js(aSite('js/search.js'))
@endpush
