@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📊 Dashboard</h1>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="alert alert-primary">
                <h4>Total Sales: ${{ number_format($totalSales, 2) }}</h4>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Sales by Region</h5>
            <ul class="list-group">
                @foreach($salesByRegion as $region)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $region->region }}
                        <span>${{ number_format($region->total, 2) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="col-md-6">
            <h5>Sales by Category</h5>
            <ul class="list-group">
                @foreach($salesByCategory as $category)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $category->category }}
                        <span>${{ number_format($category->total, 2) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <h5>Top Salespeople</h5>
            <ul class="list-group">
                @foreach($topSalespeople as $sp)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $sp->name }}
                        <span>${{ number_format($sp->total, 2) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5>Recent Sales</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Region</th>
                        <th>Salesperson</th>
                        <th>Total Sale</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentSales as $sale)
                        <tr>
                            <td>{{ $sale->sale_date }}</td>
                            <td>{{ $sale->product->name ?? 'N/A' }}</td>
                            <td>{{ $sale->product->category->name ?? 'N/A' }}</td>
                            <td>{{ $sale->region->name ?? 'N/A' }}</td>
                            <td>{{ $sale->salesperson->name ?? 'N/A' }}</td>
                            <td>${{ number_format($sale->total_sales, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection