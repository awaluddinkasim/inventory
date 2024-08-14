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
                        <option value="0" @if ($month == 0) selected @endif>All</option>
                        <option value="1" @if ($month == 1) selected @endif>January</option>
                        <option value="2" @if ($month == 2) selected @endif>February</option>
                        <option value="3" @if ($month == 3) selected @endif>March</option>
                        <option value="4" @if ($month == 4) selected @endif>April</option>
                        <option value="5" @if ($month == 5) selected @endif>May</option>
                        <option value="6" @if ($month == 6) selected @endif>June</option>
                        <option value="7" @if ($month == 7) selected @endif>July</option>
                        <option value="8" @if ($month == 8) selected @endif>August</option>
                        <option value="9" @if ($month == 9) selected @endif>September</option>
                        <option value="10" @if ($month == 10) selected @endif>October</option>
                        <option value="11" @if ($month == 11) selected @endif>November</option>
                        <option value="12" @if ($month == 12) selected @endif>December</option>
                    </select>
                    <select name="year" id="year" class="form-control me-1" style="width: 100px">
                        @forelse ($years as $year)
                            <option value="{{ $year }}" @if ($year == $year) selected @endif>
                                {{ $year }}</option>
                        @empty
                            <option value="2024">2024</option>
                        @endforelse
                    </select>
                    <button class="btn btn-primary" onclick="filter()">Filter</button>
                </div>
                <x-form.modal title="Form Sale" action="" label="New Sale">
                    <x-form.select-search label="Grip" name="grip_id" id="gripSelect" modalId="formModal">
                        @foreach ($grips as $grip)
                            <option value="{{ $grip->id }}" price="{{ $grip->retail }}">
                                {{ $grip->model->name }} - {{ $grip->size }}
                            </option>
                        @endforeach
                    </x-form.select-search>
                    <x-form.input label="Retail
                                Price" name="retail" id="retailInput"
                        :isNumeric="true" :required="true" />
                    <x-form.input label="Quantity" name="quantity" type="number" id="quantityInput" min="1"
                        :required="true" />
                    <x-form.input label="Date" name="date" type="date" id="dateInput" :required="true" />
                </x-form.modal>
            </div>
            <livewire:grip-sale :month="$month" :year="$year" />
        </div>
    </div>

</x-layout>
