@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'Добавления аналога'])
                <form action="{{ route('admin.analogs.add', ['id'=>$part->id]) }}" method="post">@csrf @method('put')
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div>
                        <input type="text" name="brand" class="form-control" placeholder="Производитель" maxlength="255" value="{{ old('brand') }}">
                        <input type="text" name="number" class="form-control mt-2" placeholder="Номер" maxlength="255" value="{{ old('number') }}">
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-success" type="submit">Добавить</button>
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
                        <th>Производитель</th>
                        <th>Номер</th>
                        <th>Действие</th>
                    </tr>
                    </thead>
                    <tbody class="table-sortable" data-action="{{ route('admin.analogs.sort') }}">
                    @foreach($items as $item)
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td>{{ $item->brand }}</td>
                            <td>{{ $item->number }}</td>
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
        'saveBtn'=>'Удалить',
        'saveBtnClass'=>'btn-danger',
        'closeBtn' => 'Отменить',
        'form'=>['id'=>'itemDeleteForm', 'action'=>'javascript:void(0)']])
    @slot('title')Удаление аналога@endslot
    <input type="hidden" id="pdf-item-id">
    <p class="font-14">Вы действительно хотите удалить данный аналог?</p>
    @endmodal
@endsection
@push('js')
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
                    url: '{!! route('admin.analogs.delete', ['id'=>$part->id]) !!}',
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
                            toastr.success('Аналог удален.');
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
    </script>
@endpush
