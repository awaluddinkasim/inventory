<x-layout title="Edit Grip">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Edit Grip</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('grip.items.update', $grip->id) }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
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
                        <x-form.input label="Image" type="file" name="img" id="imgInput"
                            accept=".jpg,.jpeg,.png" />
                        <x-component.button label="Save Changes" color="primary" type="submit" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('assets/img/illustrations/server.svg') }}" alt="">
        </div>
    </div>
</x-layout>
