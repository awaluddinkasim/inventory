@props([
    'label',
    'type' => 'text',
    'id',
    'name',
    'required' => false,
    'readonly' => false,
    'isNumber' => false,
    'value' => null,
    'helperText' => null,
])


@push('scripts')
    @if ($isNumber)
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
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" {{ $readonly ? 'readonly' : '' }} {{ $required ? 'required' : '' }} class="form-control" id="{{ $id }}" />
</div>
