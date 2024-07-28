@props(['label', 'id', 'name', 'required' => false])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <select class="form-select @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}"
        @if ($required) required @endif aria-label="{{ $label }}" {{ $attributes }}>
        <option value="" selected hidden>Choose</option>
        {{ $slot }}
    </select>
</div>
