<div class="product-item">
    <div class="product-favourite product-card-favourite{!! in_array($item->id, $favourite_ids)?' saved':null !!}"
         data-id="{{ $item->id }}" title="Сохранить"></div>
    <div class="product-image"><a href="{{ $item_url = route('part', ['url'=>$item->url]) }}">
            <img
                src="{{ ($item->image && $item->show_image)?asset('u/parts/'.$item->image):$default_images->data->parts() }}"
                alt="{{ $item->name }}">
        </a></div>
    <div class="product-title"><a href="{{ $item_url }}">{{ $item->name }}</a></div>
    <div class="product-price">
        @if ($item->price)
            <span class="catalogue-price">Цена: <span class="cat-price">{{ $item->price }}</span> <span
                    class="kzt"></span></span>
            @if($item->sale)
                <span class="sale-price">{{ $item->sale }} <span class="kzt"></span></span>
            @endif
        @endif
    </div>
    @if ($item->price && $item->max_count)
        <div class="nowrap d-flex to-basket-section position-relative mt-2">
            <span class="live-basket-group number-group number-group-sm position-relative">
                                <button class="number-btn number-input-minus live-num-minus">-</button>
                                <input data-id="{{ $item->id }}" maxlength="6" type="text"
                                       value="{{ $item->min_count??1 }}"
                                       data-multiplication="{{ $item->multiplication }}"
                                       data-minimum="{{ $item->min_count_ceil??1 }}"
                                       data-available="{{ $item->max_count }}" class="number-input live-basket-input">
                                <button class="number-btn number-input-plus live-num-plus">+</button>
                                <span class="loader loader-ng"></span>
                            </span>
            <a href="javascript:void(0)" class="live-to-basket" style="margin-left: 8px; font-size: 20px"><i
                    class="fas fa-shopping-basket"></i></a>
        </div>
    @endif
    <div class="part-statuses">
        @if ($item->new)
            <div class="part-status part-new">Новинка</div>
        @endif
        @if (!$item->price)
            <div class="part-status part-noprice">Под заказ</div>
        @elseif(!$item->max_count_wo_basket)
            <div class="part-status part-nis">Нет в наличии</div>
        @endif
    </div>
</div>




