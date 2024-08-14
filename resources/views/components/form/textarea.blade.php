@props(['label', 'id', 'name', 'rows' => 2, 'readonly' => false, 'required' => false])

<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    <textarea id="{{ $id }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}"
        rows="{{ $rows }}" @if ($readonly) readonly @endif
        @if ($required) required @endif>{{ $slot }}</textarea>
</div>
