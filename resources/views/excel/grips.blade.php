<table>
    <thead>
        <tr>
            <th style="width: 50px">#</th>
            <th>Brand</th>
            <th>Type</th>
            <th>Model</th>
            <th>Size</th>
            <th>Color</th>
            <th>Weight</th>
            <th>Core Size</th>
            <th>Stock</th>
            <th>Wholesale Price</th>
            <th>Retail Price</th>
        </tr>
    </thead>
    <tbody>
        @php
            $prevBrand = null;
            $prevType = null;
            $prevModel = null;
            $brandRowspan = 0;
            $typeRowspan = 0;
            $modelRowspan = 0;
        @endphp

        @foreach ($grips as $index => $grip)
            @php
                $currentBrand = $grip->model->type->brand;
                $currentType = $grip->model->type->name;
                $currentModel = $grip->model->name;
            @endphp

            <tr>
                <td>{{ $loop->iteration }}</td>
                @if ($currentBrand !== $prevBrand)
                    @php
                        $brandRowspan = $grips->filter(fn($g) => $g->model->type->brand === $currentBrand)->count();
                        $prevBrand = $currentBrand;
                    @endphp
                    <td rowspan="{{ $brandRowspan }}" style="vertical-align: middle">{{ $currentBrand }}</td>
                @endif

                @if ($currentType !== $prevType || $currentBrand !== $prevBrand)
                    @php
                        $typeRowspan = $grips
                            ->filter(
                                fn($g) => $g->model->type->brand === $currentBrand &&
                                    $g->model->type->name === $currentType,
                            )
                            ->count();
                        $prevType = $currentType;
                    @endphp
                    <td rowspan="{{ $typeRowspan }}" style="vertical-align: middle">{{ $currentType }}</td>
                @endif

                @if ($currentModel !== $prevModel || $currentType !== $prevType || $currentBrand !== $prevBrand)
                    @php
                        $modelRowspan = $grips
                            ->filter(
                                fn($g) => $g->model->type->brand === $currentBrand &&
                                    $g->model->type->name === $currentType &&
                                    $g->model->name === $currentModel,
                            )
                            ->count();
                        $prevModel = $currentModel;
                    @endphp
                    <td rowspan="{{ $modelRowspan }}" style="vertical-align: middle">{{ $currentModel }}</td>
                @endif

                <td>{{ $grip->size }}</td>
                <td>{{ $grip->color }}</td>
                <td>{{ $grip->weight }}g</td>
                <td>{{ $grip->core_size }}</td>
                <td>{{ $grip->stock }}</td>
                <td data-format="#,##0">{{ $grip->wholesale }}</td>
                <td data-format="#,##0">{{ $grip->retail }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
