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


                                <td class="text-center">
                                    <x-component.button label="Edit"
                                        href="{{ route('grips.edit', $grip->id) }}" />
                                    <form
                                        action="{{ route('grips.destroy', $grip->id) }}"
                                        class="d-inline" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <x-component.button type="submit" label="Hapus" color="danger" />
                                    </form>
                                </td>

                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>

</x-layout>
