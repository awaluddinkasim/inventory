@props(['label', 'id', 'name', 'required' => false])

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">Example select</label>
    <select class="form-select @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}"
        @if ($required) required @endif aria-label="Default select example">
        <option value="" selected hidden>Pilih</option>
        {{ $slot }}
    </select>
</div>
