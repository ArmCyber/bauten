<section class="welcome-section" style="background-image: linear-gradient(rgba(0,0,0,.15),rgba(0,0,0,.15)), url('{{ asset('f/welcome.png') }}');">
    <div class="welcome">
        <div class="container">
            <h1 class="welcome-title">Автозапчасти вовремя</h1>
            <div class="welcome-bg">
                <div class="welcome-text">
                    47 млн. предложений автозапчастей по актуальным ценам, которые привезем в
                    наш офис или доставим курьером.
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section section-bg">
    <div class="container">
        <h2 class="section-title">Каталог автозапчастей</h2>
        <div class="section-content row row-grid">
            @foreach([['title'=>'Шины','price'=>'7.800',],['title'=>'Диски','price'=>'9.700',],['title'=>'Щетки стеклоочистеля','price'=>'5.300',],['title'=>'Масла','price'=>'1.800',],['title'=>'Аксессуары','price'=>'9.900',],['title'=>'Электро - оборудование','price'=>'5.400',],['title'=>'Автохимия','price'=>'1.200',],['title'=>'Инструменты','price'=>'2.300',],] as $item)
                <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                    <div class="catalogue-item">
                        <div class="catalogue-left">
                            <div><a href="javascript:void(0)" class="catalogue-title">{{ $item['title'] }}</a></div>
                            <div><span class="catalogue-price">Цена: от <span class="cat-price">{{ $item['price'] }}</span> <span class="kzt"></span></span></div>
                        </div>
                        <div class="catalogue-right">
                            <a href="javascript:void(0)"><img src="{{ asset('f/catalogue/'.$loop->iteration.'.png') }}" alt="{{ $item['title'] }}"></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>