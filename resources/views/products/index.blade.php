@extends('layouts.app')

@section('title', 'Data Produk')
@section('page-heading', 'Katalog Produk')

@section('content')

@php
    // Sesuaikan dengan kolom role pada tabel users
    $isAdmin = auth()->check() && (
        (bool) (auth()->user()->is_admin ?? false)
        || strtolower((string) (auth()->user()->role ?? '')) === 'admin'
    );
@endphp

<style>
    .bw-product-hero {
        background: linear-gradient(120deg, #A9CFF3, #E4F2FF);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 25px;
    }

    .bw-product-hero h3 {
        color: #244D79;
        font-weight: 800;
    }

    .bw-product-hero p {
        color: #426D99;
    }

    .bw-product-stat {
        background: #fff;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        padding: 22px;
        height: 100%;
        box-shadow: 0 5px 18px rgba(80,130,180,.07);
    }

    .bw-product-stat-label {
        color: #7893B0;
        font-size: 13px;
        font-weight: 700;
    }

    .bw-product-stat-value {
        color: #345F91;
        font-size: 27px;
        font-weight: 800;
        margin-top: 8px;
    }

    .bw-product-filter {
        background: white;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 25px;
    }

    .bw-product-card {
        background: white;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        overflow: hidden;
        height: 100%;
        box-shadow: 0 5px 18px rgba(80,130,180,.07);
        transition: .2s;
    }

    .bw-product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(80,130,180,.15);
    }

    .bw-product-image {
        height: 210px;
        background: #F0F7FF;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .bw-product-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        padding: 15px;
    }

    .bw-product-placeholder {
        text-align: center;
        color: #A9CFF3;
    }

    .bw-product-placeholder i {
        font-size: 65px;
    }

    .bw-product-body {
        padding: 20px;
    }

    .bw-product-category {
        display: inline-block;
        background: #EAF4FF;
        color: #5C91CA;
        padding: 6px 12px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 800;
    }

    .bw-product-name {
        color: #244D79;
        font-size: 18px;
        font-weight: 800;
        margin-top: 14px;
        margin-bottom: 7px;
    }

    .bw-product-brand {
        color: #8495AB;
        font-size: 13px;
    }

    .bw-product-price {
        color: #4F8DC9;
        font-size: 22px;
        font-weight: 900;
        margin-top: 15px;
    }

    .bw-product-stock {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 12px;
        margin-bottom: 18px;
    }

    .bw-product-actions {
        display: flex;
        gap: 7px;
        flex-wrap: wrap;
    }

    .bw-product-actions .btn {
        flex: 1;
        font-size: 12px;
        font-weight: 700;
    }

    .bw-product-empty {
        background: white;
        border-radius: 18px;
        text-align: center;
        padding: 55px 20px;
        color: #8495AB;
    }

    .bw-product-empty i {
        font-size: 55px;
        color: #A9CFF3;
        margin-bottom: 15px;
    }
</style>

<!-- HEADER -->
<div class="bw-product-hero">

    <div class="row align-items-center">

        <div class="col-md-8">
            <h3>
                <i class="fas fa-book-open mr-2"></i>
                Katalog Produk Stationery
            </h3>

            <p class="mb-0">
                Kelola koleksi alat tulis, perlengkapan sekolah,
                dan kebutuhan kantor BLUEWAVE STATIONERY.
            </p>
        </div>

        @if($isAdmin)
            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                <a href="{{ route('products.create') }}"
                   class="btn btn-primary">

                    <i class="fas fa-plus mr-2"></i>
                    Tambah Produk

                </a>

            </div>
        @endif

    </div>

</div>

<!-- STATISTIK PRODUK -->
@php
    $totalDisplayed = $products->total();
    $stockAvailable = $products->getCollection()
        ->filter(fn($product) => $product->stock > 5)
        ->count();

    $stockLow = $products->getCollection()
        ->filter(fn($product) => $product->stock > 0 && $product->stock <= 5)
        ->count();
@endphp

<div class="row mb-4">

    <div class="col-md-4 mb-3">
        <div class="bw-product-stat">

            <div class="bw-product-stat-label">
                TOTAL PRODUK HASIL FILTER
            </div>

            <div class="bw-product-stat-value">
                {{ number_format($totalDisplayed) }}
            </div>

        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="bw-product-stat">

            <div class="bw-product-stat-label">
                STOK AMAN (HALAMAN INI)
            </div>

            <div class="bw-product-stat-value">
                {{ number_format($stockAvailable) }}
            </div>

        </div>
    </div>

    <div class="col-md-4 mb-3">
        <div class="bw-product-stat">

            <div class="bw-product-stat-label">
                STOK MENIPIS (HALAMAN INI)
            </div>

            <div class="bw-product-stat-value">
                {{ number_format($stockLow) }}
            </div>

        </div>
    </div>

</div>

<!-- FILTER -->
<div class="bw-product-filter">

    <form method="GET"
          action="{{ route('products.index') }}">

        <div class="row align-items-end">

            <div class="col-md-5 mb-3 mb-md-0">

                <label class="font-weight-bold">
                    Cari Produk
                </label>

                <input
                    type="text"
                    name="q"
                    class="form-control"
                    placeholder="Nama, kode, atau merek produk..."
                    value="{{ request('q') }}">

            </div>

            <div class="col-md-4 mb-3 mb-md-0">

                <label class="font-weight-bold">
                    Kategori
                </label>

                <select name="category_id"
                        class="form-control">

                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ (string) request('category_id') === (string) $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-3">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="fas fa-search mr-1"></i>
                    Cari

                </button>

                <a href="{{ route('products.index') }}"
                   class="btn btn-light border">

                    Reset

                </a>

            </div>

        </div>

    </form>

</div>

<!-- KATALOG PRODUK -->
<div class="row">

    @forelse($products as $product)

        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">

            <div class="bw-product-card">

                <!-- FOTO -->
                <div class="bw-product-image">

                    @if($product->image)

                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            onerror="this.style.display='none';this.nextElementSibling.style.display='block';">

                        <div class="bw-product-placeholder"
                             style="display:none;">
                            <i class="fas fa-book-open"></i>
                            <p>Gambar tidak tersedia</p>
                        </div>

                    @else

                        <div class="bw-product-placeholder">
                            <i class="fas fa-book-open"></i>
                            <p>Belum ada gambar</p>
                        </div>

                    @endif

                </div>

                <!-- INFORMASI -->
                <div class="bw-product-body">

                    <span class="bw-product-category">
                        {{ $product->category->name ?? 'Tanpa Kategori' }}
                    </span>

                    <h5 class="bw-product-name">
                        {{ $product->name }}
                    </h5>

                    <div class="bw-product-brand">
                        <i class="fas fa-barcode mr-1"></i>
                        {{ $product->product_code }}
                    </div>

                    <div class="bw-product-brand mt-1">
                        Merek: {{ $product->brand ?: '-' }}
                    </div>

                    <div class="bw-product-price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <!-- STATUS STOK -->
                    <div class="bw-product-stock">

                        <span class="text-muted small">
                            Stok: {{ $product->stock }} unit
                        </span>

                        @if($product->stock <= 0)

                            <span class="badge badge-danger">
                                Habis
                            </span>

                        @elseif($product->stock <= 5)

                            <span class="badge badge-warning">
                                Menipis
                            </span>

                        @else

                            <span class="badge badge-success">
                                Tersedia
                            </span>

                        @endif

                    </div>

                    <!-- TOMBOL KHUSUS ADMIN -->
                    @if($isAdmin)

                        <div class="bw-product-actions">

                            <a href="{{ route('products.show', $product->id) }}"
                               class="btn btn-info">

                                <i class="fas fa-eye"></i>
                                Detail

                            </a>

                            <a href="{{ route('products.edit', $product->id) }}"
                               class="btn btn-primary">

                                <i class="fas fa-edit"></i>
                                Edit

                            </a>

                            <form
                                method="POST"
                                action="{{ route('products.destroy', $product->id) }}"
                                onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                style="flex:1;">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-block">

                                    <i class="fas fa-trash"></i>
                                    Hapus

                                </button>

                            </form>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    @empty

        <div class="col-12">

            <div class="bw-product-empty">

                <i class="fas fa-box-open"></i>

                <h5 class="font-weight-bold">
                    Produk Tidak Ditemukan
                </h5>

                <p>
                    Belum ada produk atau hasil pencarian kosong.
                </p>

                @if($isAdmin)

                    <a href="{{ route('products.create') }}"
                       class="btn btn-primary">

                        <i class="fas fa-plus mr-1"></i>
                        Tambah Produk

                    </a>

                @endif

            </div>

        </div>

    @endforelse

</div>

<!-- PAGINATION -->
@if($products->hasPages())

    <div class="mt-4">
        {{ $products->links() }}
    </div>

@endif

@endsection
