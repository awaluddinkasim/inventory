@props(['id'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables/datatables.min.css') }}" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script>
        let table = new DataTable('#{{ $id }}', {
            sort: false,
        });
    </script>
@endpush

<div class="table-responsive text-nowrap pb-3">
    <table id="{{ $id }}" class="table table-hover">
        {{ $slot }}
    </table>
</div>
