<x-layout>
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('grips.update', $grip->id) }}" method="POST">
                        <x-form.input label="size" name="size" id="size" :required="true" />
                        <x-form.input label="color" name="color" id="color" :required="true" />
                        <x-form.input label="weight" name="weight" id="weight" :required="true" />
                        <x-form.input label="core size" name="core_size" id="core_size" :required="true" />
                        <x-form.input label="wholesale" type="number" name="wholesale" id="wholesale" :required="true" />
                        <x-form.input label="percent" type="number" name="percent" id="percent" :required="true" />
                        @csrf
                        @method('put')
                        <x-component.button label="simpan" :block="True" type="submit" />


                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">

        </div>
    </div>
</x-layout>
