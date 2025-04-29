<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>Product</th>
            <th>Region</th>
            <th>Salesperson</th>
            <th>Units Sold</th>
            <th>Total Sales</th>
        </tr>
    </thead>
    <tbody>
        @foreach($recentSales as $sale)
            <tr>
                <td>{{ $sale->product->name ?? 'N/A' }}</td>
                <td>{{ $sale->region->name ?? 'N/A' }}</td>
                <td>{{ $sale->salesperson->name ?? 'N/A' }}</td>
                <td>{{ $sale->units_sold }}</td>
                <td>
                    ${{ number_format($sale->units_sold * ($sale->product->price ?? 0), 2) }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

