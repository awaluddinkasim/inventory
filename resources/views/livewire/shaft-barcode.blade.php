<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Select Grip</h5>
            </div>
            <div class="card-body">
                <x-form.select label="Type" name="type" id="typeSelect" wire:model.live="selectedType">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->brand }} - {{ $type->name }}</option>
                    @endforeach
                </x-form.select>
                <x-form.select label="Shaft" name="shaft" id="shaftSelect" wire:model.live="selectedShaft">
                    @foreach ($shafts as $item)
                        <option value="{{ $item->id }}">{{ $item->shaft }}</option>
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
                @if ($shaft != null)
                    <img src="{{ asset(DNS1D::getBarcodeJPGPath($shaft->code, 'C39', 3, 100)) }}" alt=""
                        class="w-100 mt-4">
                    <div class="text-center mt-3">
                        <h4 class="mb-0">{{ $shaft->code }}</h4>
                        <p>{{ $shaft->shaft }}</p>
                    </div>

                    <div class="mt-4 text-center">
                        <a href="{{ asset('barcodes/' . $shaft->code . '.jpg') }}" class="btn btn-info"
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
