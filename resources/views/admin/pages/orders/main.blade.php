@extends('admin.layouts.app')
@section('content')
    @if(count($items))
        <div class="card">
            <div class="table-responsive p-2">
                <table class="table table-striped m-b-0 columns-middle init-dataTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Пользователь</th>
                        <th>ФИО</th>
                        <th>Сумма</th>
                        <th>Статус</th>
                        <th>Метод доставки</th>
                        <th>Метод оплаты</th>
                        <th>Статус оплаты</th>
                        <th>Дата</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                @php($all_total=0)
                    @foreach($items as $item)
                        @php($all_total+=$item->total )
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td>{{ $item->id }}</td>
                            @if ($item->user)
                                <td><a href="{{ route('admin.users.view', ['id' => $item->user->id]) }}">{{ $item->user->email }}</a></td>
                            @else
                                <td> - </td>
                            @endif
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->total }}</td>
                            <td>{!! $item->status_html !!}</td>
                            <td>{{ $item->delivery_method_name }}</td>
                            <td>{{ $item->payment_method_name }}</td>
                            <td>{!! $item->paid?'<span class="text-success">оплачен</span>':(($item->payment_method=='bank' && $item->paid_request)?'<span class="text-warning">ожидание подверждения</span>':'<span class="text-danger">не оплачен</span>') !!}</td>
                            <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                            <td class="d-flex align-items-center">
                                <a href="{{ route('admin.orders.view', ['id' => $item->id]) }}" class="icon-btn view" {!! tooltip('Посмотреть') !!}></a>
                                <a href="{{route('admin.orders.export',['id'=>$item->id])}}"  {!! tooltip('Экспортировать') !!} class="text-cyan ml-2"><i class="fas fa-file-export"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="item-row" data-id="{!! $item->id !!}">
                        <td></td>
                            <td>  </td>
                        <td></td>
                        <td> Итог:   {{$all_total}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="d-flex align-items-center">

                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h4 class="text-danger">@lang('admin/all.empty')</h4>
    @endif
@endsection
@push('css')
    @css(aApp('datatables/datatables.css'))
@endpush
@push('js')
    @js(aApp('datatables/datatables.js'))
    <script>
        $('.init-dataTable').dataTable({
            "order": [[ 0, "desc" ]]
        });
    </script>
@endpush
