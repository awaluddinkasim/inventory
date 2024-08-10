<x-layout title="Shaft Types">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Types</h5>
                <x-form.modal label="New Type" title="Form Type" action="{{ route('shaft.type.store') }}">

                    <x-form.input label="brand" name="brand" id="brandInput" :required="true" />
                    <x-form.input label="Name" name="name" id="nameInput" :required="true" />
                    <x-form.input label="url"  name="url" id="urlInput" :required="true" />
                </x-form.modal>
            </div>
        </div>
        <div class="card-body">
            <livewire:shaft-type :$brands />
        </div>
    </div>

</x-layout>
