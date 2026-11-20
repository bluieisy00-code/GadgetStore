@extends('layouts.app')

@section('title', 'Monitoring Stok')
@section('page-heading', 'Monitoring Stok')

@section('content')

@php
    $isAdmin = auth()->check()
        && auth()->user()->role === 'admin';
@endphp

<style>
    .bw-stock-hero {
        background: linear-gradient(120deg, #A9CFF3, #E4F2FF);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 25px;
    }

    .bw-stock-hero h3 {
        color: #244D79;
        font-weight: 800;
    }

    .bw-stock-hero p {
        color: #426D99;
    }

    .bw-stock-stat {
        background: #FFFFFF;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        padding: 22px;
        height: 100%;
        box-shadow: 0 5px 18px rgba(80,130,180,.07);
    }

    .bw-stock-stat-label {
        color: #7893B0;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .bw-stock-stat-value {
        color: #345F91;
        font-size: 27px;
        font-weight: 800;
        margin-top: 8px;
    }

    .bw-stock-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #E5F2FF;
        color: #5C91CA;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 21px;
    }

    .bw-stock-panel {
        background: #FFFFFF;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 25px;
        box-shadow: 0 5px 18px rgba(80,130,180,.07);
    }

    .bw-stock-panel h5 {
        color: #345F91;
        font-weight: 800;
    }

    .bw-stock-table th {
        background: #EAF4FF;
        color: #4B79A8;
        border: none;
        padding: 15px;
        white-space: nowrap;
    }

    .bw-stock-table td {
        vertical-align: middle;
        padding: 15px;
        border-color: #E2EDFA;
    }

    .bw-stock-name {
        color: #345F91;
        font-weight: 800;
    }

    .bw-stock-code {
        color: #8495AB;
        font-size: 12px;
    }

    .bw-stock-badge {
        display: inline-block;
        padding: 7px 12px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .bw-stock-safe {
        background: #DFF5E8;
        color: #238653;
    }

    .bw-stock-low {
        background: #FFF1D6;
        color: #B47A18;
    }

    .bw-stock-empty {
        background: #FFE4E4;
        color: #C84C4C;
    }

    .bw-stock-input {
        border: 1px solid #D6E6F8;
        border-radius: 10px;
        height: 43px;
    }

    .bw-stock-input:focus {
        border-color: #83B5E6;
        box-shadow: 0 0 0 3px rgba(131,181,230,.15);
    }

    .bw-stock-empty-state {
        text-align: center;
        padding: 45px 20px;
        color: #8495AB;
    }

    .bw-stock-empty-state i {
        font-size: 45px;
        color: #A9CFF3;
        margin-bottom: 15px;
    }

    .bw-stock-actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .bw-stock-summary {
        background: #F3F9FF;
        border: 1px solid #DCEBFA;
        border-radius: 14px;
        padding: 18px;
    }
</style>

<!-- HEADER -->
<div class="bw-stock-hero">

    <div class="row align-items-center">

        <div class="col-md-8">

            <h3>
                <i class="fas fa-warehouse mr-2"></i>
                Monitoring Stok Produk
            </h3>

            <p class="mb-0">
                Pantau ketersediaan barang dan kondisi stok
                BLUEWAVE STATIONERY.
            </p>

        </div>

        <div class="col-md-4 text-md-right mt-3 mt-md-0">

            <a href="{{ route('products.index') }}"
               class="btn btn-light">

                <i class="fas fa-box-open mr-2"></i>
                Data Produk

            </a>

        </div>

    </div>

</div>

<!-- STATISTIK -->
<div class="row mb-4">

    <!-- TOTAL PRODUK -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-stock-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-stock-stat-label">
                        Total Produk
                    </div>

                    <div class="bw-stock-stat-value">
                        {{ number_format($totalProducts) }}
                    </div>
                </div>

                <div class="bw-stock-icon">
                    <i class="fas fa-boxes"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- STOK AMAN -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-stock-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-stock-stat-label">
                        Stok Aman
                    </div>

                    <div class="bw-stock-stat-value">
                        {{ number_format($safeStockProducts) }}
                    </div>
                </div>

                <div class="bw-stock-icon">
                    <i class="fas fa-check-circle"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- STOK MENIPIS -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-stock-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-stock-stat-label">
                        Stok Menipis
                    </div>

                    <div class="bw-stock-stat-value">
                        {{ number_format($lowStockProducts) }}
                    </div>
                </div>

                <div class="bw-stock-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- STOK HABIS -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-stock-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-stock-stat-label">
                        Stok Habis
                    </div>

                    <div class="bw-stock-stat-value">
                        {{ number_format($outOfStockProducts) }}
                    </div>
                </div>

                <div class="bw-stock-icon">
                    <i class="fas fa-times-circle"></i>
                </div>

            </div>

        </div>

    </div>

</div>

<!-- RINGKASAN PERSEDIAAN -->
<div class="bw-stock-panel">

    <h5 class="mb-4">
        <i class="fas fa-chart-bar mr-2"></i>
        Ringkasan Persediaan
    </h5>

    <div class="row">

        <div class="col-md-6 mb-3 mb-md-0">

            <div class="bw-stock-summary">

                <div class="text-muted mb-2">
                    Total Unit Stok
                </div>

                <h4 class="font-weight-bold mb-0"
                    style="color:#345F91;">

                    {{ number_format($totalStock, 0, ',', '.') }} Unit

                </h4>

            </div>

        </div>

        <div class="col-md-6">

            <div class="bw-stock-summary">

                <div class="text-muted mb-2">
                    Total Nilai Persediaan
                </div>

                <h4 class="font-weight-bold mb-0"
                    style="color:#345F91;">

                    Rp {{ number_format($inventoryValue, 0, ',', '.') }}

                </h4>

            </div>

        </div>

    </div>

</div>

<!-- FILTER -->
<div class="bw-stock-panel">

    <h5 class="mb-4">
        <i class="fas fa-filter mr-2"></i>
        Pencarian dan Filter Stok
    </h5>

    <form method="GET"
          action="{{ route('stocks.index') }}">

        <div class="row align-items-end">

            <!-- PENCARIAN -->
            <div class="col-lg-5 col-md-6 mb-3 mb-lg-0">

                <label class="font-weight-bold"
                       style="color:#345F91;">
                    Cari Produk
                </label>

                <input
                    type="text"
                    name="q"
                    class="form-control bw-stock-input"
                    placeholder="Nama, kode, atau merek..."
                    value="{{ request('q') }}">

            </div>

            <!-- FILTER STATUS -->
            <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">

                <label class="font-weight-bold"
                       style="color:#345F91;">
                    Status Stok
                </label>

                <select
                    name="status"
                    class="form-control bw-stock-input">

                    <option value="">
                        Semua Status
                    </option>

                    <option value="aman"
                        {{ request('status') === 'aman' ? 'selected' : '' }}>
                        Stok Aman
                    </option>

                    <option value="menipis"
                        {{ request('status') === 'menipis' ? 'selected' : '' }}>
                        Stok Menipis
                    </option>

                    <option value="habis"
                        {{ request('status') === 'habis' ? 'selected' : '' }}>
                        Stok Habis
                    </option>

                </select>

            </div>

            <!-- TOMBOL -->
            <div class="col-lg-3 col-md-12">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="fas fa-search mr-1"></i>
                    Terapkan

                </button>

                <a href="{{ route('stocks.index') }}"
                   class="btn btn-light border">

                    <i class="fas fa-undo mr-1"></i>
                    Reset

                </a>

            </div>

        </div>

    </form>

</div>

<!-- TABEL MONITORING -->
<div class="bw-stock-panel">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h5 class="mb-0">
            <i class="fas fa-list mr-2"></i>
            Daftar Monitoring Stok
        </h5>

        <span class="badge badge-info p-2">
            {{ $products->total() }} Produk
        </span>

    </div>

    <div class="table-responsive">

        <table class="table table-hover bw-stock-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Nilai Stok</th>

                    @if($isAdmin)
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>

            <tbody>

                @forelse($products as $product)

                    <tr>

                        <!-- NOMOR -->
                        <td>
                            {{ $products->firstItem() + $loop->index }}
                        </td>

                        <!-- PRODUK -->
                        <td>

                            <div class="bw-stock-name">
                                {{ $product->name }}
                            </div>

                            <div class="bw-stock-code">
                                {{ $product->product_code }}
                            </div>

                            <small class="text-muted">
                                {{ $product->brand ?: '-' }}
                            </small>

                        </td>

                        <!-- KATEGORI -->
                        <td>
                            {{ $product->category?->name ?? '-' }}
                        </td>

                        <!-- HARGA -->
                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <!-- JUMLAH STOK -->
                        <td>

                            <strong style="color:#345F91;">
                                {{ number_format($product->stock, 0, ',', '.') }}
                            </strong>

                            Unit

                        </td>

                        <!-- STATUS -->
                        <td>

                            @if($product->stock <= 0)

                                <span class="bw-stock-badge bw-stock-empty">
                                    <i class="fas fa-times-circle mr-1"></i>
                                    Habis
                                </span>

                            @elseif($product->stock <= 5)

                                <span class="bw-stock-badge bw-stock-low">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Menipis
                                </span>

                            @else

                                <span class="bw-stock-badge bw-stock-safe">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Aman
                                </span>

                            @endif

                        </td>

                        <!-- NILAI STOK -->
                        <td class="font-weight-bold"
                            style="color:#345F91;">

                            Rp {{ number_format(
                                $product->price * $product->stock,
                                0,
                                ',',
                                '.'
                            ) }}

                        </td>

                        <!-- AKSI ADMIN -->
                        @if($isAdmin)

                            <td>

                                <div class="bw-stock-actions">

                                    <a href="{{ route('products.show', $product->id) }}"
                                       class="btn btn-sm btn-info"
                                       title="Detail Produk">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-sm btn-primary"
                                       title="Edit Stok Produk">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                </div>

                            </td>

                        @endif

                    </tr>

                @empty

                    <tr>

                        <td colspan="{{ $isAdmin ? 8 : 7 }}">

                            <div class="bw-stock-empty-state">

                                <i class="fas fa-box-open"></i>

                                <h5 class="font-weight-bold">
                                    Produk Tidak Ditemukan
                                </h5>

                                <p class="mb-0">
                                    Tidak ada produk yang sesuai
                                    dengan pencarian atau filter.
                                </p>

                                <a href="{{ route('stocks.index') }}"
                                   class="btn btn-primary mt-3">

                                    <i class="fas fa-undo mr-1"></i>
                                    Tampilkan Semua

                                </a>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    @if($products->hasPages())

        <div class="mt-4">

            {{ $products->links() }}

        </div>

    @endif

</div>

@endsection
