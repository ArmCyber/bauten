@extends('site.layouts.app')
@section('main')
    @include('site.blocks.'.($logged_in?'auth.home_search':'guest.home_welcome'))
    <section class="section container">
        <h2 class="section-title">{{ $banners->block_titles->parts }}</h2>
        <div class="section-content">
            <div class="home-parts">
                <div class="row row-grid l-m">
                    @foreach(['Audi', 'BMW', 'Chrysler', 'Citroen', 'Daewoo', 'Ford', 'Honda', 'Hyundai', 'Isuzu', 'Kia', 'Lexus'] as $item)
                        <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                            <a href="javascript:void(0)" class="part-item">
                                <span class="part-img"><img src="{{ asset('f/parts/'.$loop->iteration.'.png') }}" alt="{{ $item }}"></span>
                                <span class="part-title">{{ $item }}</span>
                            </a>
                        </div>
                    @endforeach
                    <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                        <a href="javascript:void(0)" class="part-item card-more">
                            <span class="d-block">Посмотреть все запчасти</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="part-banners">
                @foreach($banners->banners as $banner)
                    @if(!$banner->image || !$banner->active) @continue @endif
                    <div class="part-banner">
                        <a href="{{ $banner->url?url($banner->url):'javascript:void(0)' }}" class="force-3-1 check-cursor" @if($banner->url)target="_blank" @endif>
                            <img src="{{ $banner->image() }}" alt="{{ $banner->alt }}" title="{{ $banner->title }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="section section-bg">
        <div class="container">
            <h2 class="section-title">{{ $banners->block_titles->brands }}</h2>
            <div class="section-content row row-grid l-m">
                @foreach(['A-ONE', 'AGP', 'BAUTEN', 'BAW', 'CAMELLIA', 'CASP', 'CFT', 'DEPO', 'VISA', 'DEYE', 'DID'] as $item)
                    <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                        <a href="javascript:void(0)" class="brand-item">
                            <span class="brand-img"><img src="{{ asset('f/brands/'.$loop->iteration.'.png') }}" alt="{{ $item }}"></span>
                            <span class="brand-title">{{ $item }}</span>
                        </a>
                    </div>
                @endforeach
                <div class="col-6 col-sm-4 col-md-3 col-xl-2">
                    <a href="javascript:void(0)" class="part-item card-more">
                        <span class="d-block">Посмотреть все бренды</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @if(is_active('news') && count($news))
        <section class="section container">
            <h2 class="section-title">{{ $banners->block_titles->news }}</h2>
            <div class="section-content row row-grid">
                @foreach($news as $news_item)
                    <div class="col-12 col-sm-6 col-md-4">
                        @component('site.components.news_item', ['item'=>$news_item])@endcomponent
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection
@push('css')
    @css(aSite('css/home.css'))
@endpush
