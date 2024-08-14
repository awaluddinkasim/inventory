<div class="mt-3">
    <div class="w-100" wire:loading>
        <div class="d-flex justify-content-center my-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div wire:loading.remove>
        <x-component.table>
            <thead>
                <th>#</th>
                <th>Date</th>
                <th>Transactions</th>
                <th>Amount</th>
                <th></th>
            </thead>
            <tbody>
                @forelse ($sales->groupBy('date') as $date => $sale)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $date }}</td>
                        <td>{{ $sale->count() }}</td>
                        <td>Rp. {{ number_format($sale->sum('amount')) }}</td>
                        <td class="text-center">
                            <x-component.button-icon label="Detail" color="primary" icon="bx-detail"
                                href="{{ route('sale.shaft.show') }}?date={{ Carbon\Carbon::parse($date)->format('Y-m-d') }}" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">No Data Available</td>
                    </tr>
                @endforelse
            </tbody>
        </x-component.table>

        <div class="mt-3">
            {{ $sales->links() }}
        </div>
    </div>
</div>
