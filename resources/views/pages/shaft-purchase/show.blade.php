<x-layout title="Purchase">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title">{{ $shaft->shaft }}</h5>
                    <div class="card-subtitle">
                        <a href="{{ route('purchase.shaft') }}" class="d-flex align-items-center">
                            <i class="bx bx-left-arrow me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <x-form.modal label="New Purchase" title="Form Purchase"
                    action="{{ route('purchase.shaft.store', $shaft->code) }}">
                    <x-form.input label="Shaft" name="shaft" id="shaftInput"
                        value="{{ $shaft->type->brand }} - {{ $shaft->shaft }}" :readonly="true" />
                    <x-form.input label="Wholesale Price" name="wholesale" id="wholesaleInput" :isNumeric="true"
                        value="{{ $shaft->wholesale }}" :required="true" />
                    <x-form.input label="Quantity" name="quantity" type="number" id="quantityInput" min="1"
                        :required="true" />
                    <x-form.input label="Date" name="date" type="date" id="dateInput" :required="true" />
                </x-form.modal>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="stockTable">
                <thead>
                    <th>#</th>
                    <th>Flex</th>
                    <th>Wholesale Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Purchase Date</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $purchase->shaft->flex }}</td>
                            <td>Rp. {{ number_format($purchase->shaft->wholesale) }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>Rp. {{ number_format($purchase->amount) }}</td>
                            <td>{{ $purchase->date }}</td>

                            <td class="text-center">
                                <form action="{{ route('purchase.shaft.destroy', $purchase->id) }}" class="d-inline"
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
