@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">{{ $page_title }}</div>
    @if(count($orders))
        <div class="pt-2 orders-table-container">
            <table class="table table-striped orders-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Сумма</th>
                        <th>Дата</th>
                        <th>Статус</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>N{{ $order->id }}</td>
                            <td>{{ $order->total }} <span class="kzt"></span></td>
                            <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                            <td>{!! $order->status_site_html  !!}</td>
                            <td><a href="{{ route('cabinet.orders.view', ['id'=>$order->id]) }}" class="text-danger color-bauten">Подробнее</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="h5 text-danger pt-2">{{ $empty_text }}</div>
    @endif
@endsection
