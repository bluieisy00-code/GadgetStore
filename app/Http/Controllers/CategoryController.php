<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    // MENAMPILKAN DAFTAR KATEGORI
    public function index(Request $request)
    {
        $keyword = $request->input('q');
        $status = $request->input('status');

        $categories = Category::withCount('products')

            // Pencarian nama dan deskripsi
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                      ->orWhere('description', 'like', "%{$keyword}%");
                });
            })

            // Filter status kategori
            ->when(
                in_array($status, ['Aktif', 'Tidak Aktif'], true),
                function ($query) use ($status) {
                    $query->where('status', $status);
                }
            )

            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        // Statistik
        $totalCategories = Category::count();

        $activeCategories = Category::where(
            'status',
            'Aktif'
        )->count();

        $inactiveCategories = Category::where(
            'status',
            'Tidak Aktif'
        )->count();

        $totalProducts = Product::count();

        return view('categories.index', compact(
            'categories',
            'totalCategories',
            'activeCategories',
            'inactiveCategories',
            'totalProducts'
        ));
    }

    // FORM TAMBAH KATEGORI
    public function create()
    {
        return view('categories.create');
    }

    // SIMPAN KATEGORI BARU
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name'
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'status' => [
                'required',
                Rule::in(['Aktif', 'Tidak Aktif'])
            ],
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Kategori berhasil ditambahkan!'
            );
    }

    // DETAIL KATEGORI
    public function show(Category $category)
    {
        $category->load([
            'products' => function ($query) {
                $query->orderBy('name');
            }
        ]);

        return view(
            'categories.show',
            compact('category')
        );
    }

    // FORM EDIT KATEGORI
    public function edit(Category $category)
    {
        return view(
            'categories.edit',
            compact('category')
        );
    }

    // UPDATE KATEGORI
    public function update(
        Request $request,
        Category $category
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')
                    ->ignore($category->id)
            ],
            'description' => [
                'nullable',
                'string'
            ],
            'status' => [
                'required',
                Rule::in(['Aktif', 'Tidak Aktif'])
            ],
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Kategori berhasil diperbarui!'
            );
    }

    // HAPUS KATEGORI
    public function destroy(Category $category)
    {
        // Tidak boleh menghapus kategori
        // yang masih memiliki produk
        if ($category->products()->exists()) {

            return redirect()
                ->route('categories.index')
                ->with(
                    'error',
                    'Kategori tidak dapat dihapus karena masih memiliki produk.'
                );
        }

        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with(
                'success',
                'Kategori berhasil dihapus!'
            );
    }
}
