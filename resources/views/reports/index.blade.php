@extends('layouts.app')

@section('title', 'Laporan Inventaris')
@section('page-heading', 'Laporan Inventaris')

@section('content')

<style>
    .bw-report-hero {
        background: linear-gradient(120deg, #A9CFF3, #E4F2FF);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 25px;
    }

    .bw-report-hero h3 {
        color: #244D79;
        font-weight: 800;
    }

    .bw-report-hero p {
        color: #426D99;
    }

    .bw-report-panel {
        background: #FFFFFF;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 25px;
        box-shadow: 0 5px 18px rgba(80,130,180,.07);
    }

    .bw-report-panel h5 {
        color: #345F91;
        font-weight: 800;
    }

    .bw-report-stat {
        background: #FFFFFF;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        padding: 22px;
        height: 100%;
        box-shadow: 0 5px 18px rgba(80,130,180,.07);
    }

    .bw-report-stat-label {
        color: #7893B0;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .bw-report-stat-value {
        color: #345F91;
        font-size: 26px;
        font-weight: 800;
        margin-top: 8px;
    }

    .bw-report-icon {
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

    .bw-report-input {
        border: 1px solid #D6E6F8;
        border-radius: 10px;
        height: 43px;
    }

    .bw-report-input:focus {
        border-color: #83B5E6;
        box-shadow: 0 0 0 3px rgba(131,181,230,.15);
    }

    .bw-report-table th {
        background: #EAF4FF;
        color: #4B79A8;
        border: none;
        padding: 13px;
        white-space: nowrap;
    }

    .bw-report-table td {
        vertical-align: middle;
        padding: 13px;
        border-color: #E2EDFA;
    }

    .bw-report-product {
        color: #345F91;
        font-weight: 800;
    }

    .bw-report-code {
        color: #8495AB;
        font-size: 12px;
    }

    .bw-report-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 800;
        white-space: nowrap;
    }

    .bw-report-safe {
        background: #DFF5E8;
        color: #238653;
    }

    .bw-report-low {
        background: #FFF1D6;
        color: #B47A18;
    }

    .bw-report-empty {
        background: #FFE4E4;
        color: #C84C4C;
    }

    .bw-report-summary {
        background: #F3F9FF;
        border: 1px solid #DCEBFA;
        border-radius: 14px;
        padding: 20px;
    }

    .bw-report-summary-label {
        color: #7893B0;
        font-size: 13px;
        font-weight: 700;
    }

    .bw-report-summary-value {
        color: #345F91;
        font-size: 24px;
        font-weight: 800;
        margin-top: 8px;
    }

    .bw-print-header {
        display: none;
    }

    .bw-report-no-data {
        text-align: center;
        padding: 40px 15px;
        color: #8495AB;
    }

    @media print {
        @page {
            size: A4 landscape;
            margin: 12mm;
        }

        body {
            background: #FFFFFF !important;
            color: #000000 !important;
            font-size: 11px !important;
        }

        .sidebar,
        #accordionSidebar,
        .topbar,
        .navbar,
        footer,
        .sticky-footer,
        .scroll-to-top,
        .modal,
        .bw-no-print,
        .bw-report-hero,
        .bw-report-filter,
        .bw-report-stats {
            display: none !important;
        }

        #wrapper,
        #content-wrapper,
        #content,
        .container-fluid {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: 100% !important;
            background: white !important;
        }

        .bw-print-header {
            display: block !important;
            text-align: center;
            margin-bottom: 22px;
            border-bottom: 2px solid #000;
            padding-bottom: 12px;
        }

        .bw-print-header h2 {
            color: #000 !important;
            font-size: 20px;
            font-weight: bold;
        }

        .bw-report-panel {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
            margin: 0 0 15px !important;
        }

        .bw-report-panel h5 {
            color: #000 !important;
            font-size: 13px !important;
        }

        .table-responsive {
            overflow: visible !important;
        }

        .bw-report-table {
            width: 100% !important;
            border-collapse: collapse !important;
            font-size: 10px !important;
        }

        .bw-report-table th,
        .bw-report-table td {
            border: 1px solid #555 !important;
            color: #000 !important;
            padding: 7px !important;
        }

        .bw-report-table th {
            background: #EEEEEE !important;
        }

        .bw-report-product,
        .bw-report-code {
            color: #000 !important;
        }

        .bw-report-badge {
            color: #000 !important;
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
        }

        .bw-report-summary {
            border: 1px solid #555 !important;
            background: #FFFFFF !important;
            padding: 12px !important;
        }

        .bw-report-summary-label,
        .bw-report-summary-value {
            color: #000 !important;
        }

        .bw-report-summary-value {
            font-size: 16px !important;
        }

        tr {
            page-break-inside: avoid;
        }
    }
</style>

<!-- HEADER HALAMAN -->
<div class="bw-report-hero">

    <div class="row align-items-center">

        <div class="col-md-8">

            <h3>
                <i class="fas fa-file-alt mr-2"></i>
                Laporan Inventaris Produk
            </h3>

            <p class="mb-0">
                Rekapitulasi data produk, jumlah stok,
                dan nilai persediaan BLUEWAVE STATIONERY.
            </p>

        </div>

        <div class="col-md-4 text-md-right mt-3 mt-md-0">

            <button type="button"
                    onclick="window.print()"
                    class="btn btn-primary">

                <i class="fas fa-print mr-2"></i>
                Cetak Laporan

            </button>

        </div>

    </div>

</div>

<!-- HEADER KHUSUS CETAK -->
<div class="bw-print-header">

    <h2>BLUEWAVE STATIONERY</h2>

    <h4>LAPORAN INVENTARIS PRODUK</h4>

    <p class="mb-1">
        Tanggal Cetak:
        {{ now()->format('d/m/Y H:i') }}
    </p>

    <p class="mb-0">
        Data inventaris dan persediaan produk
    </p>

</div>

<!-- STATISTIK -->
<div class="row mb-4 bw-report-stats">

    <!-- TOTAL PRODUK -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-report-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-report-stat-label">
                        Total Produk
                    </div>

                    <div class="bw-report-stat-value">
                        {{ number_format($totalProducts) }}
                    </div>
                </div>

                <div class="bw-report-icon">
                    <i class="fas fa-boxes"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- TOTAL UNIT -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-report-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-report-stat-label">
                        Total Unit Stok
                    </div>

                    <div class="bw-report-stat-value">
                        {{ number_format($totalStock, 0, ',', '.') }}
                    </div>
                </div>

                <div class="bw-report-icon">
                    <i class="fas fa-cubes"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- STOK MENIPIS -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-report-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-report-stat-label">
                        Stok Menipis
                    </div>

                    <div class="bw-report-stat-value">
                        {{ number_format($lowStockProducts) }}
                    </div>
                </div>

                <div class="bw-report-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- STOK HABIS -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-report-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-report-stat-label">
                        Stok Habis
                    </div>

                    <div class="bw-report-stat-value">
                        {{ number_format($outOfStockProducts) }}
                    </div>
                </div>

                <div class="bw-report-icon">
                    <i class="fas fa-times-circle"></i>
                </div>

            </div>

        </div>

    </div>

</div>

<!-- FILTER LAPORAN -->
<div class="bw-report-panel bw-report-filter">

    <h5 class="mb-4">
        <i class="fas fa-filter mr-2"></i>
        Pencarian dan Filter Laporan
    </h5>

    <form method="GET"
          action="{{ route('reports.index') }}">

        <div class="row align-items-end">

            <!-- PENCARIAN -->
            <div class="col-lg-3 col-md-6 mb-3">

                <label class="font-weight-bold"
                       style="color:#345F91;">
                    Cari Produk
                </label>

                <input
                    type="text"
                    name="q"
                    class="form-control bw-report-input"
                    placeholder="Nama, kode, merek..."
                    value="{{ request('q') }}">

            </div>

            <!-- KATEGORI -->
            <div class="col-lg-3 col-md-6 mb-3">

                <label class="font-weight-bold"
                       style="color:#345F91;">
                    Kategori
                </label>

                <select name="category_id"
                        class="form-control bw-report-input">

                    <option value="">
                        Semua Kategori
                    </option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ (string) request('category_id') === (string) $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- STATUS STOK -->
            <div class="col-lg-3 col-md-6 mb-3">

                <label class="font-weight-bold"
                       style="color:#345F91;">
                    Status Stok
                </label>

                <select name="status"
                        class="form-control bw-report-input">

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
            <div class="col-lg-3 col-md-6 mb-3">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="fas fa-search mr-1"></i>
                    Terapkan

                </button>

                <a href="{{ route('reports.index') }}"
                   class="btn btn-light border">

                    <i class="fas fa-undo mr-1"></i>
                    Reset

                </a>

            </div>

        </div>

    </form>

</div>

<!-- TABEL LAPORAN -->
<div class="bw-report-panel">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h5 class="mb-0">
            <i class="fas fa-list-alt mr-2 bw-no-print"></i>
            Daftar Inventaris Produk
        </h5>

        <span class="badge badge-info p-2 bw-no-print">
            {{ $totalProducts }} Produk
        </span>

    </div>

    <div class="table-responsive">

        <table class="table table-hover bw-report-table">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Merek</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th>Nilai Stok</th>
                </tr>

            </thead>

            <tbody>

                @forelse($products as $product)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $product->product_code }}
                        </td>

                        <td>

                            <div class="bw-report-product">
                                {{ $product->name }}
                            </div>

                        </td>

                        <td>
                            {{ $product->category?->name ?? '-' }}
                        </td>

                        <td>
                            {{ $product->brand ?: '-' }}
                        </td>

                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ number_format($product->stock, 0, ',', '.') }}
                        </td>

                        <td>

                            @if($product->stock <= 0)

                                <span class="bw-report-badge bw-report-empty">
                                    Habis
                                </span>

                            @elseif($product->stock <= 5)

                                <span class="bw-report-badge bw-report-low">
                                    Menipis
                                </span>

                            @else

                                <span class="bw-report-badge bw-report-safe">
                                    Aman
                                </span>

                            @endif

                        </td>

                        <td class="font-weight-bold">

                            Rp {{ number_format(
                                $product->price * $product->stock,
                                0,
                                ',',
                                '.'
                            ) }}

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="9">

                            <div class="bw-report-no-data">

                                <i class="fas fa-folder-open fa-3x mb-3"
                                   style="color:#A9CFF3;"></i>

                                <h5>
                                    Data Inventaris Tidak Ditemukan
                                </h5>

                                <p class="mb-0">
                                    Tidak ada produk yang sesuai
                                    dengan filter laporan.
                                </p>

                            </div>

                        </td>
                    </tr>

                @endforelse

            </tbody>

            @if($totalProducts > 0)

                <tfoot>

                    <tr style="background:#F3F9FF; font-weight:bold;">

                        <td colspan="6" class="text-right">
                            TOTAL
                        </td>

                        <td>
                            {{ number_format($totalStock, 0, ',', '.') }}
                        </td>

                        <td>-</td>

                        <td>
                            Rp {{ number_format($inventoryValue, 0, ',', '.') }}
                        </td>

                    </tr>

                </tfoot>

            @endif

        </table>

    </div>

</div>

<!-- RINGKASAN LAPORAN -->
<div class="bw-report-panel">

    <h5 class="mb-4">
        <i class="fas fa-chart-pie mr-2 bw-no-print"></i>
        Ringkasan Laporan
    </h5>

    <div class="row">

        <div class="col-md-4 mb-3">

            <div class="bw-report-summary">

                <div class="bw-report-summary-label">
                    Jumlah Produk
                </div>

                <div class="bw-report-summary-value">
                    {{ number_format($totalProducts) }}
                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="bw-report-summary">

                <div class="bw-report-summary-label">
                    Total Unit Persediaan
                </div>

                <div class="bw-report-summary-value">
                    {{ number_format($totalStock, 0, ',', '.') }}
                </div>

            </div>

        </div>

        <div class="col-md-4 mb-3">

            <div class="bw-report-summary">

                <div class="bw-report-summary-label">
                    Total Nilai Inventaris
                </div>

                <div class="bw-report-summary-value"
                     style="font-size:21px;">

                    Rp {{ number_format($inventoryValue, 0, ',', '.') }}

                </div>

            </div>

        </div>

    </div>

    <p class="text-muted mb-0 mt-2 bw-no-print">
        <i class="fas fa-info-circle mr-1"></i>
        Ringkasan dihitung berdasarkan data yang sesuai
        dengan pencarian dan filter yang diterapkan.
    </p>

</div>

@endsection
