@extends('banners::components.layout')
@section('title', 'Контент главной страницы')
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>'Контент'])
        <div class="row">
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Блок "Каталог автозапчастей"'])
                    @banner('block_titles.catalogue', 'Название')
                @endcard
            </div>
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Блок "Запчасти по маркам"'])
                    @banner('block_titles.parts', 'Название')
                @endcard
            </div>
        </div>
        <div class="row">
            @banners('banners')
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Баннер'])
                    @banner('image', 'Изоброжение')
                    @banner('url', 'Ссылка')
                    @banner('alt', 'Alt')
                    @banner('title', 'Title')
                    @banner('active', 'Неактивно|Активно')
                @endcard
            </div>
            @endbanners
        </div>
        <div class="row">
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Блок "Каталог брендов"'])
                    @banner('block_titles.brands', 'Название')
                @endcard
            </div>
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Блок "Новости"'])
                    @banner('block_titles.news', 'Название')
                @endcard
            </div>
        </div>
    @endbannerBlock
@endsection
