<x-layout title="Master Types">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Types</h5>
                <x-form.modal label="New Type" title="Form Type" action="{{ route('master.type.store') }}">
                    <x-form.datalist label="MFG" name="mfg" id="mfgInput" :required="true">
                        @foreach ($mfgs as $mfg)
                            <option value="{{ $mfg }}">{{ $mfg }}</option>
                        @endforeach
                    </x-form.datalist>
                    <x-form.input label="Name" name="name" id="nameInput" :required="true" />
                </x-form.modal>
            </div>
        </div>
        <div class="card-body">
            <livewire:grip-type :$mfgs />
        </div>
    </div>

</x-layout>
