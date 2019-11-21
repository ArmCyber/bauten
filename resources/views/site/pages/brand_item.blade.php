@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    <h1 class="page-title">{{ $item->name }}</h1>
    <div>
        <div class="text-center pt-s">
            <img src="{{ asset('u/brands/'.$item->image) }}" alt="{{ $item->image_alt }}" title="{{ $item->image_title }}" style="width:200px; height:auto;">
        </div>
        @if($item->short)
            <div class="brand-content-block pt-s">
                <div class="brand-content-title">Краткая информация:</div>
                <div class="about-page-content dynamic-text pt-1 text-justify">{!! $item->short !!}</div>
            </div>
        @endif
        @if($item->description)
            <div class="brand-content-block pt-s">
                <div class="brand-content-title">Специализация:</div>
                <div class="about-page-content dynamic-text pt-1 text-justify">{!! $item->description !!}</div>
            </div>
        @endif
    </div>
    @if ($user && count($brand_groups))
        <div class="brand-groups">
            <div class="row row-grid">
                @foreach($brand_groups as $brand_group)
                    <div class="col-2 brand-group">
                        <div class="brand-group-title">{{ $brand_group->name }}</div>
                        <div class="brand-group-catalogs">
                                @foreach($brand_group->catalogs as $brand_catalog)
                                    <div class="brand-group-catalog"><a href="{{ route('search', ['ca'=>$brand_catalog->id, 'br'=>$item->id]) }}">{{ $brand_catalog->name }}</a></div>
                                @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @component('site.components.gallery', ['gallery' => $gallery])@endcomponent
</div>
@endsection
