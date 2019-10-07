@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    @breadcrumb(['pages'=>[['title'=>$page_title]]])@endbreadcrumb
    <h1 class="page-title">{{ $page_title }}</h1>
    <div class="contacts-data">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="contacts-block contacts-info-block">
                    <div class="contacts-block-title">{{ $banners->data->requisites_title }}</div>
                    <div class="contacts-block-data">
                        @foreach($requisites['phone']??[] as $phone)
                            <div class="contacts-link"><a href="tel:{{ $phone }}"><i class="fas fa-phone"></i> {{ $phone }}</a></div>
                        @endforeach
                        @foreach($requisites['email']??[] as $email)
                            <div class="contacts-link"><a href="mailto:{{ $email }}"><i class="fas fa-envelope"></i> {{ $email }}</a></div>
                        @endforeach
                        @foreach($requisites['address']??[] as $address)
                            <div class="contacts-link"><i class="fas fa-map-marker-alt"></i> {{ $address }}</div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 mt-4 mt-md-0">
                <div class="contacts-block">
                    <div class="contacts-block-title">{{ $banners->data->form_title }}</div>
                    @if($errors->has('global'))
                        <p class="text-danger">{{ $errors->first('global') }}</p>
                    @elseif(session()->has('message_sent'))
                        <p class="text-success">Сообщение отпровлено.</p>
                    @endif
                    <div class="contacts-block-data"><form action="{{ route('contacts.send_message') }}" method="post">@csrf
                        <div class="form-group">
                            <label for="form-name">Имя</label>
                            <input type="text" class="form-control" id="form-name" name="name" placeholder="Имя" maxlength="200" value="{{ old('name') }}">
                            @if($errors->has('name'))
                                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="form-phone">Номер телефона</label>
                            <input type="text" class="form-control" id="form-phone" name="phone" placeholder="Номер телефона" maxlength="200" value="{{ old('phone') }}">
                            @if($errors->has('phone'))
                                <small class="form-text text-danger">{{ $errors->first('phone') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="form-email">Адрес эл.почты</label>
                            <input type="text" class="form-control" id="form-email" name="email" placeholder="Адрес эл.почты" maxlength="200" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="form-message">Сообщение</label>
                            <textarea class="form-control" id="form-message" rows="3" name="message" maxlength="1000">{{ old('message') }}</textarea>
                            @if($errors->has('message'))
                                <small class="form-text text-danger">{{ $errors->first('message') }}</small>
                            @endif
                        </div>
                        <div><button type="submit" class="btn btn-bauten">Отправить</button></div>
                    </form></div>
                </div>
            </div>
        </div>
    </div>
    <div class="contacts-map">
        <iframe class="contacts-iframe" src="{{ $banners->data->iframe }}" allowfullscreen=""></iframe>
    </div>
</div>
@endsection
@push('css')
    @css(aSite('css/inner.css'))
@endpush
