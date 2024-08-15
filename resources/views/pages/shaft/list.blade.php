@push('scripts')
    <script>
        $('#type').on('change', function() {
            let text = this.options[this.selectedIndex].text;

            let type = text.split('-')[1].trim();

            $('#shaftPrefix').text(type);
            $('#shaft').focus();
        })
    </script>
     <script>
        function exportExcel() {
            Swal.fire({
                icon: 'info',
                title: 'Information',
                text: 'Are you sure want to export?',
                showCancelButton: true,
                confirmButtonText: 'Export',
                denyButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.open('{{ route('shaft.export') }}', '_blank');
                }
            })
        }
    </script>
@endpush

<x-layout title="Shaft List">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Shaft List</h5>

                <div>
                    @if ($shafts->count())
                        <button class="btn btn-success" onclick="exportExcel()">
                            <i class="fa fa-file-excel"></i>
                        </button>
                    @endif
                    <x-form.modal label="New Shaft" title="Form Shaft" action="{{ route('shaft.list.store') }}"
                        :hasFile="true">
                        <x-form.select-search label="Type" id="type" name="type_id" required="true"
                            modalId="formModal">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->brand }} - {{ $type->name }}</option>
                            @endforeach
                        </x-form.select-search>
                        <x-form.input-group label="Shaft" id="shaft" name="shaft" prefix="Type"
                            required="true" />
                        <x-form.input label="Flex" id="flex" name="flex" required="true" />
                        <div class="row">
                            <div class="col-md-6">
                                <x-form.input label="Length" id="length" name="length" isNumeric="true"
                                    required="true" />
                            </div>
                            <div class="col-md-6">
                                <x-form.input label="Weight" id="weight" name="weight" isNumeric="true"
                                    required="true" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <x-form.input label="Wholesale Price" name="wholesale" id="wholesaleInput"
                                    :isNumeric="true" :required="true" />
                            </div>
                            <div class="col-md-5">
                                <x-form.input label="Retail Percentage (%)" name="percent" id="percentInput"
                                    :isNumeric="true" :required="true" />
                            </div>
                        </div>
                        <x-form.image label="Image" name="img" id="imgInput" :required="true" />
                    </x-form.modal>
                </div>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="gripTable">
                <thead>
                    <th>#</th>
                    <th>Code</th>
                    <th>Shaft</th>
                    <th>Flex</th>
                    <th>Length</th>
                    <th>Weight</th>
                    <th>Stock</th>
                    <th>Retail Price</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($shafts as $shaft)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $shaft->code }}</td>
                            <td>{{ $shaft->shaft }}</td>
                            <td>{{ $shaft->flex }}</td>
                            <td>{{ $shaft->length }}"</td>
                            <td>{{ $shaft->weight }}g</td>
                            <td>
                                @if ($shaft->stock < 0)
                                    <span class="text-danger">{{ $shaft->stock }}</span>
                                @else
                                    <span>{{ number_format($shaft->stock) }}</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($shaft->retail) }}</td>
                            <td class="text-center">
                                <x-component.button-icon label="Detail" icon="bx-detail"
                                    href="{{ route('shaft.list.show', $shaft->code) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>
</x-layout>
