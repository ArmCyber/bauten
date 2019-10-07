@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    @breadcrumb(['pages'=>[['title'=>$page_title]]])@endbreadcrumb
    <h1 class="page-title">{{ $page_title }}</h1>
    <div>
        @if($banners->data->banner_show && $banners->data->banner)
            <div class="about-page-banner pt-s">
                <img src="{{ $banners->data->banner() }}" alt="{{ $banners->data->banner_alt }}" title="{{ $banners->data->banner_title }}" class="img-fluid">
            </div>
        @endif
        <div class="about-page-content dynamic-text pt-s">{!! $banners->data->content !!}</div>
    </div>
</div>
@endsection
