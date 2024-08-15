<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Name</th>
            <th>Shaft</th>
            <th>Flex</th>
            <th>Length</th>
            <th>Weight</th>
            <th>Stock</th>
            <th>WholeSale</th>
            <th>Retail Price</th>
        </tr>
    </thead>
    <tbody>
       
            @foreach ($shafts as $shaft )

            <tr>
            <td>{{ $loop->iteration }}</td>

            <td>{{ $shaft->type->brand }}</td>

            <td>{{ $shaft->type->name }}</td>
            <td>{{ $shaft->shaft }}</td>
            <td>{{ $shaft->length }}</td>
            <td>{{ $shaft->weight }}</td>
            <td>{{ $shaft->stock }}</td>
            <td>{{ $shaft->wholesale }}</td>
            <td>{{ $shaft->retail }}</td>
            @endforeach
        </tr>
    </tbody>
</table>
