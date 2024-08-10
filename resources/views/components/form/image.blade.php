@props(['label', 'id', 'name', 'required' => false, 'helperText' => null])

@push('scripts')
    <script>
        $('#{{ $id }}').on('change', function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#{{ $id }}Preview').html('<img src="' + e.target.result +
                        '" />');
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endpush

<div class="mb-3">
    <label class="form-label" for="{{ $id }}">{{ $label }}</label>
    <input type="file" name="{{ $name }}" class="form-control @error($name) is-invalid @enderror"
        id="{{ $id }}" @if ($required) required @endif accept=".jpg, .jpeg, .png">
    @if ($helperText)
        <small class="text-muted">{{ $helperText }}</small>
    @endif
    <div class="border rounded mt-3 dashed img-preview d-flex justify-content-center align-items-center p-1"
        style="height: 250px" id="{{ $id }}Preview" onclick="$('#{{ $id }}').click()">
        <span>Choose Image</span>
    </div>
</div>
