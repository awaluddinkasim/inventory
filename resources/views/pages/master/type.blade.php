<x-layout>
    <div class="card">
        <div class="card-body">
            <x-form.modal label="tambahData" title="types" action="{{ route('master.type.store') }}">
                <x-form.input label="mfg" name="mfg" id="mfg" :required="true" />
                <x-form.input label="name" name="name" id="name" :required="true" />

            </x-form.modal>
            <x-component.datatable id="typeTable">
                <thead>

                        <th>#</th>
                        <th>MFG</th>
                        <th>Name</th>
                        <th></th>

                </thead>
                <tbody>
                    @foreach ($types as $type)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $type->name }}</td>
                            <td>{{ $type->mfg }}</td>



                                <td class="text-center">

                                    <form
                                        action="{{ route('master.type.destroy', $type->id) }}"
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
