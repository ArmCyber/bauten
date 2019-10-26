<div class="home-search-block" style="display:none">
    <div class="home-search-title align-self-baseline">Модификация</div>
    <div class="home-search-content">
        <div class="expanded-container pt-0 ">
            <div class="row row-grid">
                @foreach($items as $key=>$generations)
                    <div class="col-4">
                        <div class="search-group">
                            <div class="search-group-title">{{ $key }}</div>
                            <div class="search-group-items">
                                @foreach($generations as $generation)
                                    <div class="search-group-item"><span class="search-group-select home-search-car" data-type="generation" data-id="{{ $generation->id }}">{{ $generation->full_name }}</span></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
