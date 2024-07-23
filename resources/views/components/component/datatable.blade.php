@props(['id'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables/datatables.min.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script>
        let table = new DataTable('#{{ $id }}', {
            sort: false,
            lengthChange: false
        });
    </script>
@endpush

<table id="{{ $id }}" class="display">
    {{ $slot }}
</table>
