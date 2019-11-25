@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Сохраненные товары</div>
    @if(count($user->favourites))
        <div class="row row-grid mt-3">
            @foreach($user->favourites as $item)
                <div class="col-3">
                    @component('site.components.part', ['item'=>$item])@endcomponent
                </div>
            @endforeach
        </div>
    @else
        <div class="h5 text-danger pt-2">У вас нет сохраненных товаров.</div>
    @endif
@endsection
