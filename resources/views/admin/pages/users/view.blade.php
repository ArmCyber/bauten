@extends('admin.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="view-line"><span class="view-label">REF:</span> {{ $item->ref??'(не назначен)' }} @can('manager')  <a href="javascript:void(0)" class="icon-btn edit" data-toggle="modal" data-target="#editRefModal"></a> @endcan</div>
            <div class="view-line"><span class="view-label">ФИО:</span> {{ $item->name??'-' }}</div>
{{--            <div class="view-line"><span class="view-label">Фамилия:</span> {{ $item->last_name??'-' }}</div>--}}
            <div class="view-line"><span class="view-label">Эл.почта:</span> {{ $item->email }} @if($item->verification) <span class="text-danger">(не подтверждена)</span> @else <span class="text-success">(подтверждена)</span> @endif</div>
            @if(Gate::check('admin'))
                <div class="view-line"><span class="view-label">Менеджер:</span> @if($item->manager) <a href="{{ route('admin.admins.edit', ['id'=>$item->manager->id]) }}">{{ $item->manager->email }}</a> @else не привязан @endif <a href="javascript:void(0)" class="icon-btn edit" data-id="{{ $item->manager->id??'0' }}" data-toggle="modal" data-target="#changeManagerModal"></a></div>
            @else
                <div class="view-line"><span class="view-label">Менеджер:</span> @if($item->manager) {{ $item->manager->email }} @else не привязан @endif</div>
            @endif
            @if($item->individual_sale)
                <div class="view-line"><span class="view-label">Индивидуальная скидка:</span> {{ $item->individual_sale }}% <a href="javascript:void(0)" class="icon-btn edit" data-toggle="modal" data-target="#changePartnerGroupModal"></a></div>
            @else
                <div class="view-line"><span class="view-label">Группа партнеров:</span> {{ $item->partner_group->title }} ({{ $item->partner_group->sale }}%) <a href="javascript:void(0)" class="icon-btn edit" data-toggle="modal" data-target="#changePartnerGroupModal"></a></div>
            @endif
            <div class="view-line"><span class="view-label">Последный вход:</span> {{ $item->logged_in_at?$item->logged_in_at->format('d.m.Y H:i'):'никогда' }}</div>
            <div class="view-line"><span class="view-label">Последнее действие:</span> {{ $item->seen_at?$item->seen_at->format('d.m.Y H:i'):'никогда' }} @if($item->is_online) <span class="text-success">(в сети)</span> @else <span class="text-danger">(не в сети)</span> @endif</div>
            <div class="view-line"><span class="view-label">Тип:</span> {{ $item->type_name }}</div>
            @if ($item->type==\App\Models\User::TYPE_ENTITY)
                <div class="view-line"><span class="view-label">Компания:</span> {{ $item->company }}</div>
                <div class="view-line"><span class="view-label">Бин:</span> {{ $item->bin }}</div>
            @endif
            <div class="view-line"><span class="view-label">Регион:</span> {{ $item->region??'-' }}</div>
            <div class="view-line"><span class="view-label">Город:</span> {{ $item->city??'-' }}</div>
            <div class="view-line"><span class="view-label">Телефон:</span> {{ $item->phone??'-' }}</div>
            <div class="view-line"><span class="view-label">Дата регистрации:</span> {{ $item->created_at->format('d.m.Y H:i') }}</div>
            <div class="view-line"><span class="view-label">Статус:</span> {{ $item->status_name }}</div>
            @can('manager')
            <div class="view-line"><a href="javascript:void(0)" data-toggle="modal" data-target="#passwordResetModal">Сбросить пароль</a></div>
            @endcan
            <div class="view-line"><a href="{{ route('admin.users.favourites', ['id'=>$item->id]) }}">Посмотреть сохраненные товары ({{ count($item->all_favourites) }})</a></div>
            <div class="view-line"><a href="{{ route('admin.users.basket_parts', ['id'=>$item->id]) }}">Посмотреть товары в корзине ({{ count($basket_parts) }})</a></div>
            <div class="view-line"><a href="{{ route('admin.applications.user', ['id'=>$item->id]) }}">Посмотреть заявки ({{ count($applications) }})</a></div>
            <div class="view-line"><a href="{{ route('admin.price_applications.user', ['id'=>$item->id]) }}">Посмотреть уточнении цены ({{ count($price_applications) }})</a></div>
            @can('manager')
            <div class="pt-2">
                @if($item->status!=\App\Models\User::STATUS_BLOCKED)
                    <button class="btn btn-danger mr-1" data-toggle="modal" data-target="#blockUserModal">Блокировать</button>
                    @push('modals')
                        @modal(['id'=>'blockUserModal', 'centered'=>true,
                            'saveBtn'=>'Блокировать',
                            'saveBtnClass'=>'btn-danger',
                            'closeBtn' => 'Отменить',
                            'form'=>['method'=>'post','action'=>route('admin.users.change_status')]])
                            @slot('title')Блокировка пользователя@endslot
                            <input type="hidden" name="status" value="0">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            @csrf @method('patch')
                            <p class="font-14">Вы действительно хотите блокировать пользователя?</p>
                        @endmodal
                    @endpush
                @endif
                @if ($item->status!=\App\Models\User::STATUS_ACTIVE)
                    <button class="btn btn-success" data-toggle="modal" data-target="#unblockUserModal">{{ ($is_pending = $item->status==\App\Models\User::STATUS_PENDING)?'Активировать':'Разблокировать' }}</button>
                        @push('modals')
                            @modal(['id'=>'unblockUserModal', 'centered'=>true,
                                'saveBtn'=>$is_pending?'Активировать':'Разблокировать',
                                'closeBtn' => 'Отменить',
                                'form'=>['method'=>'post','action'=>route('admin.users.change_status')]])
                            @slot('title'){{ $is_pending?'Активирование профиля':'Разблокирование пользователя' }}@endslot
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            @csrf @method('patch')
                            <p class="font-14">Вы действительно хотите {{ $is_pending?'активировать профиль':'разблокировать пользователя' }}?</p>
                            @endmodal
                        @endpush
                @endif
            </div>
            @endcan
            <div class="pt-4">
                <div class="h4">Заказы пользователя</div>
                <div class="py-2">
                    @if(!$order_counts['all'])
                        <div class="h5 text-danger">У пользователя нет заказов</div>
                    @else
                        @if($order_counts[2])
                            <div class="view-line"><a href="{{ route('admin.orders.user', ['id'=>$item->id, 'status'=>$statuses[2]]) }}">Выполненные заказы ({{ $order_counts[2] }})</a></div>
                        @endif
                        @if($order_counts[1])
                            <div class="view-line"><a href="{{ route('admin.orders.user', ['id'=>$item->id, 'status'=>$statuses[1]]) }}">Невыполненные заказы ({{ $order_counts[1] }})</a></div>
                        @endif
                        @if($order_counts[0])
                            <div class="view-line"><a href="{{ route('admin.orders.user', ['id'=>$item->id, 'status'=>$statuses[0]]) }}">Новые заказы ({{ $order_counts[0] }})</a></div>
                        @endif
                        @if($order_counts[-1])
                            <div class="view-line"><a href="{{ route('admin.orders.user', ['id'=>$item->id, 'status'=>$statuses[-1]]) }}">Откланенные заказы ({{ $order_counts[-1] }})</a></div>
                        @endif
                    @endif
                </div>
            </div>
            @can('admin')
            <div class="pt-5"><button class="btn btn-outline-danger mr-1" data-toggle="modal" data-target="#deleteUserModal">УДАЛИТЬ ПРОФИЛЬ НАВСЕГДА</button></div>
            @endcan
        </div>
    </div>
    @stack('modals')
    @modal(['can'=>'admin', 'id'=>'changeManagerModal', 'saveBtn'=>'Сохранить', 'closeBtn' => 'Отменить', 'centered'=>true,
        'form'=>['method'=>'post','action'=>route('admin.users.change_manager')]])
        @slot('title')Изменение менеджера@endslot
        <input type="hidden" name="id" value="{{ $item->id }}">
        @csrf @method('patch')
        <select id="managerIdSelect" name="manager_id" class="select2" style="width: 100%">
            <option value="">Не подключить</option>
            @foreach($managers as $manager)
                <option value="{{ $manager->id }}" {!! $manager->id==$item->manager_id?'selected':null !!}>{{ $manager->email.($manager->code?'('.$manager->code.')':null) }}</option>
            @endforeach
        </select>
    @endmodal
    @modal(['id'=>'changePartnerGroupModal', 'saveBtn'=>'Сохранить', 'closeBtn' => 'Отменить', 'centered'=>true,
        'form'=>['method'=>'post','action'=>route('admin.users.change_partner_group')]])
        @slot('title')Изменение группы партнеров@endslot
        <input type="hidden" name="id" value="{{ $item->id }}">
        @csrf @method('patch')
        <select id="partnerGroupIdSelect" name="partner_group_id" class="select2" style="width: 100%">
            <option value="0">Индивидуальная скидка</option>
            @foreach($partner_groups as $partner_group)
                <option value="{{ $partner_group->id }}" {!! (!$item->individual_sale && $partner_group->id==$item->partner_group_id)?'selected':null !!}>{{ $partner_group->title }} ({{ $partner_group->sale }}%)</option>
            @endforeach
        </select>
        <div class="only-for-individual" @if(!$item->individual_sale) style="display:none" @endif>
            <input type="text" name="individual_sale" class="form-control my-2" placeholder="Процент скидки (1-99)" maxlength="3" value="{{ $item->individual_sale!=0?$item->individual_sale:null }}">
        </div>
        <div class="pt-3"><label><input type="checkbox" style="width:20px; height:20px; vertical-align: text-top" value="1" name="notify" checked> Отправить оповищение пользователю</label></div>
    @endmodal
    @modal(['can'=>'admin', 'id'=>'passwordResetModal', 'saveBtn'=>'Сохранить', 'closeBtn' => 'Отменить', 'centered'=>true,
        'form'=>['method'=>'post','action'=>route('admin.users.change_password')]])
        @slot('title')Сброс пароля@endslot
        <input type="hidden" name="id" value="{{ $item->id }}">
        @csrf @method('patch')
        <div class="card">
            <div class="c-title">Новый пароль</div>
            <div class="little-p">
                <input type="text" name="password" class="form-control" placeholder="Новый пароль" maxlength="255" required minlength="8">
            </div>
        </div>
    @endmodal
    @modal(['can'=>'admin', 'id'=>'deleteUserModal', 'saveBtn'=>'УДАЛИТЬ НАВСЕГДА', 'saveBtnClass'=>'btn-danger', 'closeBtn' => 'Отменить', 'centered'=>true,
    'form'=>['method'=>'post','action'=>route('admin.users.delete')]])
        @slot('title')<span class="text-danger font-weight-bold">УДАЛЕНИЕ ПРОФИЛЯ</span>@endslot
        <input type="hidden" name="id" value="{{ $item->id }}">
        @csrf @method('delete')
        <p>Вы дейстительно хотите <span class="text-danger font-weight-bold">УДАЛИТЬ ПРОФИЛЬ НАВСЕГДА</span>?</p>
    @endmodal
    @modal(['can'=>'manager', 'id'=>'editRefModal', 'saveBtn'=>'Сохранить', 'saveBtnClass'=>'btn-success', 'closeBtn' => 'Отменить', 'centered'=>true,
    'form'=>['method'=>'post','action'=>route('admin.users.edit_ref')]])
    @slot('title')REF пользователя@endslot
    <input type="hidden" name="id" value="{{ $item->id }}">
    @csrf @method('patch')
    <div class="card">
        <div class="c-title">REF</div>
        <div class="little-p">
            <input type="text" name="ref" value="{{ old('ref', $item->ref) }}" class="form-control" placeholder="REF" maxlength="255">
        </div>
    </div>
    @endmodal
@endsection
@push('js')
    @js(aApp('select2/select2.js'))
    <script>
        $('#partnerGroupIdSelect').on('change', function(){
            if ($(this).val()==='0'){
                $('.only-for-individual').show();
            }
            else {
                $('.only-for-individual').hide();
            }
        });
        $('.select2').select2();
    </script>
@endpush
@push('css')
    @css(aApp('select2/select2.css'))
@endpush
