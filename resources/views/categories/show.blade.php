@extends('layouts.app')

@section('title', 'Detail Kategori')
@section('page-heading', 'Detail Kategori')

@section('content')

<style>
    .bw-detail-header {
        background: linear-gradient(120deg, #A9CFF3, #E4F2FF);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 25px;
    }

    .bw-detail-header h3 {
        color: #244D79;
        font-weight: 800;
    }

    .bw-detail-card {
        background: white;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 5px 18px rgba(80,130,180,.07);
    }

    .bw-detail-label {
        color: #8495AB;
        font-size: 13px;
        font-weight: 700;
    }

    .bw-detail-value {
        color: #345F91;
        font-size: 18px;
        font-weight: 800;
        margin-top: 6px;
    }

    .bw-detail-table th {
        background: #EAF4FF;
        color: #4B79A8;
        border: none;
        padding: 15px;
    }

    .bw-detail-table td {
        vertical-align: middle;
        padding: 15px;
    }

    .bw-status {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 800;
    }

    .bw-status-active {
        background: #DFF5E8;
        color: #238653;
    }

    .bw-status-inactive {
        background: #F0F0F0;
        color: #777;
    }
</style>

<div class="bw-detail-header">
    <div class="row align-items-center">

        <div class="col-md-8">
            <h3>
                <i class="fas fa-folder-open mr-2"></i>
                Detail Kategori Produk
            </h3>

            <p class="mb-0" style="color:#426D99;">
                Informasi kategori dan daftar produk
                BLUEWAVE STATIONERY.
            </p>
        </div>

        <div class="col-md-4 text-md-right mt-3 mt-md-0">
            <a href="{{ route('categories.index') }}"
               class="btn btn-light">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

    </div>
</div>

<!-- INFORMASI KATEGORI -->
<div class="bw-detail-card">

    <h5 class="font-weight-bold mb-4" style="color:#345F91;">
        <i class="fas fa-info-circle mr-2"></i>
        Informasi Kategori
    </h5>

    <div class="row">

        <div class="col-md-6 mb-4">
            <div class="bw-detail-label">
                NAMA KATEGORI
            </div>

            <div class="bw-detail-value">
                {{ $category->name }}
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="bw-detail-label">
                STATUS KATEGORI
            </div>

            <div class="bw-detail-value">
                @if($category->status === 'Aktif')
                    <span class="bw-status bw-status-active">
                        <i class="fas fa-check-circle mr-1"></i>
                        Aktif
                    </span>
                @else
                    <span class="bw-status bw-status-inactive">
                        <i class="fas fa-times-circle mr-1"></i>
                        Tidak Aktif
                    </span>
                @endif
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="bw-detail-label">
                JUMLAH PRODUK
            </div>

            <div class="bw-detail-value">
                {{ $category->products->count() }} Produk
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="bw-detail-label">
                TANGGAL DIBUAT
            </div>

            <div class="bw-detail-value">
                {{ $category->created_at?->format('d M Y') ?? '-' }}
            </div>
        </div>

        <div class="col-md-12">
            <div class="bw-detail-label">
                DESKRIPSI KATEGORI
            </div>

            <p class="mt-2 mb-0 text-muted">
                {{ $category->description ?: 'Belum ada deskripsi kategori.' }}
            </p>
        </div>

    </div>

    <div class="mt-4">
        <a href="{{ route('categories.edit', $category->id) }}"
           class="btn btn-primary">
            <i class="fas fa-edit mr-2"></i>
            Edit Kategori
        </a>

        <a href="{{ route('categories.index') }}"
           class="btn btn-light border">
            <i class="fas fa-list mr-2"></i>
            Semua Kategori
        </a>
    </div>

</div>

<!-- DAFTAR PRODUK -->
<div class="bw-detail-card">

    <h5 class="font-weight-bold mb-4" style="color:#345F91;">
        <i class="fas fa-box-open mr-2"></i>
        Produk dalam Kategori Ini
    </h5>

    <div class="table-responsive">
        <table class="table table-hover bw-detail-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Kode Produk</th>
                    <th>Merek</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($category->products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td class="font-weight-bold">
                            {{ $product->name }}
                        </td>

                        <td>
                            {{ $product->product_code }}
                        </td>

                        <td>
                            {{ $product->brand ?: '-' }}
                        </td>

                        <td>
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </td>

                        <td>
                            @if($product->stock <= 0)
                                <span class="badge badge-danger">
                                    Habis
                                </span>
                            @elseif($product->stock <= 5)
                                <span class="badge badge-warning">
                                    {{ $product->stock }} Unit
                                </span>
                            @else
                                <span class="badge badge-success">
                                    {{ $product->stock }} Unit
                                </span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('products.show', $product->id) }}"
                               class="btn btn-sm btn-info">
                                <i class="fas fa-eye mr-1"></i>
                                Detail
                            </a>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-box-open fa-3x mb-3"
                               style="color:#A9CFF3;"></i>

                            <p class="mb-0">
                                Belum ada produk dalam kategori ini.
                            </p>
                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

</div>

@endsection
