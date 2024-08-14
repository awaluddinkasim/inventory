<x-layout title="Sale">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-2">Sale Transactions: {{ $sales[0]->date }}</h5>
                    <div class="card-subtitle">
                        <a href="{{ route('sale.shaft') }}" class="d-flex align-items-center">
                            <i class="bx bx-left-arrow me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            {{-- disini kerjanya imam --}}

                <x-component.datatable id="stockTable">
                    <thead>
                        <th>#</th>
                        <th>Flex</th>
                        <th>Retail</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sale->shaft->flex }}</td>
                                <td>Rp. {{ $sale->retail }}</td>
                                <td>{{ $sale->quantity }} qty</td>
                                <td>Rp. {{ number_format($sale->amount) }}</td>

                                <td class="text-center">
                                    <form action="{{ route('sale.shaft.destroy', $sale->id) }}" class="d-inline"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <x-component.button type="submit" label="Delete" color="danger"
                                            :small="true" />
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-component.datatable>

        </div>
    </div>
</x-layout>
