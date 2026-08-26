@props([
'name',
'value' => '1',
'label' => null,
'checked' => false,
'id' => null,
])

@php

$cleanName = str_replace(['[', ']'], '', $name);
$id = $id ?? $cleanName . '_' . $value;
@endphp

<div class="form-check mb-2">
    <input
        type="checkbox"
        name="{{ $name }}"
        id="{{ $id }}"
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        {{ $attributes->merge(['class' => 'form-check-input']) }}>
    @if($label)
    <label class="form-check-label" for="{{ $id }}">
        {{ $label }}
    </label>
    @endif
</div>