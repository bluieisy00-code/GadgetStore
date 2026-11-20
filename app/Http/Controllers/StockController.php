<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('q');
        $status = $request->input('status');

        $products = Product::with('category')

            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                      ->orWhere('product_code', 'like', "%{$keyword}%")
                      ->orWhere('brand', 'like', "%{$keyword}%");
                });
            })

            ->when($status === 'aman', function ($query) {
                $query->where('stock', '>', 5);
            })

            ->when($status === 'menipis', function ($query) {
                $query->whereBetween('stock', [1, 5]);
            })

            ->when($status === 'habis', function ($query) {
                $query->where('stock', '<=', 0);
            })

            ->orderBy('stock', 'asc')
            ->paginate(10)
            ->withQueryString();

        // STATISTIK SELURUH PRODUK
        $totalProducts = Product::count();

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

        $totalStock = Product::sum('stock');

        $inventoryValue = Product::selectRaw(
            'COALESCE(SUM(price * stock), 0) as total'
        )->value('total');

        return view('stocks.index', compact(
            'products',
            'totalProducts',
            'safeStockProducts',
            'lowStockProducts',
            'outOfStockProducts',
            'totalStock',
            'inventoryValue'
        ));
    }
}
