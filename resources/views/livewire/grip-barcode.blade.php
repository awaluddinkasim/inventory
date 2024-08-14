<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Select Grip</h5>
            </div>
            <div class="card-body">
                <x-form.select label="Model" name="model" id="modelSelect" wire:model.live="selectedModel">
                    @foreach ($models as $model)
                        <option value="{{ $model->id }}">{{ $model->name }}</option>
                    @endforeach
                </x-form.select>
                <x-form.select label="Size" name="size" id="sizeSelect" wire:model.live="selectedSize">
                    @foreach ($sizes as $size)
                        <option value="{{ $size }}">{{ $size }}</option>
                    @endforeach
                </x-form.select>
                <x-form.select label="Color" name="color" id="colorSelect" wire:model.live="selectedColor">
                    @foreach ($colors as $color)
                        <option value="{{ $color }}">{{ $color }}</option>
                    @endforeach
                </x-form.select>
                <x-component.button label="Generate Barcode" wire:click="generate" wire:loading.attr="disabled" />
            </div>
        </div>
    </div>
    <div class="col-md-5 my-2 my-md-0">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Barcode</h5>
            </div>
            <div class="card-body">
                @if ($grip != null)
                    <img src="{{ asset(DNS1D::getBarcodeJPGPath($grip->code, 'C39', 3, 100)) }}" alt=""
                        class="w-100 mt-4">
                    <div class="text-center mt-3">
                        <h4 class="mb-0">{{ $grip->code }}</h4>
                        <p>{{ $grip->model->name }} - {{ $grip->size }} ({{ $grip->color }})</p>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="{{ asset('barcodes/' . $grip->code . '.jpg') }}" class="btn btn-info"
                            download>Download</a>
                    </div>
                @else
                    <div class="text-center py-5 mb-4">
                        Please select a grip
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
