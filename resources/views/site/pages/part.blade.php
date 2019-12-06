@extends('site.layouts.app')
@section('main')
<div class="container pt-s">
    @breadcrumb(['pages'=>[['title'=>$item->catalogue->group->name,'url'=>route('group', ['url'=>$item->catalogue->group->url])],['title'=>$item->catalogue->name, 'url'=>route('catalogue', ['url'=>$item->catalogue->url])], ['title'=>$item->name]]])@endbreadcrumb
    <div class="product-page mt-4">
        <div class="product-page-head">
            <div class="row l-m">
{{--                @if(($item->image && $item->show_image) || count($gallery))--}}
                    @php $images_av=true; @endphp
                    <div class="col-12 col-md-5">
                        <div class="product-images">
                            <div class="product-gallery-lg">
                                <div id="product-gallery" class="swiper-container">
                                    <div class="swiper-wrapper">
                                        @if($item->image && $item->show_image)
                                            <div class="swiper-slide"><div class="product-gallery-item"><img src="{{ asset('u/parts/'.$item->image) }}" alt="{{ $item->name }}" title="{{ $item->title }}"></div></div>
                                        @else
                                            <div class="swiper-slide"><div class="product-gallery-item"><img src="{{ $default_images->data->parts() }}" alt="{{ $item->name }}" title="{{ $item->title }}"></div></div>
                                        @endif
                                        @foreach($gallery as $gallery_item)
                                            <div class="swiper-slide"><div class="product-gallery-item"><img src="{{ $gallery_item->image() }}" alt="{{ $gallery_item->alt }}" title="{{ $gallery_item->title }}"></div></div>
                                            @push('gallery_thumbs')
                                                <div class="swiper-slide pr-thumb-slide"><div class="product-gallery-item pr-thumb-item"><img src="{{ $gallery_item->image() }}" alt="{{ $gallery_item->alt }}" title="{{ $gallery_item->title }}"></div></div>
                                            @endpush
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if(count($gallery))
                                <div id="product-thumbs" class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide pr-thumb-slide"><div class="product-gallery-item pr-thumb-item"><img src="{{ asset('u/parts/'.$item->image) }}" alt="{{ $item->name }}" title="{{ $item->title }}"></div></div>
                                        @stack('gallery_thumbs')
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
{{--                @endif--}}
                <div class="col-12{!! isset($images_av)?' col-md-7':' mt-3' !!}">
                    <div class="product-page-content">
                        <div class="product-page-info">
                            <h1 class="product-page-title">{{ $item->name }}</h1>
                            <div class="product-page-codes">
                                <div class="product-pages-save"><div title="Сохранить" class="product-favourite product-page-favourite{!! in_array($item->id, $favourite_ids)?' saved':null !!}" data-id="{{ $item->id }}"></div></div>
                                <div class="product-page-codes-cont">
                                    <div class="product-page-code">Артикул: <span>{{ $item->code }}</span></div>
                                    @if($item->oem)
                                        <div class="product-page-code">ОЕМ: <span>{{ $item->oem }}</span></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                            <div class="part-page-statuses">
                                @if ($item->new)
                                    <div class="part-status-lg part-new">Новинка</div>
                                @endif
                                @if (!$item->price)
                                    <div class="part-status-lg part-noprice">Под заказ</div>
                                @elseif(!$item->max_count_wo_basket)
                                    <div class="part-status-lg part-nis">Нет на складе</div>
                                @endif
                            </div>
{{--                        @if($item->description)--}}
{{--                            <div class="product-page-description">{!! $item->description !!}</div>--}}
{{--                        @endif--}}
                        @if ($item->price)
                            <div class="product-page-pricing">
                                <div class="product-page-price">
                                    Цена: <span class="ppp">{{ $item->price }}</span> <span class="kzt"></span>
                                </div>
                                @if($item->sale)
                                    <div class="product-page-mincount">Цена без скидки: {{ $item->sale }} <span class="kzt"></span>.</div>
                                @endif
                                @if($item->min_count!=1 && $item->min_count>$item->multiplication)
                                    <div class="product-page-mincount">Мин. количество: {{ $item->min_count }} шт.</div>
                                @endif
                                @if($item->multiplication!=1)
                                    <div class="product-page-mincount">Количество в упаковке: {{ $item->multiplication }} шт.</div>
                                @endif
                                @if($item->count_sale_count  && $item->count_sale_percent)
                                    <div class="product-page-mincount">Начиная с {{ $item->count_sale_count }} шт. - скидка {{ $item->count_sale_percent }}%.</div>
                                @endif
                            </div>
                        @endif
                        @if ($item->price)
                            @if($item->application_only)
                                <div class="h4 text-danger pt-2 not-in-stock">Нет на складе</div>
                            @else
                                @if($item->max_count)
                                    <div class="product-page-shop not-in-stock-hidden">
                                        <div class="product-page-form">
                                            <div class="product-page-count">
                                                <div class="number-group">
                                                    <button class="number-btn number-input-minus">-</button>
                                                    <input type="text" value="{{ $item->min_count_ceil }}" data-multiplication="{{ $item->multiplication }}" data-price="{{ $item->price }}" data-available="{{ $item->max_count }}" class="number-input" readonly>
                                                    <button class="number-btn number-input-plus">+</button>
                                                </div>
                                            </div>
                                            <div class="product-page-submit position-relative"><button id="to-basket">В корзину</button><span class="loader loader-sm"></span></div>
                                        </div>
                                        <div class="product-page-price mt-3">Общая стоимость: <span id="sale-from" class="sale-price" style="display: none"><span id="part-sale-price"></span> <span class="kzt"></span></span> <span class="ppp" id="full-price"></span> <span class="kzt"></span> </div>
                                    </div>
                                @endif
                                <div class="h4 text-danger pt-2 not-in-stock">Нет на складе</div>
                            @endif
                        @endif
                        @if (!$item->price)
                            <div class="pt-3">
                                <button class="bauten-btn" data-toggle="modal" data-target="#application-modal">Уточнить цену</button>
                            </div>
                            @push('modals')
                                @modal(['id'=>'application-modal', 'loader'=>true,
                                            'saveBtn'=>'Отправить заявку',
                                            'saveBtnClass'=>'btn-bauten',
                                            'closeBtn' => 'Отменить',
                                            'dialog_class' => 'modal-xl',
                                            'form'=>['id'=>'application-form', 'action'=>route('cabinet.send_price_application', ['id'=>$item->id])]])
                                @slot('title')Оформление заявки@endslot @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="form-name">ФИО</label>
                                            <input type="text" id="form-name" class="form-control @error('name') has-error @enderror" name="name" value="{{ old('name', $user->name) }}" maxlength="255">
                                            @error('name')
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="form-region">Регион</label>
                                            <input type="text" id="form-region" class="form-control @error('region') has-error @enderror" name="region" value="{{ old('region', $user->region) }}" maxlength="255">
                                            @error('region')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="form-city">Город</label>
                                            <input type="text" id="form-city" class="form-control @error('city') has-error @enderror" name="city" value="{{ old('city', $user->city) }}" maxlength="255">
                                            @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @endmodal
                            @endpush
                            @push('css')
                                @css(aApp('toastr/build/toastr.min.css'))
                            @endpush
                            @push('pageScripts')
                                @js(aApp('toastr/build/toastr.min.js'))
                                {!! Notify::render() !!}
                                <script>
                                    var applicationForm = $('#application-form'),
                                        app_blocked = false;
                                    applicationForm.on('submit', function(e){
                                        if (app_blocked) return false;
                                        app_blocked = true;
                                        $('<input type="hidden" name="count"/>').val($('.number-input').val()).appendTo(applicationForm);
                                    });
                                    @if(session()->hasOldInput())
                                    $('#application-modal').modal('show');
                                    @endif
                                </script>
                            @endpush
                        @elseif($item->application_only || !$item->max_count_wo_basket)
                            <div class="product-page-shop not-in-stock-hidden">
                                <div class="product-page-form">
                                    <div class="product-page-count">
                                        <div class="number-group">
                                            <button class="number-btn number-input-minus">-</button>
                                            <input type="text" value="{{ $item->min_count_ceil }}" data-multiplication="{{ $item->multiplication }}" data-price="{{ $item->price }}" data-available="9999" class="number-input" readonly>
                                            <button class="number-btn number-input-plus">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-page-price mt-3">Общая стоимость: <span id="sale-from" class="sale-price" style="display: none"><span id="part-sale-price"></span> <span class="kzt"></span></span> <span class="ppp" id="full-price"></span> <span class="kzt"></span></div>
                            </div>
                            <div class="pt-3">
                                <button class="bauten-btn" data-toggle="modal" data-target="#application-modal">Отправить заявку</button>
                            </div>
                            @push('modals')
                                @modal(['id'=>'application-modal', 'loader'=>true,
                                            'saveBtn'=>'Отправить заявку',
                                            'saveBtnClass'=>'btn-bauten',
                                            'closeBtn' => 'Отменить',
                                            'dialog_class' => 'modal-xl',
                                            'form'=>['id'=>'application-form', 'action'=>route('cabinet.send_application', ['id'=>$item->id])]])
                                @slot('title')Оформление заявки@endslot @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="form-name">ФИО</label>
                                            <input type="text" id="form-name" class="form-control @error('name') has-error @enderror" name="name" value="{{ old('name', $user->name) }}" maxlength="255">
                                            @error('name')
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="form-region">Регион</label>
                                            <input type="text" id="form-region" class="form-control @error('region') has-error @enderror" name="region" value="{{ old('region', $user->region) }}" maxlength="255">
                                            @error('region')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="form-city">Город</label>
                                            <input type="text" id="form-city" class="form-control @error('city') has-error @enderror" name="city" value="{{ old('city', $user->city) }}" maxlength="255">
                                            @error('city')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-prices text-right">
                                    <div class="cabinet-title-sm text-right">Сумма: <span id="all-price"></span> <span class="kzt"></span> <span id="sale-sum-from" class="sale-price" style="display:none"><span id="sale-sum-price"></span> <span class="kzt"></span></span></div>
                                </div>
                                @endmodal
                            @endpush
                            @push('css')
                                @css(aApp('toastr/build/toastr.min.css'))
                            @endpush
                            @push('pageScripts')
                                @js(aApp('toastr/build/toastr.min.js'))
                                {!! Notify::render() !!}
                                <script>
                                    var applicationForm = $('#application-form'),
                                        app_blocked = false;
                                    applicationForm.on('submit', function(e){
                                        if (app_blocked) return false;
                                        app_blocked = true;
                                        $('<input type="hidden" name="count"/>').val($('.number-input').val()).appendTo(applicationForm);
                                    });
                                    @if(session()->hasOldInput())
                                        $('#application-modal').modal('show');
                                    @endif
                                </script>
                            @endpush
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="product-page-body">
            @push('tabs')
                <li class="nav-item">
                    <a class="nav-link active" id="part-description-tab" data-toggle="tab" href="#part-description" role="tab">Общая информация</a>
                </li>
            @endpush
            @push('tabContent')
                <div class="tab-pane fade active show" id="part-description" role="tabpanel">
                    <div class="p-2">
                        <div class="pr-specs-tbl py-2">
                            <div class="pr-specs-item"><div class="pr-specs-key">Бренд</div><div class="pr-specs-value">{{ $item->brand->name }}</div></div>
                            @foreach($item_filters as $item_filter)
                                <div class="pr-specs-item"><div class="pr-specs-key">{{ $item_filter[0]->filter->title }}</div><div class="pr-specs-value">
                                        @foreach($item_filter as $item_criterion) @if(!$loop->first)<br>@endif <span>{{ $item_criterion->title }}</span> @endforeach
                                    </div></div>
                            @endforeach
                        </div>
                        @if ($item->description)
                            <div class="pt-2">
                                {!! $item->description !!}
                            </div>
                        @endif
                    </div>
                </div>
            @endpush
            @if(count($item->modifications))
                @push('tabs')
                    <li class="nav-item">
                        <a class="nav-link" id="part-modifications-tab" data-toggle="tab" href="#part-modifications" role="tab">Применяемость</a>
                    </li>
                @endpush
                @push('tabContent')
                    <div class="tab-pane fade" id="part-modifications" role="tabpanel">
                        <div class="prod-tbl-block p-2">
                            <table>
                                <thead>
                                <tr>
                                    <th>Марка</th>
                                    <th>Модель</th>
                                    <th>Кузов</th>
                                </tr>
                                <tbody>
                                @foreach($item->modifications as $modification)
                                    <tr><td class="tbl-mark">{{ $modification->mark->name }}</td><td>{{ $modification->model->name }}</td><td>{{ $modification->generation->full_name }}</td></tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endpush
            @endif
            @if(count($item_engines))
                @push('tabs')
                    <li class="nav-item">
                        <a class="nav-link" id="part-engines-tab" data-toggle="tab" href="#part-engines" role="tab">Двигатели</a>
                    </li>
                @endpush
                @push('tabContent')
                    <div class="tab-pane fade" id="part-engines" role="tabpanel">
                        <div class="prod-tbl-block p-2">
                            <table>
                                <thead>
                                <tr>
                                    <th>Модель</th>
                                    <th>Годы производства</th>
                                </tr>
                                <tbody>
                                @foreach($item_engines as $engine)
                                    <tr><td class="tbl-mark">{{ $engine->name }}</td><td>{{ $engine->years }}</td></tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endpush
            @endif
            @if (count($item_analogs))
                    @push('tabs')
                        <li class="nav-item">
                            <a class="nav-link" id="part-analogs-tab" data-toggle="tab" href="#part-analogs" role="tab">Аналоги</a>
                        </li>
                    @endpush
                    @push('tabContent')
                        <div class="tab-pane fade" id="part-analogs" role="tabpanel">
                            <div class="prod-tbl-block p-2">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Производитель</th>
                                        <th>Номер</th>
                                    </tr>
                                    <tbody>
                                    @foreach($item_analogs as $analog)
                                        <tr><td class="tbl-mark">{{ $analog->brand }}</td><td>{{ $analog->number }}</td></tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endpush
            @endif
            <div class="product-nav-tabs">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">@stack('tabs')</ul>
                <div class="tab-content" id="productTabsContent">@stack('tabContent')</div>
            </div>
        </div>
    </div>
</div>
@if(count($attached_parts))
    <div class="pb-s">
        <div class="recommended-products section-bg">
            <div class="container">
                <div class="prod-tbl-title pb-3 pb-lg-5">С этим советуем</div>
                <div id="attached-parts-slider" class="swiper-container show-after-init equal-heights">
                    <div class="swiper-wrapper">
                        @foreach($attached_parts as $item)
                            <div class="swiper-slide p-shadow">
                                @component('site.components.part', ['item'=>$item])@endcomponent
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('pageScripts')
        <script>
            new Swiper('#attached-parts-slider', {
                loop: false,
                autoplay: {
                    delay: 3000,
                },
                slidesPerView: 1,
                spaceBetween: 5,
                breakpoints: {
                    576: {
                        slidesPerView: 2
                    },
                    992: {
                        slidesPerView: 3
                    },
                    1200: {
                        slidesPerView: 5
                    }
                }
            });
        </script>
    @endpush
@endif
@stack('modals')
@endsection
@push('css')
    @css(aApp('swiper/swiper.css'))
@endpush
@push('js')
    <script>
        window.partId = {{ $item->id }};
        window.basketUrl = "{{ route('cabinet.basket.add') }}";
        window.csrf = "{{ csrf_token() }}";
        window.csCount = {{ $item->count_sale_count_basket?:'false' }};
        window.csPercent = {{ $item->count_sale_percent?:'false' }};
        window.user_sale = parseInt({!! $user->sale !!});
    </script>
    @js(aApp('bootstrap/js/bootstrap.js'))
    @js(aApp('swiper/swiper.js'))
    @js(aSite('js/product.js'))
    @stack('pageScripts')
@endpush
