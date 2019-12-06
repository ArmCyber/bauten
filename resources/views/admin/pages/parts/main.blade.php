@extends('admin.layouts.app')
@can('admin')
@section('titleSuffix')| <a href="{!! route('admin.parts.add') !!}" class="text-cyan"><i class="mdi mdi-plus-box"></i> добавить</a>@endsection
@endcan
@section('content')
        <div class="card">
            <div class="table-responsive p-2">
                <table class="table table-striped m-b-0 columns-middle init-dataTable">
                    <thead>
                    <tr>
                        <th>REF</th>
                        <th>Артикул</th>
                        <th>Название</th>
                        <th>Категория</th>
                        <th>Бренд</th>
                        <th>Статус</th>
                        @can('content')
                        <th>Действие</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items??[] as $item)
                        <tr class="item-row" data-id="{!! $item->id !!}">
                            <td>{{ $item->code }}</td>
                            <td class="item-title">{{ $item->name}}</td>
                            <td>{{ $item->catalogue->name??'?' }}</td>
                            <td>{{ $item->brand->name }}</td>
                            @if($item->active)
                                <td class="text-success">Активно</td>
                            @else
                                <td class="text-danger">Неактивно</td>
                            @endif
                            @can('content')
                            <td class="nowrap">
                                @can('admin')
                                <a href="{{ route('admin.parts.attached_parts', ['id'=>$item->id]) }}" {!! tooltip('С этим советуем') !!} class="icon-btn parts"></a>
                                <a href="{{ route('admin.parts.filters', ['id'=>$item->id]) }}" {!! tooltip('Фильтры') !!} class="icon-btn filters"></a>
{{--                                <a href="{{ route('admin.parts.engine_filters', ['id'=>$item->id]) }}" {!! tooltip('Фильтры двигателя') !!} class="icon-btn filters-alt"></a>--}}
                                @endcan
                                <a href="{{ route('admin.analogs.main', ['id'=>$item->id]) }}" {!! tooltip('Аналогы') !!} class="icon-btn analogs"></a>
                                <a href="{{ route('admin.gallery', ['gallery'=>'parts', 'id'=>$item->id]) }}" {!! tooltip('Галерея') !!} class="icon-btn gallery"></a>
                                <a href="{{ route('admin.parts.edit', ['id'=>$item->id]) }}" {!! tooltip('Редактировать') !!} class="icon-btn edit"></a>
                                @can('admin')
                                <span class="d-inline-block"  style="margin-left:4px;" data-toggle="modal" data-target="#itemDeleteModal"><a href="javascript:void(0)" class="icon-btn delete" {!! tooltip('Удалить') !!}></a></span>
                                @endcan
                            </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @modal(['id'=>'itemDeleteModal', 'centered'=>true, 'loader'=>true,
        'saveBtn'=>'Удалить',
        'saveBtnClass'=>'btn-danger',
        'closeBtn' => 'Отменить',
        'form'=>['id'=>'itemDeleteForm', 'action'=>'javascript:void(0)']])
    @slot('title')Удаление запчаста@endslot
    <input type="hidden" id="pdf-item-id">
    <p class="font-14">Вы действительно хотите удалить данный запчаст?</p>
    @endmodal
@endsection
@push('css')
    @css(aApp('datatables/datatables.css'))
    <style>
        table {
            width:100% !important;
            overflow: hidden;
        }
        th:first-child, td:first-child {
            display: none !important;
        }
        td:last-child {
            white-space: nowrap;
        }
    </style>
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
                    url: '{!! route('admin.parts.delete') !!}',
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
                            toastr.success('Запчаст удален.');
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
        $('.init-dataTable').dataTable({
            ajax: '{{ route('admin.parts.list_ajax') }}',
            serverSide: true,
            processing: true,
            createdRow: function (row, data) {
                $(row).addClass('item-row').attr('data-id', data.id);
            },
            columns: [
                {data: "ref"},
                {data: "code"},
                {data: "name"},
                {
                    data: "catalogue.name",
                    orderable: false
                },
                {
                    data: "brand.name",
                    orderable: false
                },
                {
                    data: "active",
                    render: function(val){
                        if (parseInt(val)===1) {
                            return '<span class="text-success">Активно</span>';
                        }
                        return '<span class="text-danger">Неактивно</span>';
                    }
                },
                {
                    data: "id",
                    orderable: false,
                    render: function(id){
                        return ''+
                            @can('admin')
                                '<a href="{{ route('admin.parts.attached_parts') }}/'+id+'" {!! tooltip('С этим советуем') !!} class="icon-btn parts"></a>'+
                                '<a href="{{ route('admin.parts.filters') }}/'+id+'" {!! tooltip('Фильтры') !!} class="icon-btn filters"></a>'+
                            @endcan
                            '<a href="{{ route('admin.analogs.main') }}/'+id+'" {!! tooltip('Аналогы') !!} class="icon-btn analogs"></a>'+
                            '<a href="{{ route('admin.gallery', ['gallery'=>'parts']) }}/'+id+'" {!! tooltip('Галерея') !!} class="icon-btn gallery"></a>'+
                            '<a href="{{ route('admin.parts.edit') }}/'+id+'" {!! tooltip('Редактировать') !!} class="icon-btn edit"></a>'+
                            @can('admin')
                                '<span class="d-inline-block"  style="margin-left:4px;" data-toggle="modal" data-target="#itemDeleteModal"><a href="javascript:void(0)" class="icon-btn delete" {!! tooltip('Удалить') !!}></a></span>'+
                            @endcan
                        '';
                    }
                }
            ]
        });
    </script>
@endpush
