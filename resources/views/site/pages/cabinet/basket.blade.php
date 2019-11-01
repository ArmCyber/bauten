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
        'form'=>['id'=>'order-form', 'action'=>route('cabinet.order')]])
    @slot('title')Оформление заказа@endslot @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="form-name">Имя</label>
                <input type="text" id="form-name" class="form-control @error('name') has-error @enderror" name="name" value="{{ old('name', $user->name) }}" maxlength="255">
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="form-last-name">Фамилия</label>
                <input type="text" id="form-last-name" class="form-control @error('last_name') has-error @enderror" name="last_name" value="{{ old('last_name', $user->last_name) }}" maxlength="255">
                @error('last_name')
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
        @if($user->isEntity)
            <div class="col-6">
                <div class="form-group">
                    <label for="form-company">Компания</label>
                    <input type="text" id="form-company" class="form-control @error('company') has-error @enderror" name="company" value="{{ old('company', $user->company) }}" maxlength="255">
                    @error('company')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="form-bin">БИН</label>
                    <input type="text" id="form-bin" class="form-control @error('bin') has-error @enderror" name="bin" value="{{ old('bin', $user->bin) }}" maxlength="255">
                    @error('bin')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        @endif
        <div class="col-6">
            <div class="form-group cabinet-select2">
                <label for="form-delivery">Метод доставки</label>
                <select name="delivery" id="form-delivery" class="select2" style="width: 100%;">
                    <option value="0">Самовывоз</option>
                    <option value="1">Доставка до двери</option>
                </select>
                @error('delivery')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="col-6">

        </div>
    </div>
    @endmodal
@endsection
@push('js')
    @js(aApp('bootstrap/js/bootstrap.js'))
    @js(aApp('select2/select2.js'))
    <script>
        var allPrice = {{ $allPrice??0 }},
            deleteItemUrl = '{{ route('cabinet.basket.delete') }}',
            csrf = '{{ csrf_token() }}';
        $('.select2').select2();
    </script>
    @js(aSite('js/basket.js'))
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
