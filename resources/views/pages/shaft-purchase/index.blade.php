<x-layout title="Purchase">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Shaft Purchases</h5>
                <div class="me-lg-5">
                    <span>Grand Total</span>
                    <h4>Rp. {{ number_format($shafts->sum('purchasesAmount')) }}</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="purchaseTable">
                <thead>
                    <th>#</th>
                    <th>Brand</th>
                    <th>Shaft</th>
                    <th>Flex</th>
                    <th>Last Purchase</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($shafts as $shaft)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $shaft->type->brand }}</td>
                            <td>
                                @if ($shaft->type->url)
                                    <a href="{{ $shaft->type->url }}" target="_blank">
                                        {{ $shaft->shaft }}
                                    </a>
                                @else
                                    {{ $shaft->shaft }}
                                @endif
                            </td>
                            <td>{{ $shaft->flex }}</td>
                            <td>{{ $shaft->last_purchase }}</td>
                            <td>{{ $shaft->purchases->sum('quantity') }}</td>
                            <td>Rp. {{ number_format($shaft->purchases->sum('amount')) }}</td>

                            <td class="text-center">
                                <x-component.button-icon label="Show" color="primary" icon="bx-show"
                                    href="{{ route('purchase.shaft.show', $shaft->code) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>
</x-layout>
