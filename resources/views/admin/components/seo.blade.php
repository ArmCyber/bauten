<div class="banner-block">
    <div class="row">
        <div class="col-12 col-dxl-6">
            @card(['title'=>'SEO'])
                <div class="form-group">
                    <div class="c-title">Название</div>
                    <div class="little-p">
                        <input type="text" name="seo_title" class="form-control" placeholder="Название" maxlength="255" value="{{ old('seo_title', $item->seo_title??null) }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="c-title">Ключевые слова</div>
                    <div class="little-p">
                        <input type="text" name="seo_keywords" class="form-control" placeholder="Ключевые слова" maxlength="255" value="{{ old('seo_keywords', $item->seo_keywords??null) }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="c-title">Описание</div>
                    <div class="little-p">
                        <textarea name="seo_description" class="form-control form-textarea" placeholder="Описание">{{ old('seo_description', $item->seo_description??null) }}</textarea>
                    </div>
                </div>
            @endcard
        </div>
    </div>
</div>