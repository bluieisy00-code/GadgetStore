<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        // STATISTIK PRODUK
        $totalProducts = Product::count();

        $totalCategories = Category::count();

        $totalStock = Product::sum('stock');

        $inventoryValue = Product::selectRaw(
            'COALESCE(SUM(price * stock), 0) as total'
        )->value('total');

        // STATUS STOK
        $safeStockProducts = Product::where(
            'stock',
            '>',
            5
        )->count();

        $lowStockProducts = Product::whereBetween(
            'stock',
            [1, 5]
        )->count();

        $outOfStockProducts = Product::where(
            'stock',
            '<=',
            0
        )->count();

        // PRODUK DENGAN STOK MENIPIS / HABIS
        $criticalProducts = Product::with('category')
            ->where('stock', '<=', 5)
            ->orderBy('stock', 'asc')
            ->limit(8)
            ->get();

        // PRODUK TERBARU
        $latestProducts = Product::with('category')
            ->latest()
            ->limit(5)
            ->get();

        // DATA GRAFIK STATUS STOK
        $stockChartLabels = [
            'Stok Aman',
            'Stok Menipis',
            'Stok Habis'
        ];

        $stockChartData = [
            $safeStockProducts,
            $lowStockProducts,
            $outOfStockProducts
        ];

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalStock',
            'inventoryValue',
            'safeStockProducts',
            'lowStockProducts',
            'outOfStockProducts',
            'criticalProducts',
            'latestProducts',
            'stockChartLabels',
            'stockChartData'
        ));
    }
}
