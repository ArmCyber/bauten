@extends('banners::components.layout')
@section('title', 'Тексты')
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>'Страница заказа'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title' => 'Текст самовывоза'])
            @banner('data.pickup', 'Текст')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title' => 'Текст доставки'])
            @banner('data.delivery', 'Текст')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title' => 'Счет на оплату'])
            @banner('data.bank_text', 'Текст')
            @endcard
        </div>
    </div>
    @endbannerBlock
@endsection
