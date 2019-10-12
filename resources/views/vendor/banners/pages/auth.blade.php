@extends('banners::components.layout')
@section('title', 'Вход/Регистрация')
@section('body')
    @bannerBlock(['title'=>'Контент страницы регистрации'])
        <div class="row">
            <div class="col-12 col-dxl-6">
                @card(['title'=>'Верхный блок'])
                    @banner('register.first_title', 'Загаловок')
                    @banner('register.first_text', 'Текст')
                @endcard
            </div>
            <div class="col-12 col-dxl-6">
                @cards(['title'=>'Правые блоки', 'banners'=>'register_right'])
                    @banner('title', 'Загаловок')
                    @banner('text', 'Текст')
                @endcards
            </div>
        </div>
    @endbannerBlock
@endsection
