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
                    <h5 class="card-title">Edit Shaft</h5>
                </div>
                <div class="card-body">
                    <div class="img-container text-center mb-3" style="height: 250px">
                        <img src="{{ asset('img/shafts/' . $shaft->img) }}" alt="" class="img-fluid rounded">
                    </div>

                    <form action="{{ route('shaft.items.update', $shaft->code) }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
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
            <img src="{{ asset('assets/img/illustrations/server.svg') }}" alt="">
        </div>
    </div>
</x-layout>
