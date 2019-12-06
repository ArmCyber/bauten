@if ($slides_count = count($home_slider))
    @if($slides_count==1)
        <section class="welcome-section" style="background-image: linear-gradient(rgba(0,0,0,.15),rgba(0,0,0,.15)), url('{{ asset('u/home_slider/'.$home_slider[0]->image) }}');">
            <div class="welcome">
                <div class="container">
                    <h1 class="welcome-title">{{ $home_slider[0]->title }}</h1>
                    @if($home_slider[0]->description)
                        <div class="welcome-bg">
                            <div class="welcome-text">{{ $home_slider[0]->description }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @else
        <div id="home-slider" class="swiper-container init-first">
            <div class="swiper-wrapper">
                @foreach($home_slider as $home_slide)
                    <div class="swiper-slide">
                        <div class="welcome-section" style="background-image: linear-gradient(rgba(0,0,0,.15),rgba(0,0,0,.15)), url('{{ asset('u/home_slider/'.$home_slide->image) }}');">
                            <div class="welcome">
                                <div class="container">
                                    @if ($loop->iteration!=1)
                                        <div class="welcome-title">{{ $home_slide->title }}</div>
                                    @else
                                        <h1 class="welcome-title">{{ $home_slide->title }}</h1>
                                    @endif
                                    @if($home_slide->description)
                                        <div class="welcome-bg">
                                            <div class="welcome-text">{{ $home_slide->description }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @push('js')
            @js(aApp('swiper/swiper.js'))
            <script>
                new Swiper('#home-slider', {
                    loop: true,
                    autoplay: {
                        delay: 3000,
                    },
                    effect: 'fade'
                });
            </script>
        @endpush
        @push('css')
            @css(aApp('swiper/swiper.css'))
        @endpush
    @endif
@endif
@if (count($home_catalogs_with_image = $home_catalogs->filter(function($item){
    return $item->image;
})))
<section class="section section-bg">
    <div class="container">
        <h2 class="section-title">{{ $banners->block_titles->catalogue }}</h2>
        <div class="section-content row row-grid">
            @foreach($home_catalogs_with_image as $catalog)
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    <div class="catalogue-item">
                        <div class="catalogue-left">
                            <div><a href="{{ $url = route('catalogue', ['url'=>$catalog->url]) }}" class="catalogue-title">{{ $catalog->name }}</a></div>
                            <div><span class="catalogue-price">Цена: от <span class="cat-price">{{ $catalog->parts_min_price }}</span> <span class="kzt"></span></span></div>
                        </div>
                        <div class="catalogue-right">
                            <a href="{{ $url }}"><img src="{{ asset('u/part_catalogs/'.$catalog->image) }}" alt="{{ $catalog->image_alt }}" title="{{ $catalog->image_title }}"></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
