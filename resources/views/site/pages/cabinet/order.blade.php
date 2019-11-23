@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Заказ N{{ $item->id }}</div>
    <div class="cabinet-block-info border-0">Статус: <b>{!! $item->status_site_html !!}</b></div>
    @if($item->payment_method=='bank' && $item->paid==0)
        <div class="cabinet-block">
            <div class="bank-container">
                <div class="cabinet-block-title">Счет на оплату</div>
                <div class="cabinet-block-content">
                    <p>Номер заказа: <b>N{{ $item->id }}</b></p>
                    <p>Дата заказа: <b>{{ $item->created_at->format('d.m.Y H:i') }}</b></p>
                    <p>Стоимость заказа: <b>{{ $item->total }} <span class="kzt"></span></b></p>
                    {!! $texts->data->bank_text !!}
                    <div class="no-print">
                        <div class="mt-2"><button class="btn btn-bauten print-bank">Распечатать</button></div>
                        <div class="mt-2">
                            @if($item->paid_request==0)
                                <form action="{{ route('cabinet.order.confirm_payment') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $item->id }}">
                                    <button type="submit" class="bauten-btn">Оплачен</button>
                                </form>
                            @else
                                <b class="text-warning">Ожидание подверждения платежа.</b>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('js')
            @js(aSite('assets/print/print.js'))
            <script>
                $('.print-bank').on('click', function(){
                    $('.bank-container').print({
                        globalStyles: true,
                        noPrintSelector: '.no-print',
                        mediaPrint: true
                    });
                });
            </script>
        @endpush
    @endif
    <div class="cabinet-block">
        <div class="cabinet-block-content">
            <div class="cabinet-block-info">ФИО: <b>{{ $item->name }}</b></div>
            <div class="cabinet-block-info">Телефон: <b>{{ $item->phone }}</b></div>
            <div class="cabinet-block-info">Дата: <b>{{ $item->created_at->format('d.m.Y H:i') }}</b></div>
            <div class="cabinet-block-info">Метод оплаты: <b>{{ $item->payment_method_name }}</b></div>
            <div class="cabinet-block-info">Сумма: <b>{{ $item->total }} <span class="kzt"></span></b></div>
            <div class="cabinet-block-info">Метод доставки: <b>{{ $item->delivery_method_name }}</b></div>
            @if($item->delivery)
                <div class="cabinet-block-info">Регион: <b>{{ $item->region_name }}</b></div>
                <div class="cabinet-block-info">Насиленный пункт: <b>{{ $item->city_name }}</b></div>
                <div class="cabinet-block-info">Адрес: <b>{{ $item->address }}</b></div>
            @else
                <div class="cabinet-block-info">Адрес точки самовывоза: <b>{{ $item->pickup_point_address }}</b></div>
                @if ($item->pickup_point)
                    <div id="map" style="width:100%;height:250px"></div>
                    @push('js')
                        <script src="https://api-maps.yandex.ru/2.1/?apikey=2e699e9e-5f6d-489c-ab71-0a755f489101&lang=ru_RU"></script>
                        <script>
                            ymaps.ready(init);
                            function init(){
                                var myMap = new window.ymaps.Map("map", {
                                    center: [{{ $item->pickup_point->lat }}, {{ $item->pickup_point->lng }}],
                                    zoom: 14,
                                });
                                var placemark = new ymaps.Placemark([{{ $item->pickup_point->lat }}, {{ $item->pickup_point->lng }}]);
                                myMap.geoObjects.add(placemark);
                            }
                        </script>
                    @endpush
                @endif
            @endif
        </div>
    </div>
    @if($item->status_type=='pending' || $item->status_type=='done')
        <div class="cabinet-block">
            <div class="cabinet-block-title">Процесс</div>
            <div class="cabinet-block-content">
                @foreach($process as $process_key => $process_name)
                    <div class="cabinet-block-info">{!! $process_key<=$item->process?'<i class="text-success fas fa-check-circle"></i>':'<i class="text-danger fas fa-times-circle"></i>' !!} {{ $process_name }}</div>
                @endforeach
                <div class="cabinet-block-info">
                    {!! $item->paid?'<i class="text-success fas fa-check-circle"></i>':'<i class="text-danger fas fa-times-circle"></i>' !!} Оплачен
                </div>
            </div>
        </div>
    @endif
    <div class="cabinet-block">
        <div class="cabinet-block-title">Запчасти</div>
        <div class="cabinet-block-content">
            <div class="pt-2">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Артикул</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Кол-во</th>
                        <th>Сумма</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($item->parts as $part)
                        <tr>
                            <td>{{ $part->pivot->code }}</td>
                            <td>{{ $part->pivot->name }}</td>
                            <td>
                                {{ $part->pivot->price }} <span class="kzt"></span>
                                @if($part->pivot->real_price)
                                    <span style="text-decoration: line-through">{{ $part->pivot->real_price }} <span class="kzt"></span></span>
                                @endif
                            </td>
                            <td>{{ $part->pivot->count }}</td>
                            <td>
                                {{ $part->pivot->sum }} <span class="kzt"></span>
                                @if($part->pivot->sum != $part->pivot->price*$part->pivot->count)
                                    <span class="bp-sale" style="text-decoration:line-through;">
                                    {{ $part->pivot->price*$part->pivot->count }} <span class="kzt"></span>
                                </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="cabinet-title-sm">Сумма: @if($item->sum!=$item->real_sum)<span class="sale-price-sm">{{ $item->real_sum }} <span class="kzt"></span></span>@endif {{ $item->sum }} <span class="kzt"></span></div>
                @if($item->delivery)
                    <div class="cabinet-title-sm">Цена доставки: {{ $item->delivery_price }} <span class="kzt"></span></div>
                    <div class="cabinet-title-sm">Итого: {{ $item->total }} <span class="kzt"></span></div>
                @endif
            </div>
        </div>
    </div>
@endsection
