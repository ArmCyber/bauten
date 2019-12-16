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
                <th class="nowrap">Название</th>
                <th class="nowrap">Бренд</th>
                <th class="nowrap">Фото</th>
                <th class="nowrap">Наличие</th>
                <th class="nowrap">Цена</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td style="min-width: 130px"><a href="{{ route('part', ['url'=>$item->url]) }}">{{ $item->code }}</a></td>
                    <td><a href="{{ route('part', ['url'=>$item->url]) }}">{{ $item->name }}</a></td>
                    <td style="min-width: 170px">{{ $item->brand->name }}</td>
                    <td class="nowrap">
                        @if ($item->image)
                            <a href="{{ asset('u/parts/'.$item->image) }}" class="image-toggle" data-fancybox="image-{{ $item->id }}"><i class="fas fa-camera"></i></a>
                        @endif
                    </td>
                    <td class="nowrap">{!! $item->max_count?:'<span class="text-danger">Нет в наличии</span>' !!}</td>
                    <td class="nowrap">{!! $item->price?$item->price.' <span class="kzt"></span>':($item->max_count?'<span class="text-danger">Под заказ</span>':'') !!}</td>
                    <td>
                        <div class="product-favourite position-static product-card-favourite{!! in_array($item->id, $favourite_ids)?' saved':null !!}" data-id="{{ $item->id }}" title="Сохранить"></div>
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
