@php
    $name = $name??'file';
    $id = $id??$name;
    $title = $title??'Выберите изоброжение...';
@endphp
<div class="custom-file c-file">
    <input type="file" name="{{ $name }}" class="custom-file-input c-file-input" data-original-title="{{ $title }}" id="file-{{ $id }}" @if(!empty($multiple))multiple="multiple"@endif>
    <label class="custom-file-label c-file-label" for="file-{{ $id }}">{{ $title }}</label>
    <div class="invalid-feedback">{{ $invalid??'Выберите изоброжение.' }}</div>
</div>