
@props(['label', 'id', 'name', 'rows' => 2, 'required' => false])

<div class="mb-3">
    <label class="form-label" for="{{ $id }}">Message</label>
    <textarea id="{{ $id }}" class="form-control" name="{{ $name }}" rows="{{ $rows }}" {{ $required ? 'required' : ''  }}>{{ $slot }}</textarea>
</div>
