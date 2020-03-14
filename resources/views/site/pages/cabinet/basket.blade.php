@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Корзина</div>
    @if($basket_parts_count = count($basket_parts))
        <div class="basket-table pt-2 not-in-stock-hidden">
            <div class="basket-table-container">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th><input type="checkbox" id="all-checkbox" class="basket-checkbox" @if(!$basket_parts->where('checked', '0')->count()) checked @endif></th>
                        <th>Артикул</th>
                        <th>Название</th>
                        <th style="white-space: nowrap">Цена</th>
                        <th>Кол-во</th>
                        <th style="white-space: nowrap">Сумма</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($basket_parts as $basket_part)
                        <tr class="basket-part-row" data-id="{{ $basket_part->part->id }}">
                            <td><input type="checkbox" class="basket-checkbox part-checkbox" @if($basket_part->checked) checked @endif></td>
                            <td style="min-width: 120px"><a href="{{ route('part', ['url'=>$basket_part->part->url]) }}" class="link-bauten">{{ $basket_part->part->code }}</a></td>
                            <td><a href="{{ route('part', ['url'=>$basket_part->part->url]) }}" class="link-bauten basket-part-title">{{ $basket_part->part->name }}</a></td>
                            <td style="white-space: nowrap">
                                @if($basket_part->part->sale)
                                    <span style="text-decoration: line-through">{{ $basket_part->part->sale }} <span class="kzt"></span></span>&nbsp;
                                @endif
                                {{ $basket_part->part->price }} <span class="kzt"></span>
                            </td>
                            <td>
                                <div class="number-group number-group-sm position-relative">
                                    <button class="number-btn number-input-minus">-</button>
{{--                                    <input type="text" value="{{ $basket_part->count }}" data-multiplication="{{ $basket_part->part->multiplication }}" data-price="{{ $basket_part->part->price }}" data-minimum="{{ $basket_part->part->min_count_ceil_wo_basket??1 }}" data-available="{{ $basket_part->part->max_count_wo_basket??999999 }}" data-cs-count="{{ $basket_part->part->count_sale_count??null }}" data-cs-percent="{{ $basket_part->part->count_sale_percent??null }}" class="number-input">--}}
                                    <input type="text" value="{{ $basket_part->count }}" data-multiplication="{{ $basket_part->part->multiplication }}" data-price="{{ $basket_part->part->price }}" data-minimum="{{ $basket_part->part->min_count_ceil_wo_basket??1 }}" data-available="10000" data-cs-count="{{ $basket_part->part->count_sale_count??null }}" data-cs-percent="{{ $basket_part->part->count_sale_percent??null }}" class="number-input">
                                    <button class="number-btn number-input-plus">+</button>
                                    <div class="loader loader-ng"></div>
                                </div>
                            </td>
                            <td style="white-space: nowrap">
                                <span class="bp-sale" style="text-decoration:line-through;display:none">
                                    <span class="bp-sale-sum"></span>
                                    <span class="kzt"></span>
                                </span>&nbsp
                                <span class="bp-sum"></span>
                                <span class="kzt"></span>
                            </td>
                            <td><a href="javascript:void(0)" class="text-danger delete-basket-item" data-id="{{ $basket_part->part->id }}"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="cabinet-title text-right price-block">Итого: <span class="all-sale-block sale-price" style="display:none;"><span class="all-sale"></span> <span class="kzt"></span></span> <span class="all-price"></span> <span class="kzt"></span></div>
            <div class="text-right pt-3"><button id="order-modal-toggle" class="bauten-btn" disabled>Заказать</button></div>
            <div class="text-right pt-2 text-danger small-text if-cant-shop" style="display: none">Чтобы заказать вам надо сделать покупку суммы {{ $settings->minimum->shop }} <span class="kzt"></span></div>
            <div class="text-right pt-2 text-danger small-text if-not-checked" style="display: none">Чтобы заказать вам надо выбрать продукт.</div>
            @push('pageScripts') @js(aSite('js/basket.js')) @endpush
        </div>
    @endif

    <div class="h5 text-danger pt-2 not-in-stock">Корзина пуста.</div>
@endsection
@push('js')
    @js(aApp('bootstrap/js/bootstrap.js'))
    <script>
        var userSale = {{ $user->sale }},
            actions = {
                update: '{{ route('cabinet.basket.update') }}',
                delete: '{{ route('cabinet.basket.delete') }}',
                order: '{{ route('cabinet.order') }}',
                check: '{{ route('cabinet.basket.check') }}',
            },
            minimums = {
                shop: {{ (($minimum_shop = $settings->minimum->shop) && is_numeric($minimum_shop) && $minimum_shop>0)?((int) $minimum_shop):0 }},
            },
            csrf = '{{ csrf_token() }}';
    </script>
    @stack('pageScripts')
@endpush
