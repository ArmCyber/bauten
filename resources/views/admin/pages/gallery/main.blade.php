@extends('admin.layouts.app')

@section('content')
    @card
        @slot('title') Изоброжении (jpeg, png)@endslot
        <div class="add-new-images">
            @if ($errors->any())
                <div class="py-1 font-weight-bold text-danger text-sm-left text-center">{{ $errors->first() }}</div>
            @endif
            <form action="{{ route('admin.gallery.add') }}" method="post" enctype="multipart/form-data">
                @csrf @method('put')
                <input type="hidden" name="gallery" value="{{ $gallery }}">
                @if($key)
                <input type="hidden" name="key" value="{{ $key }}">
                @endif
                <div class="uploadLine">
                    @file(['name'=>'images[]', 'multiple'=>true])@endfile
                    <div class="ml-sm-2 mt-2 mt-sm-0">
                        <button type="submit" class="btn btn-cyan">Добавить</button>
                    </div>
                </div>
            </form>
        </div>
        @if (count($images))
            <div class="row gallery-row grid-sortable">
                @foreach($images as $image)
                    <div class="col-12 col-sm-4 col-dxl-3 col-xl-2 py-2 item-container" data-id="{{ $image->id }}">
                        <div class="gallery-grid">
                            <img src="{{ $image->image() }}" class="gallery-image">
                            <div class="gallery-absolute">
                                <div class="gallery-item-actions">
                                    <a href="javascript:void(0)" class="gallery-item-action gallery-item-edit" data-toggle="modal" data-target="#itemEditModal"><i class="fas fa-pencil-alt"></i></a>
                                    <a href="javascript:void(0)" class="gallery-item-action gallery-item-move"><i class="fas fa-arrows-alt"></i></a>
                                    <a href="javascript:void(0)" class="gallery-item-action" data-toggle="modal" data-target="#itemDeleteModal"><i class="fas fa-trash-alt"></i></a>
                                </div>
                                <div><a href="{{ $image->image() }}" data-fancybox="gallery" class="gallery-item-show"><i class="fas fa-search-plus"></i></a></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @modal(['id'=>'itemDeleteModal', 'centered'=>true, 'loader'=>true,
            'saveBtn'=>'Удалить',
            'saveBtnClass'=>'btn-danger',
            'closeBtn' => 'Отменить',
            'form'=>['id'=>'itemDeleteForm', 'action'=>'javascript:void(0)']])
            @slot('title')Удаление изоброжении@endslot
            <input type="hidden" id="pdf-item-id">
            <p class="font-14">Вы действительно хотите удалить данное изоброжение?</p>
            @endmodal
            @modal(['id'=>'itemEditModal', 'centered'=>true, 'loader'=>true,
            'saveBtn'=>'Редактировать',
            'saveBtnClass'=>'btn-success',
            'closeBtn' => 'Отменить',
            'form'=>['id'=>'itemEditForm', 'action'=>'javascript:void(0)']])
            @slot('title')Редактирование изоброжении@endslot
            <input type="hidden" id="edit-item-id">
            <input type="text" name="alt" id="edit-alt" class="form-control" placeholder="Alt">
            <input type="text" name="title" id="edit-title" class="form-control mt-2" placeholder="Title">
            @endmodal
            @push('css')
                @css(aApp('fancybox/fancybox.css'))
            @endpush
            @push('js')
                @js(aApp('fancybox/fancybox.js'))
                <script>
                    var action = "{{ route('admin.gallery.sort') }}";
                    $('.gallery-row').sortable({
                        handle: '.gallery-item-move',
                        update: function(){
                            sortableUpdate($(this), action);
                        }
                    });
                    //region Delete
                    var itemId = $('#pdf-item-id'),
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
                        var button = $(e.relatedTarget),
                            thisItemContainer = button.parents('.item-container');
                        itemId.val(thisItemContainer.data('id'));
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
                                url: '{!! route('admin.gallery.delete') !!}',
                                type: 'post',
                                dataType: 'json',
                                data: {
                                    _token: csrf,
                                    _method: 'delete',
                                    item_id: thisItemId,
                                },
                                error: function(e){
                                    modalError();
                                },
                                success: function(e){
                                    if (e.success) {
                                        loader.removeClass('shown');
                                        blocked = false;
                                        toastr.success('Изоброжение удалено');
                                        modal.modal('hide');
                                        $('.item-container[data-id="'+thisItemId+'"]').fadeOut(function(){
                                            $(this).remove();
                                        });
                                    }
                                    else modalError();
                                }
                            });
                        }
                        else modalError();
                    });
                    //endregion
                    //region SEO
                    var images = {!! $images->mapWithKeys(function($item){
                            return [$item['id'] => ['alt'=>$item->alt, 'title'=>$item->title]];
                        })->toJson(JSON_FORCE_OBJECT) !!},
                        editModal = $('#itemEditModal'),
                        galleryBylangFirst = $('#gallery-bylang .bylang-nav-tabs .nav-item:first-child>.nav-link');
                    editModal.on('show.bs.modal', function(e){
                        var itemId = $(e.relatedTarget).parents('.item-container').data('id');
                        if (!itemId) {
                            e.preventDefault();
                            return false;
                        }
                        var item = images[itemId];
                        if (!item) {
                            e.preventDefault();
                            return false;
                        }
                        galleryBylangFirst.click();
                        $('#edit-item-id').val(itemId);
                        $('#edit-alt').val(item.alt || null);
                        $('#edit-title').val(item.title || null);
                    });
                    var editModalError = function(loader){
                        loader.removeClass('shown');
                        blocked = false;
                        toastr.error('Возникла проблема!');
                        editModal.modal('hide');
                    };
                    $('#itemEditForm').on('submit', function(){
                        if (blocked) return false;
                        blocked = true;
                        var loader = editModal.find('.modal-loader');
                        var thisItemId = $(this).find('#edit-item-id').val();
                        if (thisItemId && thisItemId.match(/^[1-9][0-9]{0,9}$/)) {
                            var alts = {},
                                titles = {};
                                alts = $.trim($('#edit-alt').val());
                                titles = $.trim($('#edit-title').val());
                            loader.addClass('shown');
                            $.ajax({
                                url: '{!! route('admin.gallery.edit') !!}',
                                type: 'post',
                                dataType: 'json',
                                data: {
                                    _token: csrf,
                                    _method: 'patch',
                                    item_id: thisItemId,
                                    alt: alts,
                                    title: titles
                                },
                                error: function(e){
                                    console.error(e.responseText);
                                    editModalError(loader);
                                },
                                success: function(e){
                                    if (e.success) {
                                        loader.removeClass('shown');
                                        blocked = false;
                                        toastr.success('Изменения сохранены.');
                                        editModal.modal('hide');
                                        images[thisItemId] = {
                                            alt: alts,
                                            title: titles
                                        }
                                    }
                                    else editModalError(loader);
                                }
                            });
                        }
                        else editModalError(loader);
                    });
                    //endregion
                </script>
            @endpush
        @endif
    @endcard
@endsection
