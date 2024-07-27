<x-layout title="Edit Grip">
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('grips.update', $grip->id) }}" method="POST" autocomplete="off">
                        @csrf
                        @method('PATCH')
                        <x-form.select label="Model" id="modelSelect" name="model_id" :required="true">
                            @foreach ($models as $model)
                                <option value="{{ $model->id }}" @if ($model->id == $grip->model_id) selected @endif>
                                    {{ $model->name }}</option>
                            @endforeach
                        </x-form.select>
                        <x-form.datalist value="{{ $grip->size }}" label="Size" name="size" id="sizeInput"
                            :required="true">
                            @foreach ($sizes as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </x-form.datalist>
                        <x-form.input value="{{ $grip->color }}" label="Color" name="color" id="colorInput"
                            :required="true" />
                        <x-form.input value="{{ $grip->weight }}" label="Weight" name="weight" id="weightInput"
                            :required="true" />
                        <x-form.input value="{{ $grip->core_size }}" label="Core Size" name="core_size"
                            id="coreSizeInput" :required="true" />
                        <x-form.input value="{{ $grip->wholesale }}" label="Wholesale Price" name="wholesale"
                            id="wholesaleInput" :isNumeric="true" :required="true" />
                        <x-form.input value="{{ $grip->percent }}" label="Retail Percentage (%)" name="percent"
                            id="percentInput" :isNumeric="true" :required="true" />
                        <x-component.button label="Save Changes" color="primary" type="submit" />
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

        </div>
    </div>
</x-layout>
