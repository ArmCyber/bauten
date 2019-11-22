@extends('banners::components.layout')
@section('title', 'Информация о компании')
@section('body')
    @bannerBlock(['title' => 'Основные параметры'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Логотипы'])
            @banner('data.logo', 'Логотип')
            @banner('data.logo_footer', 'Логотип футера')
            @endcard
        </div>
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Параметры'])
            @banner('data.email', 'Эл.почта отправки письма')
            @banner('data.seo_suffix', 'Суффикс SEO названии')
            @endcard
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title' => 'Контактные данные'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @cards(['title'=>'Эл.почты', 'banners'=>'requisites', 'id'=>'emails'])
            @banner('email', 'Эл.почта')
            @endcards
        </div>
        <div class="col-12 col-dxl-6">
            @cards(['title'=>'Тел.номера', 'banners'=>'requisites', 'id'=>'phones'])
            @banner('phone', 'Номер телефона')
            @endcards
        </div>
        <div class="col-12 col-dxl-6">
            @cards(['title'=>'Адреса', 'banners'=>'requisites', 'id'=>'addresses'])
            @banner('address', 'Адрес')
            @endcards
        </div>
    </div>
    @endbannerBlock
    @bannerBlock(['title' => 'Контент'])
    <div class="row">
        <div class="col-12 col-dxl-6">
            @cards(['title'=>'Социальные страницы', 'banners'=>'socials'])
                @banner('icon', 'Иконка')
                @banner('title', 'Название')
                @banner('url', 'Ссылка')
                @banner('active', 'Неактивно|Активно')
            @endcards
        </div>
        <div class="col-12 col-dxl-6">
            @cards(['title'=>'Логотипы способов оплат', 'banners'=>'payment_logos'])
                @banner('logo', 'Логотип')
                @banner('alt', 'Alt')
                @banner('title', 'Title')
                @banner('active', 'Неактивно|Активно')
            @endcards
        </div>
    </div>
    @endbannerBlock
@endsection
