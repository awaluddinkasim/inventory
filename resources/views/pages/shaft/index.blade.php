<x-layout title="Shafts">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Shafts</h5>

                <x-form.modal label="New Item" title="Form Grip" action="{{ route('shaft.items.store') }}"
                    :hasFile="true">
                    <x-form.select-search label="Type" id="type" name="type_id" required="true"
                        modalId="formModal">
                        @foreach ($types as $type)
                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </x-form.select-search>
                    <x-form.input label="Shaft" type="text" id="shaft" name="shaft" required="true" />
                    <x-form.input label="Flex" type="text" id="flex" name="flex" required="true" />
                    <div class="row">
                        <div class="col-md-6">
                            <x-form.input label="Length" type="text" id="text" name="length" isNumeric="true"
                                required="true" />
                        </div>
                        <div class="col-md-6">
                            <x-form.input label="Weight" type="text" id="text" name="weight" isNumeric="true"
                                required="true" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <x-form.input label="Wholesale Price" name="wholesale" id="wholesaleInput" :isNumeric="true"
                                :required="true" />
                        </div>
                        <div class="col-md-5">
                            <x-form.input label="Retail Percentage (%)" name="percent" id="percentInput"
                                :isNumeric="true" :required="true" />
                        </div>
                    </div>
                    <x-form.image label="Image" name="img" id="imgInput" :required="true" />
                </x-form.modal>
            </div>
        </div>
        <div class="card-body">
            <x-component.datatable id="gripTable">
                <thead>
                    <th>#</th>
                    <th>Shaft</th>
                    <th>Flex</th>
                    <th>Length</th>
                    <th>Weight</th>
                    <th>Retail Price</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($shafts as $shaft)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $shaft->shaft }}</td>
                            <td>{{ $shaft->flex }}</td>
                            <td>{{ $shaft->length }}"</td>
                            <td>{{ $shaft->weight }}g</td>
                            <td>Rp. {{ number_format($shaft->retail) }}</td>
                            <td class="text-center">
                                <x-component.button-icon label="Detail" icon="bx-detail"
                                    href="{{ route('shaft.items.show', $shaft->code) }}" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>
</x-layout>
