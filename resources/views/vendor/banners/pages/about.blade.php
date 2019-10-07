@extends('banners::components.layout')
@section('title', 'Контент страницы "О компании"')
@php $back_url = route('admin.pages.main') @endphp
@section('body')
    @bannerBlock(['title'=>'Контент'])
        <div class="row">
            <div class="col-12 col-dxl-6">
                @card(['title' => 'Баннер'])
                @banner('data.banner', 'Изоброжение(рек. шир. 1440px)')
                @banner('data.banner_alt', 'Alt')
                @banner('data.banner_title', 'Title')
                @banner('data.banner_show', 'Неактивно|Активно')
                @endcard
            </div>
            <div class="col-12 col-dxl-6">
                @card(['title' => 'Контент'])
                @banner('data.content', 'Контент')
                @endcard
            </div>
        </div>
    @endbannerBlock
@endsection
