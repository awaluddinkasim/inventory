<x-layout title="Master Models">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Models</h5>
                <x-form.modal label="New Model" title="Form Model" action="{{ route('grip.model.store') }}">
                    <x-form.select label="Type" name="type_id" id="typeSelect" :required="true">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->brand }} - {{ $type->name }}</option>
                        @endforeach
                    </x-form.select>
                    <x-form.input label="Name" name="name" id="nameInput" :required="true" />
                    <x-form.input label="URL" name="url" id="urlInput" helperText="Leave empty if not exist" />
                </x-form.modal>
            </div>
        </div>
        <div class="card-body">
            <livewire:grip-model :$types />
        </div>
    </div>

</x-layout>
