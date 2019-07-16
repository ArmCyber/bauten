@extends('site.layouts.app')
@section('main')
    <section class="home-catalogue section-bg">
        <div class="container">
            <h2 class="section-title">Каталог автозапчастей</h2>
            <div class="section-content row">
                @foreach([['title'=>'Шины','price'=>'7.800',],['title'=>'Диски','price'=>'9.700',],['title'=>'Щетки стеклоочистеля','price'=>'5.300',],['title'=>'Масла','price'=>'1.800',],['title'=>'Аксессуары','price'=>'9.900',],['title'=>'Электро - оборудование','price'=>'5.400',],['title'=>'Автохимия','price'=>'1.200',],['title'=>'Инструменты','price'=>'2.300',],] as $item)
                    <div class="col-3">
                        <div class="catalogue-item">
                            <div class="catalogue-left">
                                <div class="catalogue-title">{{ $item['title'] }}</div>
                                <div class="catalogue-price">Цена: от <span class="cat-price">{{ $item['price'] }}</span> <span class="kzt"></span></div>
                            </div>
                            <div class="catalogue-right">
                                <img src="{{ asset('t/catalogue/'.$loop->iteration.'.png') }}" alt="{{ $item['title'] }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('css')
    @css(aSite('css/home.css'))
@endpush