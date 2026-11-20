@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-heading', 'Dashboard')

@section('content')

@php
    $isAdmin = auth()->check()
        && auth()->user()->role === 'admin';
@endphp

<style>
    .bw-dashboard-hero {
        background: linear-gradient(120deg, #A9CFF3, #E4F2FF);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 25px;
    }

    .bw-dashboard-hero h3 {
        color: #244D79;
        font-weight: 800;
    }

    .bw-dashboard-hero p {
        color: #426D99;
    }

    .bw-dashboard-stat {
        background: white;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        padding: 22px;
        height: 100%;
        box-shadow: 0 5px 18px rgba(80,130,180,.07);
    }

    .bw-dashboard-label {
        color: #7893B0;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .bw-dashboard-value {
        color: #345F91;
        font-size: 27px;
        font-weight: 800;
        margin-top: 8px;
    }

    .bw-dashboard-icon {
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

    .bw-dashboard-panel {
        background: #FFFFFF;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 25px;
        box-shadow: 0 5px 18px rgba(80,130,180,.07);
    }

    .bw-dashboard-panel h5 {
        color: #345F91;
        font-weight: 800;
    }

    .bw-dashboard-table th {
        background: #EAF4FF;
        color: #4B79A8;
        border: none;
        padding: 13px;
        white-space: nowrap;
    }

    .bw-dashboard-table td {
        vertical-align: middle;
        padding: 13px;
        border-color: #E2EDFA;
    }

    .bw-dashboard-badge {
        display: inline-block;
        padding: 6px 11px;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 800;
    }

    .bw-dashboard-safe {
        background: #DFF5E8;
        color: #238653;
    }

    .bw-dashboard-low {
        background: #FFF1D6;
        color: #B47A18;
    }

    .bw-dashboard-empty {
        background: #FFE4E4;
        color: #C84C4C;
    }

    .bw-dashboard-summary {
        background: #F3F9FF;
        border: 1px solid #DCEBFA;
        border-radius: 14px;
        padding: 20px;
    }

    .bw-dashboard-summary-label {
        color: #7893B0;
        font-size: 13px;
        font-weight: 700;
    }

    .bw-dashboard-summary-value {
        color: #345F91;
        font-size: 24px;
        font-weight: 800;
        margin-top: 8px;
    }

    .bw-dashboard-chart {
        position: relative;
        height: 290px;
        max-width: 440px;
        margin: auto;
    }

    .bw-dashboard-link {
        color: #4F88C4;
        font-weight: 700;
    }
</style>

<!-- HEADER -->
<div class="bw-dashboard-hero">

    <div class="row align-items-center">

        <div class="col-md-8">

            <h3>
                <i class="fas fa-chart-line mr-2"></i>
                Dashboard BLUEWAVE STATIONERY
            </h3>

            <p class="mb-0">
                Ringkasan data produk, kategori,
                persediaan, dan kondisi stok toko.
            </p>

        </div>

        <div class="col-md-4 text-md-right mt-3 mt-md-0">

            <a href="{{ route('products.index') }}"
               class="btn btn-light">

                <i class="fas fa-box-open mr-2"></i>
                Lihat Produk

            </a>

        </div>

    </div>

</div>

<!-- STATISTIK UTAMA -->
<div class="row mb-4">

    <!-- TOTAL PRODUK -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-dashboard-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-dashboard-label">
                        Total Produk
                    </div>

                    <div class="bw-dashboard-value">
                        {{ number_format($totalProducts) }}
                    </div>
                </div>

                <div class="bw-dashboard-icon">
                    <i class="fas fa-boxes"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- TOTAL KATEGORI -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-dashboard-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-dashboard-label">
                        Total Kategori
                    </div>

                    <div class="bw-dashboard-value">
                        {{ number_format($totalCategories) }}
                    </div>
                </div>

                <div class="bw-dashboard-icon">
                    <i class="fas fa-tags"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- TOTAL STOK -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-dashboard-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-dashboard-label">
                        Total Unit Stok
                    </div>

                    <div class="bw-dashboard-value">
                        {{ number_format($totalStock, 0, ',', '.') }}
                    </div>
                </div>

                <div class="bw-dashboard-icon">
                    <i class="fas fa-cubes"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- NILAI PERSEDIAAN -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-dashboard-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <div class="bw-dashboard-label">
                        Nilai Persediaan
                    </div>

                    <div class="bw-dashboard-value"
                         style="font-size:20px;">

                        Rp {{ number_format($inventoryValue, 0, ',', '.') }}

                    </div>
                </div>

                <div class="bw-dashboard-icon">
                    <i class="fas fa-wallet"></i>
                </div>

            </div>

        </div>

    </div>

</div>

<!-- STATUS STOK -->
<div class="row mb-4">

    <div class="col-md-4 mb-3">

        <div class="bw-dashboard-stat">

            <div class="bw-dashboard-label">
                Produk Stok Aman
            </div>

            <div class="bw-dashboard-value">
                {{ number_format($safeStockProducts) }}
            </div>

            <span class="bw-dashboard-badge bw-dashboard-safe mt-2">
                <i class="fas fa-check-circle mr-1"></i>
                Lebih dari 5 unit
            </span>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="bw-dashboard-stat">

            <div class="bw-dashboard-label">
                Produk Stok Menipis
            </div>

            <div class="bw-dashboard-value">
                {{ number_format($lowStockProducts) }}
            </div>

            <span class="bw-dashboard-badge bw-dashboard-low mt-2">
                <i class="fas fa-exclamation-triangle mr-1"></i>
                1–5 unit
            </span>

        </div>

    </div>

    <div class="col-md-4 mb-3">

        <div class="bw-dashboard-stat">

            <div class="bw-dashboard-label">
                Produk Stok Habis
            </div>

            <div class="bw-dashboard-value">
                {{ number_format($outOfStockProducts) }}
            </div>

            <span class="bw-dashboard-badge bw-dashboard-empty mt-2">
                <i class="fas fa-times-circle mr-1"></i>
                0 unit
            </span>

        </div>

    </div>

</div>

<!-- GRAFIK DAN RINGKASAN -->
<div class="row">

    <!-- GRAFIK STOK -->
    <div class="col-lg-6 mb-4">

        <div class="bw-dashboard-panel h-100">

            <h5 class="mb-4">
                <i class="fas fa-chart-pie mr-2"></i>
                Grafik Kondisi Stok
            </h5>

            <div class="bw-dashboard-chart">
                <canvas id="bwStockChart"></canvas>
            </div>

        </div>

    </div>

    <!-- RINGKASAN -->
    <div class="col-lg-6 mb-4">

        <div class="bw-dashboard-panel h-100">

            <h5 class="mb-4">
                <i class="fas fa-clipboard-list mr-2"></i>
                Ringkasan Persediaan
            </h5>

            <div class="bw-dashboard-summary mb-3">

                <div class="bw-dashboard-summary-label">
                    Total Produk Terdaftar
                </div>

                <div class="bw-dashboard-summary-value">
                    {{ number_format($totalProducts) }} Produk
                </div>

            </div>

            <div class="bw-dashboard-summary mb-3">

                <div class="bw-dashboard-summary-label">
                    Total Unit Barang
                </div>

                <div class="bw-dashboard-summary-value">
                    {{ number_format($totalStock, 0, ',', '.') }} Unit
                </div>

            </div>

            <div class="bw-dashboard-summary">

                <div class="bw-dashboard-summary-label">
                    Produk Perlu Perhatian
                </div>

                <div class="bw-dashboard-summary-value">
                    {{ number_format($lowStockProducts + $outOfStockProducts) }}
                    Produk
                </div>

            </div>

        </div>

    </div>

</div>

<!-- PRODUK PERLU PERHATIAN -->
<div class="bw-dashboard-panel">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h5 class="mb-0">
            <i class="fas fa-exclamation-circle mr-2"></i>
            Produk Perlu Perhatian
        </h5>

        @if($isAdmin)
            <a href="{{ route('stocks.index') }}"
               class="bw-dashboard-link">
                Lihat Monitoring Stok
            </a>
        @endif

    </div>

    <div class="table-responsive">

        <table class="table table-hover bw-dashboard-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Status</th>

                    @if($isAdmin)
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>

            <tbody>

                @forelse($criticalProducts as $product)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td class="font-weight-bold"
                            style="color:#345F91;">
                            {{ $product->name }}
                        </td>

                        <td>
                            {{ $product->category?->name ?? '-' }}
                        </td>

                        <td>
                            {{ $product->stock }} Unit
                        </td>

                        <td>

                            @if($product->stock <= 0)

                                <span class="bw-dashboard-badge bw-dashboard-empty">
                                    Habis
                                </span>

                            @else

                                <span class="bw-dashboard-badge bw-dashboard-low">
                                    Menipis
                                </span>

                            @endif

                        </td>

                        @if($isAdmin)

                            <td>

                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="btn btn-sm btn-primary">

                                    <i class="fas fa-edit mr-1"></i>
                                    Edit Stok

                                </a>

                            </td>

                        @endif

                    </tr>

                @empty

                    <tr>
                        <td colspan="{{ $isAdmin ? 6 : 5 }}"
                            class="text-center text-muted py-4">

                            <i class="fas fa-check-circle text-success mr-1"></i>
                            Tidak ada produk dengan stok menipis atau habis.

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- PRODUK TERBARU -->
<div class="bw-dashboard-panel">

    <h5 class="mb-4">
        <i class="fas fa-clock mr-2"></i>
        Produk Terbaru
    </h5>

    <div class="table-responsive">

        <table class="table table-hover bw-dashboard-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                </tr>
            </thead>

            <tbody>

                @forelse($latestProducts as $product)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ $product->product_code }}
                        </td>

                        <td class="font-weight-bold"
                            style="color:#345F91;">
                            {{ $product->name }}
                        </td>

                        <td>
                            {{ $product->category?->name ?? '-' }}
                        </td>

                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td>
                            {{ $product->stock }} Unit
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6"
                            class="text-center text-muted py-4">

                            Belum ada produk terdaftar.

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- SCRIPT GRAFIK -->
<script>
document.addEventListener('DOMContentLoaded', function () {

    const chartElement = document.getElementById('bwStockChart');

    if (!chartElement || typeof Chart === 'undefined') {
        return;
    }

    const labels = @json($stockChartLabels);
    const data = @json($stockChartData);

    new Chart(chartElement, {
        type: 'doughnut',

        data: {
            labels: labels,

            datasets: [{
                data: data,
                backgroundColor: [
                    '#8DD7B3',
                    '#FFD58A',
                    '#F4A7A7'
                ],
                borderWidth: 2,
                borderColor: '#FFFFFF'
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            legend: {
                position: 'bottom'
            },

            cutoutPercentage: 65
        }
    });

});
</script>

@endsection
