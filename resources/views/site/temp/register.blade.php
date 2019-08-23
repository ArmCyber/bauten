@extends('site.layouts.app')
@section('main')
    <div class="container py-s">
        <div class="breadcrumb page-breadcrumb">
            <div class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></div>
            <div class="breadcrumb-item"><a href="javascript:void(0)">Каталог</a></div>
            <div class="breadcrumb-item">Регистрация</div>
        </div>
        <div class="registration-page row">
            <div class="col-6">
                <div class="registration-greetings">
                    <h1 class="registration-title">Регистрация в интернет-магазине</h1>
                    <div class="registration-text dynamic-text">
                        <p>Для регистрации в интернет-магазине, пожалуйста, заполните данную анкету. Если у вас возникли проблемы с регистрацией, пожалуйста напишите нам на адрес.<br><a href="javascript:void(0)">zakaz@bauten.kz</a></p>
                    </div>
                </div>
                <div class="registration-block">
                    <form action="javascript:void(0)" method="post">@csrf
                        <div class="registration-type">
                            <div>Регистрируюсь как</div>
                            <div class="c-radios">
                                <label class="c-radio">
                                    <input type="radio" name="type" value="1" checked>
                                    <span>Юридическое лицо </span>
                                </label>
                                <label class="c-radio">
                                    <input type="radio" name="type" value="2">
                                    <span>Физическое Лицо</span>
                                </label>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-6">

            </div>
        </div>
    </div>
@endsection
@push('css')
    @css(aSite('css/inner.css'))
@endpush
