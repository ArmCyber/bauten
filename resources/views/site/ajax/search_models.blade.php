<div class="home-search-block position-relative" style="display:none">
    <div class="home-search-title align-self-baseline">МОДЕЛЬ</div>
    <div class="home-search-content">
        <div class="expanded-container pt-0 ">
            <div class="row row-grid">
                @foreach($items as $key=>$models)
                    <div class="col-2">
                        <div class="search-group">
                            <div class="search-group-title">{{ $key }}</div>
                            <div class="search-group-items">
                                @foreach($models as $model)
                                    <div class="search-group-item"><span class="search-group-select home-search-single" data-type="model" data-id="{{ $model->id }}">{{ $model->name }}</span></div>
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
