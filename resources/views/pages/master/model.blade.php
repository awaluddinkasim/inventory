<x-layout title="Master Models">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Models</h5>
                <x-form.modal label="New Model" title="Form Model" action="{{ route('master.model.store') }}">
                    <x-form.select label="Type" name="type_id" id="typeSelect" :required="true">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->mfg }} - {{ $type->name }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.input label="Name" name="name" id="nameInput" :required="true" />
                    <x-form.input label="URL" name="url" id="urlInput" :required="true" />
                </x-form.modal>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="modelTable">
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
                                <form action="{{ route('master.model.destroy', $model->id) }}" class="d-inline"
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
