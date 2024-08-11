<x-layout title="Shaft Detail">
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Shaft Type</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="mb-0">Shaft</h5>
                        <p>{{ $shaft->shaft }}</p>
                    </div>

                    <div class="mb-3">
                        <h5 class="mb-0">Brand</h5>
                        <p>{{ $shaft->type->brand }}</p>
                    </div>

                    <div class="mb-3">
                        <h5 class="mb-0">Link</h5>
                        <p>
                            {{ $shaft->type->url }}
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
                    <div class="mb-5 img-container text-center">
                        <img src="{{ asset('img/shafts/' . $shaft->img) }}" alt="" style="height: 300px"
                            class="img-fluid rounded">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="mb-0">Code</h5>
                                <p>{{ $shaft->code }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Type</h5>
                                <p>{{ $shaft->type->name }}</p>
                            </div>

                            <div class="mb-3">
                                <h5 class="mb-0">Length</h5>
                                <p>{{ $shaft->length }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="mb-0">Weight</h5>
                                <p>{{ $shaft->weight }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">WholeSale</h5>
                                <p>Rp. {{ $shaft->wholesale }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Percent</h5>
                                <p>{{ $shaft->percent }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Stock</h5>
                                <p></p>
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
