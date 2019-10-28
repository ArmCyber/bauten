@extends('site.mails.layout')
@section('content')
    <p>{{ __('mails.new_email.message', ['name'=>$user->name]) }}</p>
    <p><a href="{{ $url }}">{{ $url }}</a></p>
@endsection
