@extends('banners::components.layout')
@section('title', 'Основные изоброжения')
@section('body')
    @bannerBlock
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Марки'])
                @banner('data.marks', 'Логотип ((<=200)x56)')
            @endcard
        </div>
    </div>
    @endbannerBlock
@endsection
