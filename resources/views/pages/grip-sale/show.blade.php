<x-layout title="Sale">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="card-title mb-2">{{ $grip->model->name }}</h5>
                    <div class="card-subtitle">
                        <a href="{{ route('sale.grip') }}" class="d-flex align-items-center">
                            <i class="bx bx-left-arrow me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <x-form.modal label="New Sale" title="Form Sale"
                    action="{{ route('sale.grip.store', $grip->code) }}">
                    <x-form.input label="Grip Model" name="grip" id="gripInput"
                        value="{{ $grip->model->name }} - {{ $grip->size }} ({{ $grip->color }})"
                        :readonly="true" />
                    <x-form.input label="Retail Price" name="retail" id="retailInput" :isNumeric="true"
                        value="{{ $grip->retail }}" :required="true" />
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
                    <th>Size</th>
                    <th>Color</th>
                    <th>Retail Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Sale Date</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sale->grip->size }}</td>
                            <td>{{ $sale->grip->color }}</td>
                            <td>Rp. {{ number_format($sale->grip->retail) }}</td>
                            <td>{{ $sale->quantity }}</td>
                            <td>Rp. {{ number_format($sale->salesAmount) }}</td>
                            <td>{{ $sale->date }}</td>

                            <td class="text-center">
                                <form action="{{ route('sale.grip.destroy', $sale->id) }}" class="d-inline"
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
