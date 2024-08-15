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
            <th>Brand</th>
            <th>Name</th>
            <th></th>
        </thead>
        <tbody>
            @forelse ($types as $type)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $type->brand }}</td>
                    <td>{{ $type->name }}</td>

                    <td class="text-center">
                        <button type="button" class="btn btn-primary btn-sm" wire:click="edit({{ $type->id }})"
                            wire:loading.attr="disabled">
                            Edit
                        </button>
                        @can('delete', $type)
                            <form action="{{ route('grip.type.destroy', $type->id) }}" class="d-inline" method="POST">
                                @method('DELETE')
                                @csrf
                                <x-component.button type="submit" label="Delete" color="danger" :small="true" />
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
        <form action="@if ($currentEdit) {{ route('grip.type.update', $currentEdit->id) }} @endif"
            method="POST" autocomplete="off">
            @csrf
            @method('PATCH')
            <div class="modal-body">
                <x-form.datalist label="Brand" name="brand" id="brandInput" :value="$currentEdit?->brand" :required="true">
                    @foreach ($brands as $brand)
                        <option value="{{ $brand }}">{{ $brand }}</option>
                    @endforeach
                </x-form.datalist>
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
