<x-layout>
    <div class="card">
        <div class="card-body">
           
            <x-component.datatable id="gripTable">
                <thead>

                        <th>#</th>
                        <th>Size</th>
                        <th>Color</th>
                        <th>Weight</th>
                        <th>Core Size</th>
                        <th>Wholesale</th>
                        <th>Percent</th>
                        <th></th>

                </thead>
                <tbody>
                    @foreach ($grips as $grip)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $grip->size }}</td>
                            <td>{{ $grip->color }}</td>
                            <td>{{ $grip->weight }}</td>
                            <td>{{ $grip->core_size }}</td>
                            <td>{{ $grip->wholesale }}</td>
                            <td>{{ $grip->percent }}</td>


                                <td class="text-center">
                                    <x-component.button label="Edit"
                                        href="{{ route('grips.edit', $grip->id) }}" />
                                    <form
                                        action="{{ route('grips.destroy', $grip->id) }}"
                                        class="d-inline" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <x-component.button type="submit" label="Hapus" color="danger" />
                                    </form>
                                </td>

                        </tr>
                    @endforeach
                </tbody>
            </x-component.datatable>
        </div>
    </div>

</x-layout>
