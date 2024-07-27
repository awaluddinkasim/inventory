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
            <th>Type</th>
            <th>Name</th>
            <th>Url</th>
            <th></th>
        </thead>
        <tbody>
            @foreach ($models as $model)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $model->type->name }}</td>
                    <td>{{ $model->name }}</td>
                    <td><a href="{{ $model->url }}" target="_blank">{{ $model->url }}</a></td>

                    <td class="text-center">
                        <button type="button" class="btn btn-primary" wire:click="edit({{ $model->id }})"
                            wire:loading.attr="disabled">
                            Edit
                        </button>
                        <form action="{{ route('master.model.destroy', $model->id) }}" class="d-inline" method="POST">
                            @method('DELETE')
                            @csrf
                            <x-component.button type="submit" label="Delete" color="danger" />
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </x-component.table>

    <x-component.modal id="editModal" title="Edit Data">
        <form action="@if ($currentEdit) {{ route('master.model.update', $currentEdit->id) }} @endif"
            method="POST" autocomplete="off">
            @csrf
            @method('PATCH')
            <div class="modal-body">
                <x-form.select label="Type" name="type_id" id="typeSelect" :required="true">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" @if ($currentEdit?->type_id == $type->id) selected @endif>
                            {{ $type->mfg }} - {{ $type->name }}</option>
                    @endforeach
                </x-form.select>
                <x-form.input label="Name" name="name" id="nameInput" :value="$currentEdit?->name" :required="true" />
                <x-form.input label="URL" name="url" id="urlInput" :value="$currentEdit?->url" :required="true" />
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
