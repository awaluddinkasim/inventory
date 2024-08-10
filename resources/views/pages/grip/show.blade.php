<x-layout title="Grip Detail">
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Grip Model Type</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="mb-0">Brand</h5>
                        <p>{{ $grip->model->type->brand }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="mb-0">Type</h5>
                        <p>{{ $grip->model->type->name }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="mb-0">Model</h5>
                        <p>{{ $grip->model->name }}</p>
                    </div>
                    <div class="mb-3">
                        <h5 class="mb-0">Link</h5>
                        <p>
                            @if ($grip->model->url)
                                <a href="{{ $grip->model->url }}" target="_blank">{{ $grip->model->url }}</a>
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
                    <h5 class="card-title">Grip Detail</h5>
                </div>
                <div class="card-body">
                    <div class="mb-5 img-container text-center">
                        <img src="{{ asset('img/grips/' . $grip->img) }}" alt="" style="height: 300px"
                            class="img-fluid rounded">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="mb-0">Size</h5>
                                <p>{{ $grip->size }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Color</h5>
                                <p>{{ $grip->color }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Weight</h5>
                                <p>{{ $grip->weight }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Core Size</h5>
                                <p>{{ $grip->core_size }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="mb-0">Wholesale Price</h5>
                                <p>Rp. {{ number_format($grip->wholesale) }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Retail Percentage</h5>
                                <p>{{ number_format($grip->percent) }}%</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Retail Price</h5>
                                <p>Rp. {{ number_format($grip->retail) }}</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Stock</h5>
                                <p>{{ $grip->stock->sum('quantity') }}</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <x-component.button-icon icon="bx-edit" label="Edit" color="primary"
                                href="{{ route('grip.items.edit', $grip) }}" />
                            @can('delete', $grip)
                                <form action="{{ route('grip.items.destroy', $grip) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <x-component.button-icon icon="bx-trash" label="Delete" color="danger" type="submit" />
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
