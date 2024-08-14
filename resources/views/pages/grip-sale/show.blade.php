<x-layout title="Sale">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-2">Sale Transactions: {{ $sales[0]->date }}</h5>
                    <div class="card-subtitle">
                        <a href="{{ route('sale.grip') }}" class="d-flex align-items-center">
                            <i class="bx bx-left-arrow me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{-- disini kerjanya imam --}}
        </div>
    </div>
</x-layout>
