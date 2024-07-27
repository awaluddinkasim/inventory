<x-layout title="Grips">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Grips</h5>
                <x-form.modal label="New Data" title="Form Grip" action="{{ route('grips.store') }}">
                    <x-form.select label="Model" name="model_id" id="modelSelect" :required="true">
                        @foreach ($models as $model)
                            <option value="{{ $model->id }}">{{ $model->name }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.datalist label="Size" name="size" id="sizeInput" :required="true">
                        @foreach ($sizes as $size)
                            <option value="{{ $size }}">{{ $size }}</option>
                        @endforeach
                    </x-form.datalist>
                    <x-form.input label="Color" name="color" id="colorInput" :required="true" />
                    <x-form.input label="Weight" name="weight" id="weightInput" :required="true" />
                    <x-form.input label="Core Size" name="core_size" id="coreSizeInput" :required="true" />
                    <x-form.input label="Wholesale Price" name="wholesale" id="wholesaleInput" :isNumeric="true"
                        :required="true" />
                    <x-form.input label="Retail Percentage (%)" name="percent" id="percentInput" :isNumeric="true"
                        :required="true" />
                </x-form.modal>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="gripTable">
                <thead>
                    <th>#</th>
                    <th>Model</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Weight</th>
                    <th>Core Size</th>
                    <th>Wholesale Price</th>
                    <th>Percent</th>
                    <th>Retail</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($grips as $grip)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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
                            <td>{{ $grip->weight }}</td>
                            <td>{{ $grip->core_size }}</td>
                            <td>Rp. {{ number_format($grip->wholesale) }}</td>
                            <td>{{ $grip->percent }}%</td>
                            <td>Rp. {{ number_format($grip->retail) }}</td>
                            <td class="text-center">
                                <x-component.button label="Detail" href="{{ route('grips.show', $grip->id) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>
</x-layout>
