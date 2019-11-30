@extends('admin.layouts.app')
@section('content')
    @if(count($items))
        <div class="card">
            <div class="table-responsive p-2">
                <table class="table table-striped m-b-0 columns-middle init-dataTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Артикул запчаста</th>
                        <th>Название запчаста</th>
                        <th>Пользователь</th>
                        <th>ФИО</th>
                        <th>Дата</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->part_code }}</td>
                            <td>{{ $item->part_name }}</td>
                            @if ($item->user)
                                <td><a href="{{ route('admin.users.view', ['id' => $item->user->id]) }}">{{ $item->user->email }}</a></td>
                            @else
                                <td> - </td>
                            @endif
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->created_at->format('d.m.Y H:i') }}</td>
                            <td><a href="{{ route('admin.price_applications.view', ['id' => $item->id]) }}" class="icon-btn view" {!! tooltip('Посмотреть') !!}></a></td>
                        </tr>
                    @endforeach
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
