@push('scripts')
    <script>
        function exportPdf() {
            Swal.fire({
                icon: 'info',
                title: 'Information',
                text: 'Export data to PDF',
                showCancelButton: true,
                confirmButtonText: 'Export',
                denyButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    let month = $('#month').val();
                    let year = $('#year').val();

                    window.open(
                        `{{ route('sale.shaft.export.pdf') }}?month=${month}&year=${year}`,
                        '_blank');
                }
            })
        }
    </script>
@endpush

<div class="d-inline">
    @if ($salesCount)
        <button class="btn btn-danger" onclick="exportPdf()" wire:loading.remove>
            <i class="fa fa-file-pdf"></i>
        </button>
    @endif
</div>
