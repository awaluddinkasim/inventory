<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Brand</th>
            <th>Shaft</th>
            <th>Flex</th>
            <th>Length</th>
            <th>Weight</th>
            <th>Stock</th>
            <th>WholeSale Price</th>
            <th>Retail Price</th>
        </tr>
    </thead>
    <tbody>
        @php
            $prevBrand = null;
            $brandRowspan = 0;
        @endphp

        @foreach ($shafts as $shaft)
            @php
                $currentBrand = $shaft->type->brand;
            @endphp

            <tr>
                <td>{{ $loop->iteration }}</td>
                @if ($currentBrand !== $prevBrand)
                    @php
                        $brandRowspan = $shafts->filter(fn($s) => $s->type->brand === $currentBrand)->count();
                        $prevBrand = $currentBrand;
                    @endphp
                    <td rowspan="{{ $brandRowspan }}" style="vertical-align: middle">{{ $currentBrand }}</td>
                @endif
                <td>{{ $shaft->shaft }}</td>
                <td>{{ $shaft->flex }}</td>
                <td>{{ $shaft->length }}"</td>
                <td>{{ $shaft->weight }}g</td>
                <td>{{ $shaft->stock }}</td>
                <td data-format="#,##0">{{ $shaft->wholesale }}</td>
                <td data-format="#,##0">{{ $shaft->retail }}</td>
        @endforeach
        </tr>
    </tbody>
</table>
