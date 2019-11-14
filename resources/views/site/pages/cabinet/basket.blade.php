@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Корзина</div>
    @if($basket_parts_count = count($basket_parts))
        <div class="basket-table pt-2 not-in-stock-hidden">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Кол-во</th>
                        <th>Сумма</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($basket_parts as $basket_part)
                        <tr class="basket-part-row" data-id="{{ $basket_part->part->id }}">
                            <td><a href="{{ route('part', ['url'=>$basket_part->part->url]) }}" class="link-bauten">{{ $basket_part->part->name }}</a></td>
                            <td>
                                {{ $basket_part->part->price }} <span class="kzt"></span>
                                @if($basket_part->part->sale)
                                    <span style="text-decoration: line-through">{{ $basket_part->part->sale }} <span class="kzt"></span></span>
                                @endif
                            </td>
                            <td>
                                <div class="number-group number-group-sm position-relative">
                                    <button class="number-btn number-input-minus">-</button>
                                    <input type="text" value="{{ $basket_part->count }}" data-multiplication="{{ $basket_part->part->multiplication }}" data-price="{{ $basket_part->part->price }}" data-minimum="{{ $basket_part->min_count??1 }}" data-available="{{ $basket_part->part->available??9999 }}" data-cs-count="{{ $basket_part->part->count_sale_count??null }}" data-cs-percent="{{ $basket_part->part->count_sale_percent??null }}" class="number-input" readonly="">
                                    <button class="number-btn number-input-plus">+</button>
                                    <div class="loader loader-ng"></div>
                                </div>
                            </td>
                            <td>
                                <span class="bp-sum"></span>
                                <span class="kzt"></span>
                                <span class="bp-sale" style="text-decoration:line-through;display:none">
                                    <span class="bp-sale-sum"></span>
                                    <span class="kzt"></span>
                                </span>
                            </td>
                            <td><a href="javascript:void(0)" class="text-danger delete-basket-item" data-id="{{ $basket_part->part->id }}"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="cabinet-title text-right">Итого: <span class="all-price"></span> <span class="kzt"></span> <span class="all-sale-block sale-price" style="display:none;"><span class="all-sale"></span> <span class="kzt"></span></span></div>
            <div class="text-right pt-3"><button id="order-modal-toggle" class="bauten-btn" data-toggle="modal" data-target="#order-modal" disabled>Заказать</button></div>
            <div class="text-right pt-2 text-danger small-text if-cant-shop" style="display: none">Чтобы заказать вам надо сделать покупку суммы {{ $settings->minimum->shop }} <span class="kzt"></span></div>
            @push('pageScripts') @js(aSite('js/basket.js')) @endpush
        </div>
    @endif
    <div class="h5 text-danger pt-2 not-in-stock">Корзина пуста.</div>
    @if($basket_parts_count)
        @modal(['id'=>'order-modal', 'loader'=>true,
            'saveBtn'=>'Заказать',
            'saveBtnClass'=>'btn-bauten',
            'closeBtn' => 'Отменить',
            'dialog_class' => 'modal-xl',
            'form'=>['id'=>'order-form', 'action'=>route('cabinet.order')]])
        @slot('title')Оформление заказа@endslot @csrf
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="form-name">ФИО</label>
                    <input type="text" id="form-name" class="form-control @error('name') has-error @enderror" name="name" value="{{ old('name', $user->name) }}" maxlength="255">
                    @error('name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="form-phone">Телефон</label>
                    <input type="text" id="form-phone" class="form-control @error('phone') has-error @enderror" name="phone" value="{{ old('phone', $user->phone) }}" maxlength="255">
                    @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group cabinet-select2">
                    <label for="form-delivery">Метод доставки</label>
                    <select name="delivery" id="form-delivery" class="select2" style="width: 100%;">
                        <option value="0">Самовывоз</option>
                        <option value="1" {!! ($shown_delivery = old('delivery')==1)?'selected':null !!} class="order-delivery-option">Доставка до двери</option>
                    </select>
                    @error('delivery')
                    <div><small class="text-danger">{{ $message }}</small></div>
                    @enderror
                    <div class="mb-1 if-cant-delivery" style="display: none"><small class="text-danger">Чтобы заказать с доставкой вам надо сделать покупку суммы {{ $settings->minimum->delivery }} <span class="kzt"></span></small></div>
                </div>
            </div>
            @if (count($regions))
                <div class="col-6 for-delivery" @if(!$shown_delivery) style="display:none" @endif>
                    <div class="form-group cabinet-select2">
                        <label for="form-region">Регион</label>
                        <select class="select2" id="form-region" style="width: 100%" name="region_id">
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}" @if(old('region_id')==$region->id) selected @endif>{{ $region->title }}</option>
                            @endforeach
                        </select>
                        @error('region_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-6 for-delivery" @if(!$shown_delivery) style="display:none" @endif>
                    <div class="form-group cabinet-select2">
                        <label for="form-cities">Насиленный пункт</label>
                        <select class="select2" id="form-cities" style="width: 100%" name="city_id"></select>
                        @error('delivery_point_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-6 for-delivery" @if(!$shown_delivery) style="display:none" @endif>
                    <div class="form-group cabinet-select2">
                        <label for="form-address">Адрес</label>
                        <input type="text" id="form-address" class="form-control @error('address') has-error @enderror" name="address" value="{{ old('address') }}" maxlength="255">
                        @error('address')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            @endif
            <div class="col-6">
                <div class="form-group cabinet-select2">
                    <label for="form-payment">Метод оплаты</label>
                    <select name="payment_method" id="form-payment" class="select2" style="width: 100%;">
                        <option value="bank" disabled>Банковский перевод</option>
                        <option value="cash" selected>Наличными на месте</option>
                    </select>
                    @error('payment_method')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-prices text-right">
            <div class="cabinet-title-sm text-right">Сумма: <span class="all-price"></span> <span class="kzt"></span></div>
            <div class="for-delivery" style="display:none">
                <div class="cabinet-title-sm text-right">Доставка: <span class="delivery-price"></span> <span class="kzt"></span></div>
                <div class="cabinet-title-sm text-right">Общее: <span class="full-price"></span> <span class="kzt"></span></div>
            </div>
        </div>
        @endmodal
    @endif
@endsection
@push('js')
    @js(aApp('bootstrap/js/bootstrap.js'))
    @js(aApp('select2/select2.js'))
    <script>
        var userSale = {{ $user->sale }},
            actions = {
                update: '{{ route('cabinet.basket.update') }}',
                delete: '{{ route('cabinet.basket.delete') }}',
            },
            minimums = {
                shop: {{ (($minimum_shop = $settings->minimum->shop) && is_numeric($minimum_shop) && $minimum_shop>0)?((int) $minimum_shop):0 }},
                delivery: {{ (($minimum_delivery = $settings->minimum->delivery) && is_numeric($minimum_delivery) && $minimum_delivery>0)?((int) $minimum_delivery):0 }},
            },
            csrf = '{{ csrf_token() }}',
            regions = {!! $regions->toJson(JSON_UNESCAPED_UNICODE) !!},
            deliveryPrices = {!! $delivery_prices->toJson() !!},
            hasOldInput = {!! session()->hasOldInput()?'true':'false' !!},
            oldCityId = {!! old('city_id', 0) !!};
    </script>
    @stack('pageScripts')
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
