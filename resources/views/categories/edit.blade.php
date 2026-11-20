@extends('layouts.app')

@section('title', 'Edit Kategori')
@section('page-heading', 'Edit Kategori')

@section('content')

<style>
    .bw-form-header {
        background: linear-gradient(120deg, #A9CFF3, #E4F2FF);
        border-radius: 20px;
        padding: 28px;
        margin-bottom: 25px;
    }

    .bw-form-header h3 {
        color: #244D79;
        font-weight: 800;
    }

    .bw-form-card {
        background: #FFFFFF;
        border: 1px solid #E2EDFA;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 6px 22px rgba(80,130,180,.08);
    }

    .bw-form-card label {
        color: #345F91;
        font-weight: 700;
    }

    .bw-form-card .form-control {
        border: 1px solid #D6E6F8;
        border-radius: 12px;
        padding: 12px 15px;
        height: auto;
    }

    .bw-form-card .form-control:focus {
        border-color: #83B5E6;
        box-shadow: 0 0 0 3px rgba(131,181,230,.15);
    }

    .bw-form-actions {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 25px;
    }
</style>

<div class="bw-form-header">
    <div class="row align-items-center">

        <div class="col-md-8">
            <h3>
                <i class="fas fa-edit mr-2"></i>
                Edit Kategori Produk
            </h3>

            <p class="mb-0" style="color:#426D99;">
                Perbarui informasi kategori BLUEWAVE STATIONERY.
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

<div class="bw-form-card">

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang dimasukkan.</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ route('categories.update', $category->id) }}">

        @csrf
        @method('PUT')

        <div class="form-group mb-4">
            <label for="name">Nama Kategori</label>

            <input
                type="text"
                name="name"
                id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $category->name) }}"
                placeholder="Masukkan nama kategori"
                required>

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="description">Deskripsi</label>

            <textarea
                name="description"
                id="description"
                rows="4"
                class="form-control @error('description') is-invalid @enderror"
                placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description) }}</textarea>

            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group mb-4">
            <label for="status">Status Kategori</label>

            <select
                name="status"
                id="status"
                class="form-control @error('status') is-invalid @enderror"
                required>

                <option value="Aktif"
                    {{ old('status', $category->status) === 'Aktif' ? 'selected' : '' }}>
                    Aktif
                </option>

                <option value="Tidak Aktif"
                    {{ old('status', $category->status) === 'Tidak Aktif' ? 'selected' : '' }}>
                    Tidak Aktif
                </option>

            </select>

            @error('status')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="bw-form-actions">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save mr-2"></i>
                Simpan Perubahan
            </button>

            <a href="{{ route('categories.index') }}"
               class="btn btn-light border">
                <i class="fas fa-times mr-2"></i>
                Batal
            </a>
        </div>

    </form>
</div>

@endsection
