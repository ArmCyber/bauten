@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Корзина</div>
    @if($basket_parts_count = count($basket_parts))
        <div class="basket-table pt-2 not-in-stock-hidden">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Название</th>
                        <th>Количество</th>
                        <th>Общая цена со скидкой</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $allPrice = 0;
                    @endphp
                    @foreach($basket_parts as $basket_part)
                        @php
                            $thisPrice = $basket_part->part->price_sale*$basket_part->count;
                            $allPrice+=$thisPrice;
                        @endphp
                        <tr>
                            <td><a href="{{ route('part', ['url'=>$basket_part->part->url]) }}" class="link-bauten">{{ $basket_part->part->name }}</a></td>
                            <td>{{ $basket_part->count }} шт.</td>
                            <td>{{ $thisPrice }} <span class="kzt"></span></td>
                            <td><a href="javascript:void(0)" class="text-danger delete-basket-item" data-id="{{ $basket_part->part->id }}" data-price="{{ $thisPrice }}"><i class="fas fa-trash-alt"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="cabinet-title text-right">Сумма: <span class="all-price">{{ $allPrice }}</span> <span class="kzt"></span></div>
            <div class="text-right pt-3"><button class="bauten-btn" data-toggle="modal" data-target="#order-modal">Заказать</button></div>
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
{{--            <div class="col-6">--}}
{{--                <div class="form-group">--}}
{{--                    <label for="form-last-name">Фамилия</label>--}}
{{--                    <input type="text" id="form-last-name" class="form-control @error('last_name') has-error @enderror" name="last_name" value="{{ old('last_name', $user->last_name) }}" maxlength="255">--}}
{{--                    @error('last_name')--}}
{{--                    <small class="text-danger">{{ $message }}</small>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            </div>--}}
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
                        <option value="1" {!! ($shown_delivery = old('delivery')==1)?'selected':null !!}>Доставка до двери</option>
                    </select>
                    @error('delivery')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            @if (count($regions))
                <div class="col-6 for-delivery" @if(!$shown_delivery) style="display:none" @endif>
                    <div class="form-group cabinet-select2">
                        <label for="form-region">Регион</label>
                        <select class="select2" id="form-region" style="width: 100%" name="region_id">
                            @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->title }}</option>
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
                        <select class="select2" id="form-cities" style="width: 100%" name="city_id">
                            @foreach($regions[0]->cities as $city)
                                <option value="{{ $city->id }}">{{ $city->title }}</option>
                            @endforeach
                        </select>
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
                        <option value="online" disabled>Онлайн оплата</option>
                        <option value="cash" selected>Наличными на месте</option>
                    </select>
                    @error('payment_method')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        </div>
        <div class="modal-prices text-right">
            <div class="cabinet-title-sm text-right">Сумма: <span class="all-price">{{ $allPrice }}</span> <span class="kzt"></span></div>
            <div class="for-delivery" @if(!$shown_delivery) style="display:none" @endif>
                <div class="cabinet-title-sm text-right">Доставка: <span class="delivery-price">{{ $delivery_price = ($regions[0]->cities[0]->price??0) }}</span> <span class="kzt"></span></div>
                <div class="cabinet-title-sm text-right">Общее: <span class="full-price">{{ $delivery_price + $allPrice }}</span> <span class="kzt"></span></div>
            </div>
        </div>
        @endmodal
    @endif
@endsection
@push('js')
    @js(aApp('bootstrap/js/bootstrap.js'))
    @js(aApp('select2/select2.js'))
    <script>
        var allPrice = {{ $allPrice??0 }},
            deleteItemUrl = '{{ route('cabinet.basket.delete') }}',
            csrf = '{{ csrf_token() }}',
            regions = {!! $regions->toJson(JSON_UNESCAPED_UNICODE) !!},
            deliveryPrices = {!! $delivery_prices->toJson() !!};
        $('.select2').select2();
        @if (session()->hasOldInput())
            $('#order-modal').modal('show');
        @endif
    </script>
    @js(aSite('js/basket.js'))
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
