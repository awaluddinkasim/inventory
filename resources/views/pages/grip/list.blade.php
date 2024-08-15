@push('scripts')
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
                    window.open('{{ route('grip.export') }}', '_blank');
                }
            })
        }
    </script>
@endpush

<x-layout title="Grip List">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Grip List</h5>
                <div>
                    @if ($grips->count())
                        <button class="btn btn-success" onclick="exportExcel()">
                            <i class="fa fa-file-excel"></i>
                        </button>
                    @endif
                    <x-form.modal label="New Grip" title="Form Grip" action="{{ route('grip.list.store') }}"
                        :hasFile="true">
                        <x-form.select-search label="Model" name="model_id" id="modelSelect" :required="true"
                            modalId="formModal">
                            @foreach ($models as $model)
                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                            @endforeach
                        </x-form.select-search>
                        <div class="row">
                            <div class="col-md-6">
                                <x-form.datalist label="Size" name="size" id="sizeInput" :required="true">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </x-form.datalist>
                            </div>
                            <div class="col-md-6">
                                <x-form.input label="Color" name="color" id="colorInput" :required="true" />
                            </div>
                        </div>
                        <x-form.input label="Weight" name="weight" id="weightInput" :isNumeric="true"
                            :required="true" />
                        <x-form.input label="Core Size" name="core_size" id="coreSizeInput" :required="true" />
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
                    <th>Model</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Weight</th>
                    <th>Core Size</th>
                    <th>Stock</th>
                    <th>Retail Price</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($grips as $grip)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $grip->code }}</td>
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
                            <td>{{ $grip->weight }}g</td>
                            <td>{{ $grip->core_size }}</td>
                            <td>
                                @if ($grip->stock < 0)
                                    <span class="text-danger">{{ $grip->stock }}</span>
                                @else
                                    <span>{{ number_format($grip->stock) }}</span>
                                @endif
                            </td>
                            <td>Rp. {{ number_format($grip->retail) }}</td>
                            <td class="text-center">
                                <x-component.button-icon label="Detail" icon="bx-detail"
                                    href="{{ route('grip.list.show', $grip->code) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>
</x-layout>