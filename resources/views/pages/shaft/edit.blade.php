@push('scripts')
    <script>
        $('#typeSelect').on('change', function() {
            let text = this.options[this.selectedIndex].text;

            let type = text.split('-')[1].trim();

            $('#shaftInput').val(type + '-');
            $('#shaftInput').focus();
        })
    </script>
@endpush

<x-layout title="Shaft Grip">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-2">Edit Shaft</h5>
                    <div class="card-subtitle">
                        <a href="{{ route('shaft.items.show', $shaft->code) }}" class="d-flex align-items-center">
                            <i class="bx bx-left-arrow me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('shaft.items.update', $shaft->code) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PATCH')
                        <x-form.select-search label="Type" name="type_id" id="typeSelect" :required="true">
                            @foreach ($types as $type)
                                <option value="{{ $type->id }}" @if ($type->id == $shaft->type_id) selected @endif>
                                    {{ $type->brand }} - {{ $type->name }}
                                </option>
                            @endforeach
                        </x-form.select-search>
                        <x-form.input value="{{ $shaft->shaft }}" label="Shaft" name="shaft" id="shaftInput"
                            :required="true" />
                        <x-form.input value="{{ $shaft->flex }}" label="Flex" name="flex" id="flexInput"
                            :required="true" />

                        <div class="row">
                            <div class="col-md-6">
                                <x-form.input value="{{ $shaft->length }}" label="Length" name="length"
                                    id="lengthInput" :required="true" />
                            </div>
                            <div class="col-md-6">
                                <x-form.input value="{{ $shaft->weight }}" label="Weight" name="weight"
                                    id="weightInput" :isNumeric="true" :required="true" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <x-form.input label="Wholesale Price" name="wholesale" id="wholesaleInput"
                                    value="{{ $shaft->wholesale }}" :isNumeric="true" :required="true" />
                            </div>
                            <div class="col-md-5">
                                <x-form.input label="Retail Percentage (%)" name="percent" id="percentInput"
                                    value="{{ $shaft->percent }}" :isNumeric="true" :required="true" />
                            </div>
                        </div>
                        <x-form.image label="Image" name="img" id="imgInput" />
                        <x-component.button label="Save Changes" color="primary" type="submit" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Shaft Images</h5>
                        <x-form.modal title="Add Shaft Image"
                            action="{{ route('shaft.items.image.store', $shaft->code) }}" label="Upload"
                            :hasFile="true">
                            <x-form.image label="Image" name="img" id="imgInput" />
                        </x-form.modal>
                    </div>
                </div>
                <div class="card-body">
                    <x-component.datatable id="shaftImages">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shaft->images as $image)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $image->filename }}
                                    </td>
                                    <td>
                                        <a href="{{ asset('img/shafts/' . $image->filename) }}" target="_blank"
                                            class="btn btn-sm btn-info">
                                            View
                                        </a>
                                        <form action="{{ route('shaft.items.image.destroy', $image->id) }}"
                                            class="d-inline" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-component.datatable>
                </div>
            </div>
        </div>
    </div>
</x-layout>
