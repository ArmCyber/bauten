@if ($items->total())
{{ $items->links() }}

@if ($view_type == 'grid')
    <div class="row row-grid parts-row">
        @foreach($items as $item)
            <div class="part-col col-12 col-sm-6 col-md-4 {!! count($filters)>0?'col-xl-3':'col-xl-1-5' !!}">
                @component('site.components.part', ['item'=>$item])@endcomponent
            </div>
        @endforeach
    </div>
@else
    <table class="table-responsive table table-striped parts-table">
        <thead>
            <tr>
                <th class="nowrap">Артикул</th>
                <th class="nowrap">Наименование</th>
                <th class="nowrap">Производитель</th>
                <th class="nowrap">Фото</th>
                <th class="nowrap">Наличие</th>
                <th class="nowrap">Цена</th>
                <th></th>
                <th style="width: 1%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td style="min-width: 150px"><a href="{{ route('part', ['url'=>$item->url]) }}">{{ $item->code }}</a></td>
                    <td><a href="{{ route('part', ['url'=>$item->url]) }}">{{ $item->name }}</a></td>
                    <td style="min-width: 170px">{{ $item->brand->name }}</td>
                    <td class="nowrap">
                        @if ($item->image)
                            <a href="{{ asset('u/parts/'.$item->image) }}" class="image-toggle" data-fancybox="image-{{ $item->id }}"><i class="fas fa-camera"></i></a>
                        @endif
                    </td>
                    <td class="nowrap">{!! ($item->price && $item->max_count_wo_basket)?$item->max_count_wo_basket:'<span class="text-danger">0</span>' !!}</td>
                    <td class="nowrap">{!! $item->price?$item->price.' <span class="kzt"></span>':'<span class="text-danger">Под заказ</span>' !!}</td>
                    <td class="nowrap">
                        <span class="product-favourite position-static product-card-favourite{!! in_array($item->id, $favourite_ids)?' saved':null !!}" data-id="{{ $item->id }}" title="Сохранить"></span>
                    </td>
                    <td class="nowrap d-flex to-basket-section position-relative">
                        @if ($item->price && $item->max_count)
                            <span class="live-basket-group number-group number-group-sm position-relative">
                                <button class="number-btn number-input-minus live-num-minus">-</button>
                                <input data-id="{{ $item->id }}" maxlength="6" type="text" value="{{ $item->min_count??1 }}" data-multiplication="{{ $item->multiplication }}" data-minimum="{{ $item->min_count_ceil??1 }}" data-available="{{ $item->max_count }}" class="number-input live-basket-input">
                                <button class="number-btn number-input-plus live-num-plus">+</button>
                                <span class="loader loader-ng"></span>
                            </span>
                            <a href="javascript:void(0)" class="live-to-basket" style="margin-left: 8px; font-size: 20px"><i class="fas fa-shopping-basket"></i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
<div class="pt-4">
    {{ $items->links() }}
</div>
@else
    <p class="text-danger font-weight-bold pl-2 pt-1">По вашему запросу ничего не найдено.</p>
@endif
