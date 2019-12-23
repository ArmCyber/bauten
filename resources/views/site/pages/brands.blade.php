@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    @breadcrumb(['pages'=>[['title'=>$page_title]]])@endbreadcrumb
    <h1 class="page-title">{{ $page_title }}</h1>
    <div class="pt-s brands-page">
        <div class="row row-grid l-m">
            @foreach($items as $item)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2" style="max-width: 400px; margin:0 auto;">
                    @component('site.components.brand', ['item'=>$item])@endcomponent
                </div>
            @endforeach
        </div>
    </div>
    @component('site.components.gallery', ['gallery' => $gallery])@endcomponent
</div>
@endsection
