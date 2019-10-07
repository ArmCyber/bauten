@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    @breadcrumb(['pages'=>[['title'=>$page_title]]])@endbreadcrumb
    <h1 class="page-title">{{ $page_title }}</h1>
    <div class="pt-s">
        <div class="row row-grid">
            @foreach($items as $item)
                <div class="col-12 col-sm-6 col-md-4">
                    @component('site.components.news_item', ['item'=>$item])@endcomponent
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@push('css')
    @css(aSite('css/inner.css'))
@endpush
