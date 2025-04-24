<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\Category;
use App\Models\Product;
use App\Models\Region;
use App\Models\Salesperson;
use App\Models\Sale;
use Carbon\Carbon;

class SalesSeeder extends Seeder
{
    public function run()
    {
        $filePath = storage_path('app/sales_dataset_500_rows.xlsx');
        $spreadsheet = IOFactory::load($filePath);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        foreach (array_slice($rows, 1)as $row) {
            [$date, $productName, $categoryName, $regionName, $salespersonName, $unitsSold, $unitPrice, $totalSales] = $row;

            $category = Category::firstOrCreate(['name' => $categoryName]);
            $product = Product::firstOrCreate(['name' => $productName, 'category_id' => $category->id]);
            $region = Region::firstOrCreate(['name' => $regionName]);
            $salesperson = Salesperson::firstOrCreate(['name' => $salespersonName]);

            Sale::create([
                'sale_date' => Carbon::parse($date),
                'product_id' => $product->id,
                'region_id' => $region->id,
                'salesperson_id' => $salesperson->id,
                'units_sold' => $unitsSold,
                'unit_price' => $unitPrice,
                'total_sales' => $totalSales,
            ]);
        }
    }
}
