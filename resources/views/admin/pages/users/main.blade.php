@extends('admin.layouts.app')
@section('content')
    @if(count($items))
        <div class="card">
            <div class="table-responsive p-2">
                <table class="table table-striped m-b-0 columns-middle init-dataTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Адрес эл.почты</th>
                        <th>Тип</th>
                        <th>Менеджер</th>
                        <th>Статус</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td>{{ $item->id }}</td>
                            <td>
                                {{ $item->email}}
                                @if($item->is_online)
                                    <sup class="online-dot">•</sup>
                                @endif
                            </td>
                            <td>{{ $item->type_name }}</td>
                            <td>
                                @if ($item->manager)
                                    <a href="{{ route('admin.admins.edit', ['id'=>$item->manager->id]) }}">{{ $item->manager->email }}</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td data-order="{{ $item->status==0?2:$item->status }}">
                                @if($item->status==\App\Models\User::STATUS_BLOCKED)
                                    <span class="text-danger">блокирован</span>
                                @elseif ($item->status==\App\Models\User::STATUS_PENDING)
                                    <span class="text-warning">ожидание</span>
                                @else
                                    <span class="text-success">активно</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.users.view', ['id'=>$item->id]) }}" {!! tooltip('Посмотреть') !!} class="icon-btn view"></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h4 class="text-danger">@lang('admin/all.empty')</h4>
    @endif
    @modal(['id'=>'itemDeleteModal', 'centered'=>true, 'loader'=>true,
        'saveBtn'=>'Удалить',
        'saveBtnClass'=>'btn-danger',
        'closeBtn' => 'Отменить',
        'form'=>['id'=>'itemDeleteForm', 'action'=>'javascript:void(0)']])
    @slot('title')Удаление профиля@endslot
    <input type="hidden" id="pdf-item-id">
    <p class="font-14">Вы действительно хотите удалить профиль &Lt;<span id="pdm-title"></span>&Gt;?</p>
    @endmodal
@endsection
@push('css')
    @css(aApp('datatables/datatables.css'))
@endpush
@push('js')
    @js(aApp('datatables/datatables.js'))
    <script>
        $('.init-dataTable').dataTable({
            "order": [[ 4, "asc" ]]
        });
    </script>
@endpush
