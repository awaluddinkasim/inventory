<x-layout title="Edit Grip">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-2">Edit Grip</h5>
                    <div class="card-subtitle">
                        <a href="{{ route('grip.items.show', $grip->code) }}" class="d-flex align-items-center">
                            <i class="bx bx-left-arrow me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('grip.items.update', $grip->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PATCH')
                        <x-form.select-search label="Model" name="model_id" id="modelSelect" :required="true">
                            @foreach ($models as $model)
                                <option value="{{ $model->id }}" @if ($model->id == $grip->model_id) selected @endif>
                                    {{ $model->name }}</option>
                            @endforeach
                        </x-form.select-search>
                        <div class="row">
                            <div class="col-md-6">
                                <x-form.datalist value="{{ $grip->size }}" label="Size" name="size"
                                    id="sizeInput" :required="true">
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </x-form.datalist>
                            </div>
                            <div class="col-md-6">
                                <x-form.input value="{{ $grip->color }}" label="Color" name="color" id="colorInput"
                                    :required="true" />
                            </div>
                        </div>
                        <x-form.input value="{{ $grip->weight }}" label="Weight" :isNumeric="true" name="weight"
                            id="weightInput" :required="true" />
                        <x-form.input value="{{ $grip->core_size }}" label="Core Size" name="core_size"
                            id="coreSizeInput" :required="true" />
                        <div class="row">
                            <div class="col-md-7">
                                <x-form.input value="{{ $grip->wholesale }}" label="Wholesale Price" name="wholesale"
                                    id="wholesaleInput" :isNumeric="true" :required="true" />
                            </div>
                            <div class="col-md-5">
                                <x-form.input value="{{ $grip->percent }}" label="Retail Percentage (%)" name="percent"
                                    id="percentInput" :isNumeric="true" :required="true" />
                            </div>
                        </div>
                        <x-component.button label="Save Changes" color="primary" type="submit" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Grip Images</h5>
                        <x-form.modal title="Add Grip Image"
                            action="{{ route('grip.items.image.store', $grip->code) }}" label="Upload"
                            :hasFile="true">
                            <x-form.image label="Image" name="img" id="imgInput" />
                        </x-form.modal>
                    </div>
                </div>
                <div class="card-body">
                    <x-component.datatable id="gripImages">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grip->images as $image)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $image->filename }}
                                    </td>
                                    <td>
                                        <a href="{{ asset('img/grips/' . $image->filename) }}" target="_blank"
                                            class="btn btn-sm btn-info">
                                            View
                                        </a>
                                        <form action="{{ route('grip.items.image.destroy', $image->id) }}"
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
