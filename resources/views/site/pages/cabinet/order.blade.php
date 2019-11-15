@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Заказ N{{ $item->id }}</div>
    <div class="cabinet-block">
        <div class="cabinet-block-content">
            <div class="cabinet-block-info">ФИО: <b>{{ $item->name }}</b></div>
            <div class="cabinet-block-info">Телефон: <b>{{ $item->phone }}</b></div>
            <div class="cabinet-block-info">Дата: <b>{{ $item->created_at->format('d.m.Y H:i') }}</b></div>
            <div class="cabinet-block-info">Метод доставки: <b>{{ $item->delivery?'Доставка до двери':'Самовывоз' }}</b></div>
            @if($item->delivery)
                <div class="cabinet-block-info">Регион: <b>{{ $item->region_name }}</b></div>
                <div class="cabinet-block-info">Насиленный пункт: <b>{{ $item->city_name }}</b></div>
                <div class="cabinet-block-info">Адрес: <b>{{ $item->address }}</b></div>
            @endif
            <div class="cabinet-block-info">Сумма: <b>{{ $item->total }} <span class="kzt"></span></b></div>
            <div class="cabinet-block-info">Статус: <b>{!! $item->status_site_html !!}</b></div>
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
                <div class="cabinet-title-sm">Сумма: {{ $item->sum }} <span class="kzt"></span> @if($item->sum!=$item->real_sum)<span class="sale-price-sm">{{ $item->real_sum }} <span class="kzt"></span></span>@endif</div>
                @if($item->delivery)
                    <div class="cabinet-title-sm">Цена доставки: {{ $item->delivery_price }} <span class="kzt"></span></div>
                    <div class="cabinet-title-sm">Итого: {{ $item->total }} <span class="kzt"></span></div>
                @endif
            </div>
        </div>
    </div>
@endsection
