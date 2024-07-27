@props(['label', 'id', 'name', 'required' => false, 'modalId' => null])

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/select2/select2-bootstrap-5-theme.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/select2/js/select2.min.js') }}"></script>
    @if ($modalId)
        <script>
            $('#{{ $id }}').select2({
                theme: "bootstrap-5",
                placeholder: $(this).data('placeholder'),
                dropdownParent: $("#formModal")
            });
        </script>
    @else
        <script>
            $('#{{ $id }}').select2({
                theme: "bootstrap-5",
                placeholder: $(this).data('placeholder'),
            });
        </script>
    @endif
@endpush

<div class="mb-3">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <select class="form-select @error($name) is-invalid @enderror" id="{{ $id }}" name="{{ $name }}"
        @if ($required) required @endif aria-label="{{ $label }}" data-placeholder="Choose">
        <option></option>
        {{ $slot }}
    </select>
</div>
