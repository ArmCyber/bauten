@extends('site.layouts.app')
@section('main')
<div class="container py-s error-container">
    <div class="error-code">{{ $error['code'] }}</div>
    <div class="error-title">{{ $error['title'] }}</div>
    @isset($error['message'])
        <div class="error-message">{{ $error['message'] }}</div>
    @endisset
</div>
@endsection
