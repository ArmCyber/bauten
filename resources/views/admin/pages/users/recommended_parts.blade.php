@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Прикрепление запчаста'])
                <form action="{{ route('admin.users.recommended_parts.add', ['id'=>$user->id]) }}" method="post">@csrf @method('put')
                    @error('code')
                    <div class="mb-2 text-danger">{{ $message }}</div>
                    @enderror
                    <div>
                        <input type="text" name="code" class="form-control" placeholder="Артикул" maxlength="255" value="{{ old('code') }}">
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-success" type="submit">Прикреплять</button>
                    </div>
                </form>
            @endcard
        </div>
    </div>
    @if(count($items))
        <div class="card">
            <div class="table-responsive p-2">
                <table class="table table-striped m-b-0 columns-middle init-dataTable">
                    <thead>
                    <tr>
                        <th>Артикул</th>
                        <th>Название</th>
                        <th>Статус запчаста</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td>{{ $item->code }}</td>
                            <td>{{ $item->name }}</td>
                            @if($item->active)
                                <td class="text-success">Активно</td>
                            @else
                                <td class="text-danger">Неактивно</td>
                            @endif
                            <td>
                                <span class="d-inline-block"  style="margin-left:4px;" data-toggle="modal" data-target="#itemDeleteModal"><a href="javascript:void(0)" class="icon-btn delete" {!! tooltip('Открепить') !!}></a></span>
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
        'saveBtn'=>'Открепить',
        'saveBtnClass'=>'btn-danger',
        'closeBtn' => 'Отменить',
        'form'=>['id'=>'itemDeleteForm', 'action'=>'javascript:void(0)']])
    @slot('title')Удаление запчаста@endslot
    <input type="hidden" id="pdf-item-id">
    <p class="font-14">Вы действительно хотите открепить запчаст?</p>
    @endmodal
@endsection
@push('css')
    @css(aApp('datatables/datatables.css'))
@endpush
@push('js')
    @js(aApp('datatables/datatables.js'))
    <script>
        var itemId = $('#pdf-item-id'),
            modalTitle = $('#pdm-title'),
            blocked = false,
            modal = $('#itemDeleteModal');
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
                thisItemRow = button.parents('.item-row');
            itemId.val(thisItemRow.data('id'));
            modalTitle.html(thisItemRow.find('.item-title').html());

        }).on('hide.bs.modal', function(e){
            if (blocked) return false;
        });
        $('#itemDeleteForm').on('submit', function(){
            if (blocked) return false;
            blocked = true;
            var thisItemId = itemId.val();
            if (thisItemId && thisItemId.match(/^[1-9][0-9]{0,9}$/)) {
                loader.addClass('shown');
                $.ajax({
                    url: '{!! route('admin.users.recommended_parts.delete', ['id'=>$user->id]) !!}',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        _token: csrf,
                        _method: 'delete',
                        item_id: thisItemId,
                    },
                    error: function(e){
                        modalError();
                        console.log(e.responseText);
                    },
                    success: function(e){
                        if (e.success) {
                            loader.removeClass('shown');
                            blocked = false;
                            toastr.success('Запчаст откреплен.');
                            modal.modal('hide');
                            $('.item-row[data-id="'+thisItemId+'"]').fadeOut(function(){
                                $(this).remove();
                            });
                        }
                        else modalError();
                    }
                });
            }
            else modalError();
        });
        $('.init-dataTable').dataTable();
    </script>
@endpush
