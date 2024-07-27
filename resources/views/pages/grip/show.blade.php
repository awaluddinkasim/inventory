<x-layout>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('grips.update', $grip->id) }}" method="POST">
                        <x-form.input value="{{ $grip->size }}" label="size" name="size" id="size" :required="true" />
                        <x-form.input value="{{ $grip->color }}" label="color" name="color" id="color" :required="true" />
                        <x-form.input value="{{ $grip->weight }}" label="weight" name="weight" id="weight" :required="true" />
                        <x-form.input value="{{ $grip->core_size }}" label="core size" name="core_size" id="core_size" :required="true" />
                        <x-form.input value="{{ $grip->wholesale }}" label="wholesale" type="number" name="wholesale" id="wholesale" :required="true" />
                        <x-form.input value="{{ $grip->percent }}" label="percent" type="number" name="percent" id="percent" :required="true" />
                        @csrf
                        @method('put')
                        <x-form.select label="model" id="model_id" name="model_id" :required="true">
                            @foreach ($models as $model )

                            <option value="{{ $model->id }}" @if($model->id == $grip->model_id) selected @endif>{{ $model->name }}</option>
                            @endforeach

                        </x-form.select>
                        <x-component.button label="edit" :block="True" href="{{ route('grips.edit', $grip->id) }}" />
                        <form
                        action="{{ route('grips.destroy', $grip->id) }}"
                        class="d-inline" method="POST">
                        @method('DELETE')
                        @csrf
                        <x-component.button type="submit" label="Hapus" color="danger" />
                    </form>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

        </div>
    </div>
</x-layout>
