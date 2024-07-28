@props(['label', 'id', 'name', 'required' => false, 'value' => null])

<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    <input name="{{ $name }}" value="{{ $value }}" list="{{ $name }}Options"
        class="form-control @error($name) is-invalid @enderror" id="{{ $id }}"
        @if ($required) required @endif {{ $attributes }}>
    <datalist id="{{ $name }}Options">
        {{ $slot }}
    </datalist>
</div>
