@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    <div class="news-page-content dynamic-text clearfix">
        <div class="news-page-title d-lg-none">{{ $item->title }}</div>
        <img src="{{ asset('u/news/'.$item->image) }}" alt="{{ $item->image_alt }}" title="{{ $item->image_title }}" class="news-page-image">
        <h1 class="news-page-title d-none d-lg-block">{{ $item->title }}</h1>
        {!! $item->content !!}
    </div>
    @component('site.components.gallery', ['gallery' => $gallery])@endcomponent
</div>
@endsection
