@props(['label', 'id', 'name', 'required' => false])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <select class="form-select @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}"
        @if ($required) required @endif aria-label="{{ $label }}">
        <option value="" selected hidden>Pilih</option>
        {{ $slot }}
    </select>
</div>
