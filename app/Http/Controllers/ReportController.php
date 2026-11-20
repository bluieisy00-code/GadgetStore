<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // DATA FILTER
        $keyword = $request->input('q');
        $categoryId = $request->input('category_id');
        $status = $request->input('status');

        // DAFTAR KATEGORI
        $categories = Category::orderBy('name')->get();

        // QUERY PRODUK BERDASARKAN FILTER
        $query = Product::with('category')

            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                      ->orWhere('product_code', 'like', "%{$keyword}%")
                      ->orWhere('brand', 'like', "%{$keyword}%");
                });
            })

            ->when($categoryId, function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })

            ->when($status === 'aman', function ($query) {
                $query->where('stock', '>', 5);
            })

            ->when($status === 'menipis', function ($query) {
                $query->whereBetween('stock', [1, 5]);
            })

            ->when($status === 'habis', function ($query) {
                $query->where('stock', '<=', 0);
            });

        // AMBIL DATA PRODUK SESUAI FILTER
        $products = $query
            ->orderBy('name')
            ->get();

        // STATISTIK BERDASARKAN HASIL FILTER
        $totalProducts = $products->count();

        $totalStock = $products->sum('stock');

        $safeStockProducts = $products->filter(function ($product) {
            return $product->stock > 5;
        })->count();

        $lowStockProducts = $products->filter(function ($product) {
            return $product->stock >= 1
                && $product->stock <= 5;
        })->count();

        $outOfStockProducts = $products->filter(function ($product) {
            return $product->stock <= 0;
        })->count();

        $inventoryValue = $products->sum(function ($product) {
            return $product->price * $product->stock;
        });

        return view('reports.index', compact(
            'products',
            'categories',
            'totalProducts',
            'totalStock',
            'safeStockProducts',
            'lowStockProducts',
            'outOfStockProducts',
            'inventoryValue'
        ));
    }
}
