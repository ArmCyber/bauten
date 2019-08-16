@extends('site.layouts.app')
@section('main')
<div class="container py-s">
    <div class="breadcrumb page-breadcrumb">
        <div class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></div>
        <div class="breadcrumb-item"><a href="javascript:void(0)">Каталог</a></div>
        <div class="breadcrumb-item">Аккумуляторы</div>
    </div>
    <div class="products-block">
        <div class="products-filters">

        </div>
        <div class="products-content">
            <div class="products-sort">

            </div>
            <div class="product-items">
                <div class="row">
                    @for($i=1; $i<12; $i++)
                        <div class="col-3">
                            <div class="product-item">

                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
    @css(aSite('css/catalogue.css'))
@endpush
