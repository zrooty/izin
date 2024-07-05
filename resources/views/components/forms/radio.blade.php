@props(['id' => 'id-radio'.rand(), 'options' => null, 'value' => null, 'label' => null, 'inline' => true])

<div class="mb-2 form-wrapper">
    @if ($label)
        <label for="{{ $id }}" class="d-block form-label">{{ $label }}</label>
    @endif
    @foreach ($options as $key => $valueRadio)
    <div class="form-check {{ $inline ? 'form-check-inline' : null }}">
        <input @checked($value == $valueRadio) id="{{ $id.$key }}" {{ $attributes->merge(['class' => 'form-check-input']) }} type="radio" value="{{ $valueRadio }}">
        <label class="form-check-label" for="{{ $id.$key }}">{{ $key }}</label>
    </div>
    @endforeach 
</div>