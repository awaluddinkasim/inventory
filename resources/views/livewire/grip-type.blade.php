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
            @forelse ($types as $type)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $type->mfg }}</td>
                    <td>{{ $type->name }}</td>

                    <td class="text-center">
                        <button type="button" class="btn btn-primary" wire:click="edit({{ $type->id }})"
                            wire:loading.attr="disabled">
                            Edit
                        </button>
                        @can('delete', $type)
                            <form action="{{ route('master.type.destroy', $type->id) }}" class="d-inline" method="POST">
                                @method('DELETE')
                                @csrf
                                <x-component.button type="submit" label="Delete" color="danger" />
                            </form>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No Data Available</td>
                </tr>
            @endforelse
        </tbody>
    </x-component.table>

    <div class="mt-3">
        {{ $types->links() }}
    </div>

    <x-component.modal id="editModal" title="Edit Data">
        <form action="@if ($currentEdit) {{ route('master.type.update', $currentEdit->id) }} @endif"
            method="POST" autocomplete="off">
            @csrf
            @method('PATCH')
            <div class="modal-body">
                <x-form.input label="MFG" name="mfg" id="mfgInput" :value="$currentEdit?->mfg" :required="true" />
                <x-form.input label="Name" name="name" id="nameInput" :value="$currentEdit?->name" :required="true" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </x-component.modal>
</div>
