<x-layout>
    <div class="card">
        <div class="card-body">
            <x-form.modal label="tambahData" title="models" action="{{ route('master.model.store') }}">
                <x-form.input label="name" name="name" id="name" :required="true" />
                <x-form.input label="url" name="url" id="url" :required="true" />
                <x-form.select label="type_id" id="type_id" name="type_id" :required="true">
                    @foreach ($types as $type )

                    <option value="{{ $type->id }}">{{ $type->mfg }} || {{ $type->name }}</option>
                    @endforeach

                </x-form.select>
            </x-form.modal>
            <x-component.datatable id="modelTable">
                <thead>

                        <th>#</th>
                        <th>Name</th>
                        <th>Url</th>
                        <th></th>

                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $model->name }}</td>
                            <td>{{ $model->url }}</td>



                                <td class="text-center">

                                    <form
                                        action="{{ route('master.model.destroy', $model->id) }}"
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
