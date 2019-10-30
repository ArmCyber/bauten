@extends('site.layouts.cabinet')
@section('content')
    <div class="cabinet-title">Корзина</div>
    @if(count($basket_parts))
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
            <div class="cabinet-title text-right">Сумма: <span id="all-price">{{ $allPrice }}</span> <span class="kzt"></span></div>
            <div class="text-right pt-3"><button class="bauten-btn" data-toggle="modal" data-target="#order-modal">Заказать</button></div>
        </div>
    @endif
    <div class="h5 text-danger pt-2 not-in-stock">Корзина пуста.</div>
    @modal(['id'=>'order-modal', 'loader'=>true,
        'saveBtn'=>'Заказать',
        'saveBtnClass'=>'btn-bauten',
        'closeBtn' => 'Отменить',
        'dialog_class' => 'modal-xl',
        'form'=>['id'=>'order-form', 'action'=>'javascript:void(0)']])
    @slot('title')Оформление заказа@endslot

    @endmodal
@endsection
@push('js')
    @js(aApp('bootstrap/js/bootstrap.js'))
    <script>
        var allPrice = {{ $allPrice??0 }},
            deleteItemUrl = '{{ route('cabinet.basket.delete') }}',
            csrf = '{{ csrf_token() }}';
    </script>
    @js(aSite('js/basket.js'))
@endpush
