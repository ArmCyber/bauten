@extends('banners::components.layout')
@section('title', 'Настройки магазина')
@section('body')
    @bannerBlock(['title' => 'Основные настройки'])
        <div class="row">
            <div class="col-12 col-dxl-6">
                @card(['title' => 'Минимальные суммы'])
                    @banner('minimum.shop', 'Минимальная сумма покупки')
                    @banner('minimum.delivery', 'Минимальная сумма заказа с доставкой')
                @endcard
            </div>
        </div>
    @endbannerBlock
@endsection
