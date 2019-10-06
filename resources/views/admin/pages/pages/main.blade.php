@extends('admin.layouts.app')
@section('titleSuffix')| <a href="{!! route('admin.pages.add') !!}" class="text-cyan"><i class="mdi mdi-plus-box"></i> добавить</a>@endsection
@section('content')
    @if(count($items))
        <div class="card">
            <div class="table-responsive">
                <table class="table table-striped m-b-0 columns-middle">
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th>Статус</th>
                            <th>Действие</th>
                        </tr>
                    </thead>
                    <tbody class="table-sortable" data-action="{{ route('admin.pages.sort') }}">
                        @foreach($items as $item)
                            <tr class="item-row" data-id="{!! $item->id !!}">
                                <td class="item-title">{{ $item->title }}</td>
                                @if($item->active)
                                    <td class="text-success">Активно</td>
                                @else
                                    <td class="text-danger">Неактивно</td>
                                @endif
                                <td>
                                    <a href="{{ route('admin.pages.edit', ['id'=>$item->id]) }}" {!! tooltip('Редактировать') !!} class="icon-btn edit"></a>
                                    @if (!$item->static)
{{--                                        <a href="{{ route('admin.gallery', ['gallery'=>'pages', 'key'=>$item->id]) }}" {!! tooltip('Галерея') !!} class="icon-btn gallery"></a>--}}
{{--                                        <a href="{{ route('admin.video_gallery', ['gallery'=>'pages', 'key'=>$item->id]) }}" {!! tooltip('Видеогалерея') !!} class="icon-btn video-gallery"></a>--}}
                                        <span class="d-inline-block"  style="margin-left:4px;" data-toggle="modal" data-target="#itemDeleteModal"><a href="javascript:void(0)" class="icon-btn delete" {!! tooltip('Удалить') !!}></a></span>
                                    @else
                                        @if(array_key_exists($item->static, $content_pages))
                                            <a href="{{ route($content_pages[$item->static][0], $content_pages[$item->static][1]??[]) }}" {!! tooltip('Контент') !!} class="icon-btn content"></a>
                                        @endif
                                        {{--
                                        @if(array_key_exists($item->static, $gallery_pages))
                                            <a href="{{ route('admin.gallery', ['gallery'=>$gallery_pages[$item->static]]) }}" {!! tooltip('Галерея') !!} class="icon-btn gallery"></a>
                                        @endif
                                        @if(array_key_exists($item->static, $video_gallery_pages))
                                            <a href="{{ route('admin.video_gallery', ['gallery'=>$video_gallery_pages[$item->static]]) }}" {!! tooltip('Видеогалерея') !!} class="icon-btn video-gallery"></a>
                                        @endif
                                        --}}
                                    @endif
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
    @slot('title')Удаление страницы@endslot
    <input type="hidden" id="pdf-item-id">
    <p class="font-14">Вы действительно хотите удалить страницу &Lt;<span id="pdm-title"></span>&Gt;?</p>
    @endmodal
@endsection
@push('css')
@endpush
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
                    url: '{!! route('admin.pages.delete') !!}',
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
                            toastr.success('Страница удалено');
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
