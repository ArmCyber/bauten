@extends('banners::components.layout')
@section('title', 'Вход/Регистрация')
@section('body')
    @bannerBlock(['title'=>'Контент страницы регистрации'])
        <div class="row">
            <div class="col-12">
                @card(['title'=>'Верхный блок'])

                @endcard
            </div>
        </div>
    @endbannerBlock
@endsection
