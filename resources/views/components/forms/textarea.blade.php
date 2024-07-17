@props(['id' => 'id-textarea'. rand(), 'label' => null, 'value' => null])
<div>
    @if ($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif
    <textarea rows="4" id="{{ $id }}" {{ $attributes->merge(['class' => 'form-control']) }} >{{ $value }}</textarea>
</div>