@push('scripts')
    <script>
        $('#gripSelect').on('change', function() {
            let retail = this.options[this.selectedIndex].attributes['price'].value;

            const element = AutoNumeric.getAutoNumericElement('#retailInput')
            element.set(retail);
        })

        function filter() {
            let month = $('#month').val();
            let year = $('#year').val();

            Livewire.dispatch('filter', {
                month,
                year
            });
        }
    </script>
@endpush

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
                <x-form.modal label="New Sale" title="Form Sale" action="{{ route('sale.grip.store') }}">
                    <x-form.select-search label="Grip" name="grip_id" id="gripSelect" modalId="formModal">
                        @foreach ($grips as $grip)
                            <option value="{{ $grip->id }}" price="{{ $grip->retail }}">
                                {{ $grip->model->name }} - {{ $grip->size }} ({{ $grip->color }})
                            </option>
                        @endforeach
                    </x-form.select-search>
                    <x-form.input label="Retail Price" name="retail" id="retailInput" :isNumeric="true"
                        :required="true" />
                    <x-form.input label="Quantity" name="quantity" type="number" id="quantityInput" min="1"
                        :required="true" />
                    <input type="hidden" name="date" id="dateInput"
                        value="{{ Carbon\Carbon::parse($sales[0]->date)->format('Y-m-d') }}">
                </x-form.modal>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="stockTable">
                <thead>
                    <th>#</th>
                    <th>Code</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Retail</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sale->grip->code }}</td>
                            <td>{{ $sale->grip->model->type->brand }}</td>
                            <td>{{ $sale->grip->model->name }}</td>
                            <td>{{ $sale->grip->size }}</td>
                            <td>{{ $sale->grip->color }}</td>
                            <td>Rp. {{ number_format($sale->retail) }}</td>
                            <td>{{ $sale->quantity }}</td>
                            <td>Rp. {{ number_format($sale->amount) }}</td>

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
