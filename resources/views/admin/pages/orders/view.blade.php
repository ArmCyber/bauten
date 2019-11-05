@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            @if ($item->user)
                <div class="view-line"><span class="view-label">Пользователь:</span> <a href="{{ route('admin.users.view', ['id' => $item->user->id]) }}">{{ $item->user->email }}</a></div>
            @endif
            <div class="view-line"><span class="view-label">ФИО:</span> {{ $item->name??'-' }}</div>
            <div class="view-line"><span class="view-label">Телефон:</span> {{ $item->phone??'-' }}</div>
            <div class="view-line"><span class="view-label">Дата:</span> {{ $item->created_at->format('d.m.Y H:i')??'-' }}</div>
            <div class="view-line"><span class="view-label">Доставка:</span> {{ $item->delivery?'да':'нет' }}</div>
            @if($item->delivery)
                    <div class="view-line"><span class="view-label">Регион:</span> {{ $item->region_name }}</div>
                    <div class="view-line"><span class="view-label">Город:</span> {{ $item->city_name }}</div>
                    <div class="view-line"><span class="view-label">Адрес:</span> {{ $item->address }}</div>
                    <div class="view-line"><span class="view-label">Цена доставки:</span> {{ $item->delivery_price }}</div>
            @endif
            <div class="view-line"><span class="view-label">Скидка:</span> {{ $item->sale }}%</div>
            <div class="view-line"><span class="view-label">Общая сумма (со скидкой):</span> {{ $item->total }}</div>
            <div class="view-line"><span class="view-label">Статус:</span> {{ $item->status_name }}</div>
            <div class="pt-5">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Кол</th>
                        <th>Цена</th>
                        <th>Цена со скидкой</th>
                        <th>Обшая цена</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $sum = 0; @endphp
                    @foreach($item->order_parts as $part)
                        @php $sum+= $part->real_price * $part->count @endphp
                        <tr>
                            <td>
                                @if($part->part)
                                    <a href="{{ route('admin.parts.edit', ['id'=>$part->part->id]) }}">{{ $part->name }}</a>
                                @else
                                    {{ $part->name }}
                                @endif
                            </td>
                            <td>{{ $part->count }}</td>
                            <td>{{ $part->real_price }}</td>
                            <td>{{ $part->price }}</td>
                            <td>{{ $part->price * $part->count }}</td>
                        </tr>
                    @endforeach
                    <tr class="font-weight-bold">
                        <td>Сумма без скидки</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $sum }}</td>
                    </tr>
                    @if($item->delivery)
                        <tr class="font-weight-bold">
                            <td>Цена доставки</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $item->delivery_price }}</td>
                        </tr>
                    @endif
                    <tr class="font-weight-bold">
                        <td>Общая сумма (со скидкой)</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>{{ $item->total }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>


            <div class="pt-5"><button class="btn btn-outline-danger mr-1" data-toggle="modal" data-target="#deleteUserModal">Удалить заказ</button></div>
        </div>
    </div>
    @modal(['id'=>'deleteUserModal', 'saveBtn'=>'УДАЛИТЬ НАВСЕГДА', 'saveBtnClass'=>'btn-danger', 'closeBtn' => 'Отменить', 'centered'=>true,
    'form'=>['method'=>'post','action'=>route('admin.orders.delete')]])
        @slot('title')<span class="text-danger font-weight-bold">УДАЛЕНИЕ ЗАКАЗА</span>@endslot
        <input type="hidden" name="id" value="{{ $item->id }}">
        @csrf @method('delete')
        <p>Вы дейстительно хотите <span class="text-danger font-weight-bold">УДАЛИТЬ ЗАКАЗ НАВСЕГДА</span>?</p>
    @endmodal
@endsection
{{--@push('js')--}}
{{--    @js(aApp('select2/select2.js'))--}}
{{--    <script>--}}
{{--        $('.select2').select2();--}}
{{--    </script>--}}
{{--@endpush--}}
{{--@push('css')--}}
{{--    @css(aApp('select2/select2.css'))--}}
{{--@endpush--}}
