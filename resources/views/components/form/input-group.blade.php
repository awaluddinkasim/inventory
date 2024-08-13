@props([
    'label',
    'type' => 'text',
    'prefix',
    'id',
    'name',
    'required' => false,
    'readonly' => false,
    'isNumeric' => false,
    'value' => null,
    'helperText' => null,
])

@push('scripts')
    @if ($isNumeric)
        <script src="{{ asset('assets/libs/autonumeric/autoNumeric.min.js') }}"></script>
        <script>
            new AutoNumeric('#{{ $id }}', {
                allowDecimalPadding: false,
                modifyValueOnWheel: false
            });
        </script>
    @endif
@endpush

<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    <div class="input-group">
        <span class="input-group-text pe-2" id="{{ $id }}Prefix">{{ $prefix }}</span>
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}"
            class="form-control @error($name) is-invalid @enderror" @if ($readonly) readonly @endif
            @if ($required) required @endif {{ $attributes }}>
    </div>
    @if ($helperText)
        <small class="text-muted">{{ $helperText }}</small>
    @endif
</div>
