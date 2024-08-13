<x-layout title="Purchase">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Grip Purchases</h5>
                <div class="me-lg-5">
                    <span>Grand Total</span>
                    <h4>Rp. {{ number_format($grips->sum('purchasesAmount')) }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="purchaseTable">
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
                                @if ($grip->model->url)
                                    <a href="{{ $grip->model->url }}" target="_blank">
                                        {{ $grip->model->name }}
                                    </a>
                                @else
                                    {{ $grip->model->name }}
                                @endif
                            </td>
                            <td>{{ $grip->size }}</td>
                            <td>{{ $grip->color }}</td>
                            <td>Rp. {{ number_format($grip->wholesale) }}</td>
                            <td>{{ $grip->purchases->sum('quantity') }}</td>
                            <td>Rp. {{ number_format($grip->purchases->sum('amount')) }}</td>

                            <td class="text-center">
                                <x-component.button-icon label="Show" color="primary" icon="bx-show"
                                    href="{{ route('purchase.grip.show', $grip->code) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>
</x-layout>
