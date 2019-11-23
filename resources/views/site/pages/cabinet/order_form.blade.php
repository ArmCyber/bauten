@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Оформление заказа</div>
    <div class="pt-3">
        <form action="{{ route('cabinet.order') }}" method="post">@csrf
            <div class="cabinet-block">
                <div class="cabinet-block-title">Личные данные покупателя</div>
                <div class="cabinet-block-content pt-2">
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
                    </div>
                </div>
            </div>
            <div class="cabinet-block">
                <div class="cabinet-block-title">Метод доставки</div>
                <div class="cabinet-block-content">
                    <div class="text-block for-pickup pb-3">{!! $texts->data->pickup !!}</div>
                    <div class="text-block for-delivery pb-3" style="display:none">{!! $texts->data->delivery !!}</div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group cabinet-select2">
                                <label for="form-delivery">Выберите метод доставки</label>
                                <select name="delivery" id="form-delivery" class="select2" style="width: 100%;">
                                    <option value="0">Самовывоз</option>
                                    <option value="1" {!! $cant_delivery?'disabled':null !!} {!! $shown_delivery?'selected':null !!} class="order-delivery-option">Доставка до двери</option>
                                </select>
                                @error('delivery')
                                <div><small class="text-danger">{{ $message }}</small></div>
                                @enderror
                                @if($cant_delivery)
                                    <div class="mb-1"><small class="text-danger">Чтобы заказать с доставкой вам надо сделать покупку суммы {{ $settings->minimum->delivery }} <span class="kzt"></span></small></div>
                                @endif
                            </div>
                        </div>
                        @if (count($pickup_points))
                            <div class="col-6 for-pickup">
                                <div class="form-group cabinet-select2">
                                    <label for="form-pickup-point">Точка самовывоза</label>
                                    <select class="select2" id="form-pickup-point" name="pickup_point_id" style="width: 100%">
                                        @foreach($pickup_points as $pickup_point)
                                            <option value="{{ $pickup_point->id }}" @if(old('pickup_point_id')==$pickup_point->id) selected @endif>{{ $pickup_point->address }}</option>
                                        @endforeach
                                    </select>
                                    @error('pickup_point_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 for-pickup">
                                <div id="map" style="width: 100%; height: 400px"></div>
                            </div>
                        @endif
                        @if (count($regions))
                            <div class="col-6 for-delivery" style="display:none">
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
                            <div class="col-6 for-delivery" style="display:none">
                                <div class="form-group cabinet-select2">
                                    <label for="form-cities">Насиленный пункт</label>
                                    <select class="select2" id="form-cities" style="width: 100%" name="city_id"></select>
                                    @error('delivery_point_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6 for-delivery" style="display:none">
                                <div class="form-group cabinet-select2">
                                    <label for="form-address">Адрес</label>
                                    <input type="text" id="form-address" class="form-control @error('address') has-error @enderror" name="address" value="{{ old('address') }}" maxlength="255">
                                    @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="cabinet-block">
                <div class="cabinet-block-title">Метод оплаты</div>
                <div class="cabinet-block-content pt-2">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group cabinet-select2">
                                <label for="form-payment">Выберите метод оплаты</label>
                                <select name="payment_method" id="form-payment" class="select2" style="width: 100%;">
                                    <option value="cash">Наличными на месте</option>
                                    <option value="bank" {{ old('payment_method')=='bank'?'selected':null }}>Банковский перевод</option>
                                </select>
                                @error('payment_method')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-prices text-right">
                <div class="cabinet-title-sm text-right">Сумма: <span class="all-price">{{ $orderData['all_sum'] }}</span> <span class="kzt"></span></div>
                <div class="for-delivery" style="display:none">
                    <div class="cabinet-title-sm text-right">Цена доставки: <span class="delivery-price"></span> <span class="kzt"></span></div>
                    <div class="cabinet-title-sm text-right">Итого: <span class="full-price"></span> <span class="kzt"></span></div>
                </div>
                <div class="pt-2">
                    <button class="bauten-btn" type="submit">Заказать</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script src="https://api-maps.yandex.ru/2.1/?apikey=2e699e9e-5f6d-489c-ab71-0a755f489101&lang=ru_RU"></script>
    @js(aApp('bootstrap/js/bootstrap.js'))
    @js(aApp('select2/select2.js'))
    <script>
        var sum = {{ $orderData['all_sum'] }},
            regions = {!! $regions->toJson(JSON_UNESCAPED_UNICODE) !!},
            deliveryPrices = {!! $delivery_prices->toJson() !!},
            hasOldInput = {!! session()->hasOldInput()?'true':'false' !!},
            oldCityId = {!! old('city_id', 0) !!},
            pickupPoints = {!! $pickup_points->mapWithKeys(function($item){
                return [(int) $item->id => ['lat'=>(float) $item->lat, 'lng'=>(float) $item->lng]];
            })->toJson() !!};
    </script>
    @js(aSite('js/order.js'))
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
