<x-layout title="Shaft Detail">
    <div class="row">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Shaft Detail</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h5 class="mb-0">MFG</h5>
                        <p></p>
                    </div>
                    <div class="mb-3">
                        <h5 class="mb-0">Type</h5>
                        <p></p>
                    </div>
                    <div class="mb-3">
                        <h5 class="mb-0">Model</h5>
                        <p></p>
                    </div>
                    <div class="mb-3">
                        <h5 class="mb-0">Link</h5>
                        <p>

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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="mb-0">Size</h5>
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Color</h5>
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Weight</h5>
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Core Size</h5>
                                <p></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <h5 class="mb-0">Wholesale Price</h5>
                                <p>Rp</p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Retail Percentage</h5>
                                <p></p>
                            </div>
                            <div class="mb-3">
                                <h5 class="mb-0">Retail Price</h5>
                                <p></p>
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
