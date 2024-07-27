<x-layout title="Stock">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Stock</h5>
                <div class="me-lg-5">
                    <span>Grand Total</span>
                    <h4>Rp. {{ number_format($grips->sum('amount')) }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="stockTable">
                <thead>
                    <th>#</th>
                    <th>Grip Model</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Wholesale Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($grips as $grip)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ $grip->model->url }}" target="_blank">
                                    {{ $grip->model->name }}
                                </a>
                            </td>
                            <td>{{ $grip->size }}</td>
                            <td>{{ $grip->color }}</td>
                            <td>Rp. {{ number_format($grip->wholesale) }}</td>
                            <td>{{ $grip->stock->sum('quantity') }}</td>
                            <td>Rp. {{ number_format($grip->stock->sum('amount')) }}</td>

                            <td class="text-center">
                                <x-component.button label="Show" color="primary"
                                    href="{{ route('stock.show', $grip->id) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>
</x-layout>
