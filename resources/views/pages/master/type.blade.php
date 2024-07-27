<x-layout title="Master Types">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Types</h5>
                <x-form.modal label="New Type" title="Form Type" action="{{ route('master.type.store') }}">
                    <x-form.input label="MFG" name="mfg" id="mfgInput" :required="true" />
                    <x-form.input label="Name" name="name" id="nameInput" :required="true" />
                </x-form.modal>
            </div>
        </div>
        <div class="card-body">
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
                                <form action="{{ route('master.type.destroy', $type->id) }}" class="d-inline"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <x-component.button type="submit" label="Delete" color="danger" />
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>

</x-layout>
