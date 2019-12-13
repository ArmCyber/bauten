@if ($items->total())
{{ $items->links() }}
<div class="row row-grid">
    @foreach($items as $item)
        <div class="col-12 col-sm-6 col-md-4 {!! count($filters)>0?'col-xl-3':'col-xl-1-5' !!}">
            @component('site.components.part', ['item'=>$item])@endcomponent
        </div>
    @endforeach
</div>
<div class="pt-4">
    {{ $items->links() }}
</div>
@else
    <p class="text-danger font-weight-bold pl-2 pt-1">По вашему запросу ничего не найдено.</p>
@endif
