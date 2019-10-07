@extends('banners::components.layout')
@section('title', 'Баннеры')
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>'Контент'])
        <div class="row">
            <div class="col-12 col-dxl-6">
                @card(['title' => 'Блок "Реквизиты"'])
                @banner('data.requisites_title', 'Название блока')
                @endcard
            </div>
            <div class="col-12 col-dxl-6">
                @card(['title' => 'Блок контактной формы'])
                @banner('data.form_title', 'Название блока')
                @endcard
            </div>
            <div class="col-12">
                @card(['title' => 'Карта'])
                @banner('data.iframe', 'Ссылка карты')
                @endcard
            </div>
        </div>
    @endbannerBlock
@endsection
