@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            @if ($item->user)
                <div class="view-line"><span class="view-label">Пользователь:</span> <a href="{{ route('admin.users.view', ['id' => $item->user->id]) }}">{{ $item->user->email }}</a></div>
            @endif
            <div class="view-line"><span class="view-label">Дата:</span> {{ $item->created_at->format('d.m.Y H:i')??'-' }}</div>
            <div class="view-line"><span class="view-label">ФИО:</span> {{ $item->name??'-' }}</div>
            <div class="view-line"><span class="view-label">Телефон:</span> {{ $item->phone??'-' }}</div>
            <div class="view-line"><span class="view-label">Регион:</span> {{ $item->region??'-' }}</div>
            <div class="view-line"><span class="view-label">Город:</span> {{ $item->city??'-' }}</div>
            @if($item->part && Gate::check('admin'))
                <div class="view-line"><span class="view-label">Артикул запчаста:</span> <a href="{{ route('admin.parts.edit', ['id'=>$item->part->id]) }}">{{ $item->part_code }}</a></div>
                <div class="view-line"><span class="view-label">Название запчаста:</span> <a href="{{ route('admin.parts.edit', ['id'=>$item->part->id]) }}">{{ $item->part_name }}</a></div>
            @else
                <div class="view-line"><span class="view-label">Артикул запчаста:</span> {{ $item->part_code }}</div>
                <div class="view-line"><span class="view-label">Название запчаста:</span> {{ $item->part_name }}</div>
            @endif
            <div class="view-line"><span class="view-label">Цена:</span> {{ $item->price }} @if($item->real_price) <del>{{ $item->real_price }}</del> @endif</div>
            <div class="view-line"><span class="view-label">Сумма:</span> {{ $item->sum }} @if($item->real_sum != $item->sum) <del>{{ $item->real_sum }}</del> @endif</div>
            @can('admin')
                <div class="pt-3"><button class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal">Удалить заявку</button></div>
            @endcan
        </div>
    </div>
    @modal(['can'=>'admin', 'id'=>'deleteUserModal', 'saveBtn'=>'Удалить', 'saveBtnClass'=>'btn-danger', 'closeBtn' => 'Отменить', 'centered'=>true,
               'form'=>['method'=>'post','action'=>route('admin.applications.delete')]])
    @slot('title')Удаление заявки@endslot
    <input type="hidden" name="id" value="{{ $item->id }}">
    @csrf @method('delete')
    <p>Вы дейстительно хотите удалить заявку N{{ $item->id }}?</p>
    @endmodal
@endsection
