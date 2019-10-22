@extends('admin.layouts.app')
@section('titleSuffix')| <a href="{!! route('admin.partner_groups.add') !!}" class="text-cyan"><i class="mdi mdi-plus-box"></i> добавить</a>@endsection
@section('content')
    @if(count($items))
        <div class="card">
            <div class="table-responsive p-2">
                <table class="table table-striped m-b-0 columns-middle init-dataTable">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Скидка</th>
                        <th>Кол. пользователей</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td class="item-title">{{ $item->title}}</td>
                            <td>{{ $item->sale}}%</td>
                            <td>{{ $item->users_count }}</td>
                            <td>
                                <a href="{{ route('admin.partner_groups.edit', ['id'=>$item->id]) }}" {!! tooltip('Редактировать') !!} class="icon-btn edit"></a>
                                @if($item->id!=1)
                                    <span class="d-inline-block"  style="margin-left:4px;" data-toggle="modal" data-target="#itemDeleteModal" data-move="{{ $item->users_count!=0?'1':'0' }}"><a href="javascript:void(0)" class="icon-btn delete" {!! tooltip('Удалить') !!}></a></span>
                                @endif
                            </td>
                        </tr>
                        @push('move_select')
                            <option value="{{ $item->id }}">{{ $item->title }}({{ $item->sale }}%)</option>
                        @endpush
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
        'form'=>['id'=>'itemDeleteForm', 'action'=>route('admin.partner_groups.delete')]]) @csrf @method('delete')
    @slot('title')Удаление группы партнеров@endslot
    <input type="hidden" id="pdf-item-id" name="id">
    <p class="font-14">Вы действительно хотите удалить группу партнеров &Lt;<span id="pdm-title"></span>&Gt;?</p>
    <div id="move-select-container" class="pt-3">
        <p class="font-14">Новая группа пользователей.</p>
        <div>
            <select name="move" class="select2" id="move-select" style="width:100%">
                @stack('move_select')
            </select>
        </div>
    </div>
    @endmodal
@endsection
@push('css')
    @css(aApp('datatables/datatables.css'))
    @css(aApp('select2/select2.css'))
@endpush
@push('js')
    @js(aApp('datatables/datatables.js'))
    @js(aApp('select2/select2.js'))
    <script>
        var itemId = $('#pdf-item-id'),
            modalTitle = $('#pdm-title'),
            blocked = false,
            modal = $('#itemDeleteModal'),
            moveSelectContainer = $('#move-select-container'),
            moveSelect = $('#move-select'),
        loader = modal.find('.modal-loader');
        function modalError() {
            loader.removeClass('shown');
            blocked = false;
            toastr.error('Возникла проблема!');
            modal.modal('hide');
        }
        modal.on('show.bs.modal', function(e){
            if (blocked) return false;
            var $this = $(this),
                button = $(e.relatedTarget),
                thisItemRow = button.parents('.item-row'),
                thisId = thisItemRow.data('id');
            itemId.val(thisId);
            modalTitle.html(thisItemRow.find('.item-title').html());
            if(parseInt(button.data('move'))===0) {
                moveSelectContainer.hide();
            }
            else {
                moveSelectContainer.show();
                moveSelect.find('option:disabled').removeAttr('disabled');
                moveSelect.find('option[value="'+thisId+'"]').attr('disabled', 'disabled');
                moveSelect.val(1).trigger('change');
            }

        }).on('hide.bs.modal', function(e){
            if (blocked) return false;
        });
        $('.init-dataTable').dataTable({
            "order": [[ 1, "asc" ]]
        });
        $('.select2').select2();
    </script>
@endpush
