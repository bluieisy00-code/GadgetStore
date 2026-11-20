@extends('layouts.app')

@section('title', 'Detail Produk')
@section('page_heading', 'Detail Produk')

@section('content')

<style>
    .bw-detail-hero {
        background: linear-gradient(120deg, #A9CFF3, #E4F2FF);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 25px;
    }

    .bw-detail-hero h3 {
        color: #244D79;
        font-weight: 800;
    }

    .bw-detail-card {
        background: #FFFFFF;
        border: 1px solid #E2EDFA;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 6px 22px rgba(80,130,180,0.08);
    }

    .bw-detail-image {
        background: #F0F7FF;
        border-radius: 18px;
        min-height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        overflow: hidden;
    }

    .bw-detail-image img {
        width: 100%;
        max-height: 380px;
        object-fit: contain;
    }

    .bw-detail-placeholder {
        color: #A9CFF3;
        text-align: center;
    }

    .bw-detail-placeholder i {
        font-size: 90px;
    }

    .bw-detail-category {
        background: #EAF4FF;
        color: #5C91CA;
        border-radius: 10px;
        padding: 8px 14px;
        font-size: 13px;
        font-weight: 800;
        display: inline-block;
    }

    .bw-detail-name {
        color: #244D79;
        font-size: 30px;
        font-weight: 800;
        margin-top: 18px;
        margin-bottom: 12px;
    }

    .bw-detail-price {
        color: #4F8DC9;
        font-size: 32px;
        font-weight: 900;
        margin-bottom: 20px;
    }

    .bw-detail-info {
        border-bottom: 1px solid #E2EDFA;
        padding: 14px 0;
        display: flex;
        justify-content: space-between;
        gap: 15px;
    }

    .bw-detail-info .label {
        color: #8495AB;
        font-weight: 700;
    }

    .bw-detail-info .value {
        color: #345F91;
        font-weight: 800;
        text-align: right;
    }

    .bw-detail-description {
        background: #F5F9FF;
        border-radius: 14px;
        padding: 22px;
        margin-top: 25px;
    }

    .bw-detail-description h5 {
        color: #345F91;
        font-weight: 800;
    }

    .bw-detail-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 25px;
    }

    .bw-detail-actions .btn {
        padding: 11px 20px;
    }

    @media(max-width:768px) {
        .bw-detail-name {
            font-size: 24px;
        }

        .bw-detail-price {
            font-size: 27px;
        }

        .bw-detail-image {
            min-height: 250px;
            margin-bottom: 25px;
        }
    }
</style>

<!-- HEADER -->
<div class="bw-detail-hero">

    <div class="row align-items-center">

        <div class="col-md-8">

            <h3>
                <i class="fas fa-box-open mr-2"></i>
                Detail Produk Stationery
            </h3>

            <p class="mb-0" style="color:#426D99;">
                Informasi lengkap produk BLUEWAVE STATIONERY.
            </p>

        </div>

        <div class="col-md-4 text-md-right mt-3 mt-md-0">

            <a href="{{ route('products.index') }}"
               class="btn btn-light">

                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Produk

            </a>

        </div>

    </div>

</div>

<!-- DETAIL PRODUK -->
<div class="bw-detail-card">

    <div class="row">

        <!-- FOTO PRODUK -->
        <div class="col-lg-5">

            <div class="bw-detail-image">

                @if($product->image)

                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        onerror="this.style.display='none';this.nextElementSibling.style.display='block';">

                    <div class="bw-detail-placeholder"
                         style="display:none;">
                        <i class="fas fa-book-open"></i>
                        <p class="mt-3">Gambar tidak tersedia</p>
                    </div>

                @else

                    <div class="bw-detail-placeholder">
                        <i class="fas fa-book-open"></i>
                        <p class="mt-3">Belum ada foto produk</p>
                    </div>

                @endif

            </div>

        </div>

        <!-- INFORMASI PRODUK -->
        <div class="col-lg-7">

            <span class="bw-detail-category">
                <i class="fas fa-tags mr-1"></i>
                {{ $product->category->name ?? 'Tanpa Kategori' }}
            </span>

            <h2 class="bw-detail-name">
                {{ $product->name }}
            </h2>

            <div class="bw-detail-price">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>

            <!-- STATUS STOK -->
            <div class="mb-3">

                @if($product->stock <= 0)

                    <span class="badge badge-danger p-2">
                        <i class="fas fa-times-circle mr-1"></i>
                        Stok Habis
                    </span>

                @elseif($product->stock <= 5)

                    <span class="badge badge-warning p-2">
                        <i class="fas fa-exclamation-triangle mr-1"></i>
                        Stok Menipis
                    </span>

                @else

                    <span class="badge badge-success p-2">
                        <i class="fas fa-check-circle mr-1"></i>
                        Stok Tersedia
                    </span>

                @endif

            </div>

            <!-- INFORMASI -->
            <div class="bw-detail-info">
                <span class="label">Kode Produk</span>
                <span class="value">{{ $product->product_code }}</span>
            </div>

            <div class="bw-detail-info">
                <span class="label">Merek</span>
                <span class="value">{{ $product->brand ?: '-' }}</span>
            </div>

            <div class="bw-detail-info">
                <span class="label">Kategori</span>
                <span class="value">
                    {{ $product->category->name ?? '-' }}
                </span>
            </div>

            <div class="bw-detail-info">
                <span class="label">Jumlah Stok</span>
                <span class="value">
                    {{ number_format($product->stock) }} Unit
                </span>
            </div>

            <div class="bw-detail-info">
                <span class="label">Harga Satuan</span>
                <span class="value">
                    Rp {{ number_format($product->price, 0, ',', '.') }}
                </span>
            </div>

            <div class="bw-detail-info">
                <span class="label">Nilai Persediaan</span>
                <span class="value">
                    Rp {{ number_format($product->price * $product->stock, 0, ',', '.') }}
                </span>
            </div>

            <!-- TOMBOL -->
            <div class="bw-detail-actions">

                @if(Route::has('products.edit'))

                    <a href="{{ route('products.edit', $product->id) }}"
                       class="btn btn-primary">

                        <i class="fas fa-edit mr-2"></i>
                        Edit Produk

                    </a>

                @endif

                <a href="{{ route('products.index') }}"
                   class="btn btn-light border">

                    <i class="fas fa-list mr-2"></i>
                    Semua Produk

                </a>

            </div>

        </div>

    </div>

    <!-- DESKRIPSI -->
    <div class="bw-detail-description">

        <h5>
            <i class="fas fa-align-left mr-2"></i>
            Deskripsi Produk
        </h5>

        <p class="mb-0 text-muted" style="white-space:pre-line;">{{ $product->description ?: 'Belum ada deskripsi untuk produk ini.' }}</p>

    </div>

</div>

@endsection
