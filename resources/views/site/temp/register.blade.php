@extends('site.layouts.app')
@section('main')
    <div class="container py-s">
        <div class="breadcrumb page-breadcrumb">
            <div class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></div>
            <div class="breadcrumb-item"><a href="javascript:void(0)">Каталог</a></div>
            <div class="breadcrumb-item">Регистрация</div>
        </div>
        <div class="registration-page row">
            <div class="col-12 col-lg-6">
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
                                    <input type="radio" id="legal-person-radio" class="reg-type-radio" name="type" value="2" checked>
                                    <span>Юридическое лицо</span>
                                </label>
                                <label class="c-radio">
                                    <input type="radio" name="type" class="reg-type-radio" value="1">
                                    <span>Физическое Лицо</span>
                                </label>
                            </div>
                            <div class="c-inputs lp-checked">
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-city">Город</label></div>
                                    <div class="c-control"><input type="text" id="form-city" name="city"></div>
                                </div>
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-name">Имя</label></div>
                                    <div class="c-control"><input type="text" id="form-name" name="name"></div>
                                </div>
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-lname">Фамилия</label></div>
                                    <div class="c-control"><input type="text" id="form-lname" name="last-name"></div>
                                </div>
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-phone">Телефон</label></div>
                                    <div class="c-control"><input type="text" id="form-phone" name="phone"></div>
                                </div>
                                <div class="c-form-group">
                                    <div class="c-label"><label for="form-email">E-mail</label></div>
                                    <div class="c-control"><input type="text" id="form-email" name="email"></div>
                                </div>
                                <div class="c-form-group lp-only">
                                    <div class="c-label"><label for="form-company">Компания</label></div>
                                    <div class="c-control"><input type="text" id="form-company" name="company"></div>
                                </div><div class="c-form-group lp-only">
                                    <div class="c-label"><label for="form-bin">БИН</label></div>
                                    <div class="c-control"><input type="text" id="form-bin" name="bin"></div>
                                </div>
                                <div class="c-form-group">
                                    <div class="c-label"></div>
                                    <div class="c-control text-right"><button type="submit" class="bauten-btn">Подтвердить</button></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="registration-terms">
                    <div class="registration-term">
                        <div class="term-title">Условия сотрудничества</div>
                        <div class="term-content">
                            <div class="term-description">
                                <p>Мы не несём ответственность за применимость заказываемой детали к автомобилю Вашего клиента</p><br>
                                <p>Доставка осуществляется силами нашей компании. Способы доставки и минимальные параметры отправки согласовываются с каждым клиентом индивидуально.</p>
                            </div>
                        </div>
                    </div>
                    <div class="registration-term">
                        <div class="term-title">Работа с нами — это</div>
                        <div class="term-content">
                            <div class="term-description">
                                <p>Различные формы оплаты: наличный расчет, безналичный расчет, банковский перевод.</p><br>
                                <p>Оперативная доставка продукции по всей территории Казахстана и стран СНГ</p><br>
                                <p>Право на получение специальных цен на товары</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('css')
    @css(aSite('css/inner.css'))
@endpush
@push('js')
    @js(aSite('js/registration.js'))
@endpush
