<x-layout title="Stock">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Stock</h5>
                <x-form.modal label="New Stock" title="Form Model" action="{{ route('stock.store') }}">
                    <x-form.select label="Grip Model" name="grip_id" id="gripSelect" :required="true">
                        @foreach ($grips as $grip)
                            <option value="{{ $grip->id }}">{{ $grip->model->name }} - {{ $grip->size }} </option>
                        @endforeach
                    </x-form.select>
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
                    <th>Grip Model</th>
                    <th>Size</th>
                    <th>Wholesale Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Stock Date</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($stocks as $stock)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ $stock->grip->model->url }}" target="_blank">
                                    {{ $stock->grip->model->name }}
                                </a>
                            </td>
                            <td>{{ $stock->grip->size }}</td>
                            <td>Rp. {{ number_format($stock->grip->wholesale) }}</td>
                            <td>{{ $stock->quantity }}</td>
                            <td>Rp. {{ number_format($stock->amount) }}</td>
                            <td>{{ $stock->date }}</td>

                            <td class="text-center">
                                <form action="{{ route('stock.destroy', $stock->id) }}" class="d-inline"
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
