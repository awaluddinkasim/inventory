<x-layout title="Shaft Detail">
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Shaft Type</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="mb-0">Brand</h5>
                        <p>{{ $shaft->type->brand }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="mb-0">Type</h5>
                        <p>{{ $shaft->type->name }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="mb-0">Link</h5>
                        <p>
                            @if ($shaft->type->url)
                                <a href="{{ $shaft->type->url }}" target="_blank">{{ $shaft->type->url }}</a>
                            @else
                                -
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card my-2 my-md-0">
                <div class="card-header">
                    <h5 class="card-title">Shaft Detail</h5>
                </div>

                <div class="card-body">
                    @if ($shaft->images->count() > 0)
                        <x-component.img-carousel id="grip">
                            @foreach ($grip->images as $image)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img src="{{ asset('img/grips/' . $image->filename) }}" class="d-block"
                                        alt="{{ $image->filename }}">
                                </div>
                            @endforeach
                        </x-component.img-carousel>
                    @else
                        <div class="d-flex justify-content-center align-items-center bg-secondary rounded mb-5"
                            style="height: 300px">
                            <span class="text-white">No Image</span>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="mb-0">Code</h5>
                                <p>{{ $shaft->code }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Shaft</h5>
                                <p>{{ $shaft->shaft }}</p>
                            </div>

                            <div class="mb-3">
                                <h5 class="mb-0">Length</h5>
                                <p>{{ $shaft->length }}"</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Weight</h5>
                                <p>{{ $shaft->weight }}g</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="mb-0">WholeSale Price</h5>
                                <p>Rp. {{ number_format($shaft->wholesale) }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Retail Percentage</h5>
                                <p>{{ number_format($shaft->percent) }}%</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Retail Price</h5>
                                <p>Rp. {{ number_format($shaft->retail) }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Stock</h5>
                                <p>{{ $shaft->stock }}</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <x-component.button-icon icon="bx-edit" label="Edit" color="primary"
                                href="{{ route('shaft.items.edit', $shaft->code) }}" />
                            {{-- @can('delete', $shaft) --}}
                            <form action="{{ route('shaft.items.destroy', $shaft) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <x-component.button-icon icon="bx-trash" label="Delete" color="danger" type="submit" />
                            </form>
                            {{-- @endcan --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
