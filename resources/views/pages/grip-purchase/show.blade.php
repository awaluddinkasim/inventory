<x-layout title="Stock">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">{{ $grip->model->name }}</h5>
                <x-form.modal label="New Stock" title="Form Stock"
                    action="{{ route('purchase.grip.store', $grip->code) }}">
                    <x-form.input label="Grip Model" name="grip" id="gripInput"
                        value="{{ $grip->model->name }} - {{ $grip->size }} ({{ $grip->color }})"
                        :readonly="true" />
                    <x-form.input label="Wholesale Price" name="wholesale" id="wholesaleInput" :isNumeric="true"
                        value="{{ $grip->wholesale }}" :required="true" />
                    <x-form.input label="Quantity" name="quantity" type="number" id="quantityInput"
                        :required="true" />
                    <x-form.input label="Date" name="date" type="date" id="dateInput" :required="true" />
                </x-form.modal>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="stockTable">
                <thead>
                    <th>#</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Wholesale Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Stock Date</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($purchases as $purchase)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $purchase->grip->size }}</td>
                            <td>{{ $purchase->grip->color }}</td>
                            <td>Rp. {{ number_format($purchase->grip->wholesale) }}</td>
                            <td>{{ $purchase->quantity }}</td>
                            <td>Rp. {{ number_format($purchase->amount) }}</td>
                            <td>{{ $purchase->date }}</td>

                            <td class="text-center">
                                <form action="{{ route('purchase.grip.destroy', $purchase->id) }}" class="d-inline"
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
