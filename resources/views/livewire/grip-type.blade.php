@script
    <script>
        $wire.on('open-modal', () => {
            $('#editModal').modal('show');
        })
    </script>
@endscript

<div>
    <x-component.table>
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
                    <td>{{ $type->mfg }}</td>
                    <td>{{ $type->name }}</td>

                    <td class="text-center">
                        <button type="button" class="btn btn-primary" wire:click="edit({{ $type->id }})">
                            Edit
                        </button>
                        <form action="{{ route('master.type.destroy', $type->id) }}" class="d-inline" method="POST">
                            @method('DELETE')
                            @csrf
                            <x-component.button type="submit" label="Delete" color="danger" />
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-component.table>

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form
                    action="@if ($currentEdit) {{ route('master.type.update', $currentEdit->id) }} @endif"
                    method="POST" autocomplete="off">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <x-form.input label="MFG" name="mfg" id="mfgInput" :value="$currentEdit?->mfg"
                            :required="true" />
                        <x-form.input label="Name" name="name" id="nameInput" :value="$currentEdit?->name"
                            :required="true" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
