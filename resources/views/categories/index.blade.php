@extends('layouts.app')

@section('title', 'Kategori Produk')
@section('page-heading', 'Manajemen Kategori')

@section('content')

@php
    $isAdmin = auth()->check()
        && auth()->user()->role === 'admin';
@endphp

<style>
    .bw-category-hero {
        background: linear-gradient(120deg, #A9CFF3, #E4F2FF);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 25px;
    }

    .bw-category-hero h3 {
        color: #244D79;
        font-weight: 800;
    }

    .bw-category-hero p {
        color: #426D99;
    }

    .bw-category-stat {
        background: #FFFFFF;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        padding: 23px;
        height: 100%;
        box-shadow: 0 5px 18px rgba(80,130,180,0.07);
    }

    .bw-category-stat-label {
        color: #7893B0;
        font-size: 13px;
        font-weight: 700;
    }

    .bw-category-stat-value {
        color: #345F91;
        font-size: 28px;
        font-weight: 800;
        margin-top: 8px;
    }

    .bw-category-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: #E5F2FF;
        color: #5C91CA;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .bw-category-panel {
        background: #FFFFFF;
        border: 1px solid #E2EDFA;
        border-radius: 18px;
        padding: 24px;
        margin-bottom: 25px;
        box-shadow: 0 5px 18px rgba(80,130,180,0.07);
    }

    .bw-category-table th {
        background: #EAF4FF;
        color: #4B79A8;
        border: none;
        padding: 15px;
        white-space: nowrap;
    }

    .bw-category-table td {
        vertical-align: middle;
        padding: 15px;
        border-color: #E2EDFA;
    }

    .bw-category-name {
        font-weight: 800;
        color: #345F91;
    }

    .bw-category-description {
        color: #8495AB;
        font-size: 13px;
    }

    .bw-category-actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .bw-category-empty {
        text-align: center;
        padding: 50px 20px;
        color: #8495AB;
    }

    .bw-category-empty i {
        font-size: 48px;
        color: #A9CFF3;
        margin-bottom: 15px;
    }

    .bw-filter-label {
        color: #345F91;
        font-weight: 700;
        font-size: 14px;
    }

    .bw-filter-input {
        border: 1px solid #D6E6F8;
        border-radius: 10px;
        height: 43px;
    }

    .bw-filter-input:focus {
        border-color: #83B5E6;
        box-shadow: 0 0 0 3px rgba(131,181,230,.15);
    }

    .bw-status-active {
        background: #DFF5E8;
        color: #238653;
        padding: 7px 12px;
        border-radius: 9px;
        font-weight: 700;
        font-size: 12px;
        display: inline-block;
    }

    .bw-status-inactive {
        background: #F0F0F0;
        color: #777777;
        padding: 7px 12px;
        border-radius: 9px;
        font-weight: 700;
        font-size: 12px;
        display: inline-block;
    }
</style>

<!-- HEADER -->
<div class="bw-category-hero">

    <div class="row align-items-center">

        <div class="col-md-8">

            <h3>
                <i class="fas fa-tags mr-2"></i>
                Kategori Produk Stationery
            </h3>

            <p class="mb-0">
                Kelola kategori alat tulis, buku,
                perlengkapan sekolah, dan kebutuhan kantor.
            </p>

        </div>

        @if($isAdmin)

            <div class="col-md-4 text-md-right mt-3 mt-md-0">

                <a href="{{ route('categories.create') }}"
                   class="btn btn-primary">

                    <i class="fas fa-plus mr-2"></i>
                    Tambah Kategori

                </a>

            </div>

        @endif

    </div>

</div>

<!-- STATISTIK -->
<div class="row mb-4">

    <!-- TOTAL KATEGORI -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-category-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <div class="bw-category-stat-label">
                        TOTAL KATEGORI
                    </div>

                    <div class="bw-category-stat-value">
                        {{ number_format($totalCategories) }}
                    </div>

                </div>

                <div class="bw-category-icon">
                    <i class="fas fa-tags"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- KATEGORI AKTIF -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-category-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <div class="bw-category-stat-label">
                        KATEGORI AKTIF
                    </div>

                    <div class="bw-category-stat-value">
                        {{ number_format($activeCategories) }}
                    </div>

                </div>

                <div class="bw-category-icon">
                    <i class="fas fa-check-circle"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- KATEGORI TIDAK AKTIF -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-category-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <div class="bw-category-stat-label">
                        TIDAK AKTIF
                    </div>

                    <div class="bw-category-stat-value">
                        {{ number_format($inactiveCategories) }}
                    </div>

                </div>

                <div class="bw-category-icon">
                    <i class="fas fa-times-circle"></i>
                </div>

            </div>

        </div>

    </div>

    <!-- TOTAL PRODUK -->
    <div class="col-xl-3 col-md-6 mb-3">

        <div class="bw-category-stat">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <div class="bw-category-stat-label">
                        TOTAL PRODUK
                    </div>

                    <div class="bw-category-stat-value">
                        {{ number_format($totalProducts) }}
                    </div>

                </div>

                <div class="bw-category-icon">
                    <i class="fas fa-box-open"></i>
                </div>

            </div>

        </div>

    </div>

</div>

<!-- PENCARIAN DAN FILTER -->
<div class="bw-category-panel">

    <h5 class="font-weight-bold mb-4"
        style="color:#345F91;">

        <i class="fas fa-filter mr-2"></i>
        Pencarian dan Filter Kategori

    </h5>

    <form method="GET"
          action="{{ route('categories.index') }}">

        <div class="row align-items-end">

            <!-- CARI -->
            <div class="col-lg-5 col-md-6 mb-3 mb-lg-0">

                <label class="bw-filter-label">
                    Cari Kategori
                </label>

                <input
                    type="text"
                    name="q"
                    class="form-control bw-filter-input"
                    placeholder="Cari nama atau deskripsi..."
                    value="{{ request('q') }}">

            </div>

            <!-- FILTER STATUS -->
            <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">

                <label class="bw-filter-label">
                    Status Kategori
                </label>

                <select
                    name="status"
                    class="form-control bw-filter-input">

                    <option value="">
                        Semua Status
                    </option>

                    <option value="Aktif"
                        {{ request('status') === 'Aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="Tidak Aktif"
                        {{ request('status') === 'Tidak Aktif' ? 'selected' : '' }}>
                        Tidak Aktif
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

                <a href="{{ route('categories.index') }}"
                   class="btn btn-light border">

                    <i class="fas fa-undo mr-1"></i>
                    Reset

                </a>

            </div>

        </div>

    </form>

</div>

<!-- DAFTAR KATEGORI -->
<div class="bw-category-panel">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h5 class="font-weight-bold mb-0"
            style="color:#345F91;">

            <i class="fas fa-list mr-2"></i>
            Daftar Kategori Produk

        </h5>

        <span class="badge badge-info p-2">
            {{ $categories->total() }} Kategori
        </span>

    </div>

    <!-- NOTIFIKASI BERHASIL -->
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="fas fa-check-circle mr-2"></i>
            {{ session('success') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

    @endif

    <!-- NOTIFIKASI ERROR -->
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">

            <i class="fas fa-exclamation-circle mr-2"></i>
            {{ session('error') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>

    @endif

    <div class="table-responsive">

        <table class="table table-hover bw-category-table">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Produk</th>
                    <th>Status</th>

                    @if($isAdmin)
                        <th>Aksi</th>
                    @endif

                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr>

                        <!-- NOMOR -->
                        <td>
                            {{ $categories->firstItem() + $loop->index }}
                        </td>

                        <!-- NAMA -->
                        <td>

                            <div class="bw-category-name">

                                <i class="fas fa-folder text-primary mr-2"></i>

                                {{ $category->name }}

                            </div>

                        </td>

                        <!-- DESKRIPSI -->
                        <td>

                            <div class="bw-category-description">

                                {{ \Illuminate\Support\Str::limit($category->description ?: '-', 65) }}

                            </div>

                        </td>

                        <!-- JUMLAH PRODUK -->
                        <td>

                            <span class="badge badge-info">

                                {{ $category->products_count }} Produk

                            </span>

                        </td>

                        <!-- STATUS -->
                        <td>

                            @if($category->status === 'Aktif')

                                <span class="bw-status-active">

                                    <i class="fas fa-check-circle mr-1"></i>
                                    Aktif

                                </span>

                            @else

                                <span class="bw-status-inactive">

                                    <i class="fas fa-times-circle mr-1"></i>
                                    Tidak Aktif

                                </span>

                            @endif

                        </td>

                        <!-- AKSI ADMIN -->
                        @if($isAdmin)

                            <td>

                                <div class="bw-category-actions">

                                    <!-- DETAIL -->
                                    <a href="{{ route('categories.show', $category->id) }}"
                                       class="btn btn-sm btn-info"
                                       title="Detail Kategori">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    <!-- EDIT -->
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                       class="btn btn-sm btn-primary"
                                       title="Edit Kategori">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <!-- HAPUS -->
                                    <form
                                        method="POST"
                                        action="{{ route('categories.destroy', $category->id) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="Hapus Kategori">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        @endif

                    </tr>

                @empty

                    <tr>

                        <td colspan="{{ $isAdmin ? 6 : 5 }}">

                            <div class="bw-category-empty">

                                <i class="fas fa-folder-open"></i>

                                <h5 class="font-weight-bold">
                                    Kategori Tidak Ditemukan
                                </h5>

                                <p class="mb-0">
                                    Belum ada kategori yang sesuai
                                    dengan pencarian atau filter.
                                </p>

                                <a href="{{ route('categories.index') }}"
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
    @if($categories->hasPages())

        <div class="mt-4">

            {{ $categories->links() }}

        </div>

    @endif

</div>

@endsection
