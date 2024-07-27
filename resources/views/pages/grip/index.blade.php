<x-layout>
    <div class="card">
        <div class="card-body">
            <x-form.modal label="tambahData" title="grips" action="{{ route('grips.store') }}">
                <x-form.input label="size" name="size" id="size" :required="true" />
                <x-form.input label="color" name="color" id="color" :required="true" />
                <x-form.input label="weight" name="weight" id="weight" :required="true" />
                <x-form.input label="core size" name="core_size" id="core_size" :required="true" />
                <x-form.input label="wholesale" type="number" name="wholesale" id="wholesale" :required="true" />
                <x-form.input label="percent" type="number" name="percent" id="percent" :required="true" />
                <x-form.select label="model" id="model_id" name="model_id" :required="true">
                    @foreach ($models as $model )

                    <option value="{{ $model->id }}">{{ $model->name }}</option>
                    @endforeach

                </x-form.select>
            </x-form.modal>
            <x-component.datatable id="gripTable">
                <thead>

                        <th>#</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Weight</th>
                        <th>Core Size</th>
                        <th>Wholesale</th>
                        <th>Percent</th>
                        <th>Nama Model</th>
                        <th>Retail</th>
                        <th></th>

                </thead>
                <tbody>
                    @foreach ($grips as $grip)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $grip->size }}</td>
                            <td>{{ $grip->color }}</td>
                            <td>{{ $grip->weight }}</td>
                            <td>{{ $grip->core_size }}</td>
                            <td>{{ $grip->wholesale }}</td>
                            <td>{{ $grip->percent }}</td>
                            <td>{{ $grip->model->name }}</td>
                            <td>{{ $grip->retail }}</td>


                                <td class="text-center">
                                    <x-component.button label="Show"
                                        href="{{ route('grips.show', $grip->id) }}" />

                                </td>

                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>

</x-layout>
