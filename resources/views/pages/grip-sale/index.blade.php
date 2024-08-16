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
                <h5 class="card-title">Grip Sales</h5>
                <livewire:grip-sale-amount />
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="d-flex flex-row">
                    <select name="month" id="month" class="form-control me-1" style="width: 150px">
                        @foreach ($months as $key => $month)
                            <option value="{{ $key }}" @if ($key == $activeMonth) selected @endif>
                                {{ $month }}
                            </option>
                        @endforeach
                    </select>
                    <select name="year" id="year" class="form-control me-1" style="width: 100px">
                        @forelse ($years as $year)
                            <option value="{{ $year }}" @if ($year == $activeYear) selected @endif>
                                {{ $year }}</option>
                        @empty
                            <option value="2024">2024</option>
                        @endforelse
                    </select>
                    <button class="btn btn-primary" onclick="filter()">Filter</button>
                </div>
                <div>
                    <livewire:grip-sale-export :month="$activeMonth" :year="$activeYear" />
                    <x-form.modal title="Form Sale" action="" label="New Sale">
                        <x-form.select-search label="Grip" name="grip_id" id="gripSelect" modalId="formModal">
                            @foreach ($grips as $grip)
                                <option value="{{ $grip->id }}" price="{{ $grip->retail }}">
                                    {{ $grip->model->name }} - {{ $grip->size }} ({{ $grip->color }})
                                </option>
                            @endforeach
                        </x-form.select-search>
                        <x-form.input label="Retail
                                    Price" name="retail"
                            id="retailInput" :isNumeric="true" :required="true" />
                        <x-form.input label="Quantity" name="quantity" type="number" id="quantityInput" min="1"
                            :required="true" />
                        <x-form.input label="Date" name="date" type="date" id="dateInput" :required="true" />
                    </x-form.modal>
                </div>
            </div>
            <livewire:grip-sale :month="$activeMonth" :year="$activeYear" />
        </div>
    </div>

</x-layout>
