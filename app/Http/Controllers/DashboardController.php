<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Category;
use App\Models\Region;
use App\Models\Salesperson;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Sale::sum('total_sales');
        $totalUnitSold = Sale::sum('units_sold');

        $salesByRegion = Sale::select('regions.name as region', DB::raw('SUM(total_sales) as total'))
            ->join('regions', 'sales.region_id', '=', 'regions.id')
            ->groupBy('regions.name')
            ->get();

        $salesByCategory = Sale::select('categories.name as category', DB::raw('SUM(sales.total_sales) as total'))
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->get();

        $topSalespeople = Sale::select('salespeople.name', DB::raw('SUM(sales.total_sales) as total'))
            ->join('salespeople', 'sales.salesperson_id', '=', 'salespeople.id')
            ->groupBy('salespeople.name')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $recentSales = Sale::with(['product', 'region', 'salesperson'])->latest()->take(10)->get();

        return view('dashboard.index', compact('totalSales', 'totalUnitsSold'));
    }
}
