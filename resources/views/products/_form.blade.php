@php
    $isEdit = isset($product);
    $currentImage = $isEdit ? $product->image : null;
@endphp

<style>
    .bw-form-card {
        background: #FFFFFF;
        border: 1px solid #E2EDFA;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 6px 22px rgba(80,130,180,0.07);
    }

    .bw-form-section {
        font-size: 17px;
        font-weight: 800;
        color: #345F91;
        border-bottom: 1px solid #E2EDFA;
        padding-bottom: 12px;
        margin-bottom: 22px;
    }

    .bw-form-card label {
        font-weight: 700;
        color: #4D698A;
    }

    .bw-image-preview {
        width: 100%;
        max-width: 260px;
        height: 200px;
        border: 2px dashed #B8D8F8;
        border-radius: 16px;
        background: #F5F9FF;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .bw-image-preview img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }

    .bw-image-placeholder {
        text-align: center;
        color: #8BBCEB;
    }

    .bw-image-placeholder i {
        font-size: 48px;
        margin-bottom: 10px;
    }

    .bw-form-footer {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-top: 28px;
    }
</style>

<div class="bw-form-card">

    <div class="bw-form-section">
        <i class="fas fa-box-open mr-2"></i>
        Informasi Produk
    </div>

    <div class="row">

        <!-- KODE PRODUK -->
        <div class="col-md-6 mb-3">
            <label for="product_code">Kode Produk <span class="text-danger">*</span></label>

            <input
                type="text"
                name="product_code"
                id="product_code"
                class="form-control @error('product_code') is-invalid @enderror"
                value="{{ old('product_code', $product->product_code ?? '') }}"
                placeholder="Contoh: BW-PEN-001"
                required>

            @error('product_code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- NAMA PRODUK -->
        <div class="col-md-6 mb-3">
            <label for="name">Nama Produk <span class="text-danger">*</span></label>

            <input
                type="text"
                name="name"
                id="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $product->name ?? '') }}"
                placeholder="Contoh: Pulpen Gel Biru"
                required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- KATEGORI -->
        <div class="col-md-6 mb-3">
            <label for="category_id">Kategori <span class="text-danger">*</span></label>

            <select
                name="category_id"
                id="category_id"
                class="form-control @error('category_id') is-invalid @enderror"
                required>

                <option value="">-- Pilih Kategori --</option>

                @foreach($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>
                @endforeach

            </select>

            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- MEREK -->
        <div class="col-md-6 mb-3">
            <label for="brand">Merek Produk</label>

            <input
                type="text"
                name="brand"
                id="brand"
                class="form-control @error('brand') is-invalid @enderror"
                value="{{ old('brand', $product->brand ?? '') }}"
                placeholder="Contoh: Joyko, Faber-Castell">

            @error('brand')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- HARGA -->
        <div class="col-md-6 mb-3">
            <label for="price">Harga Produk (Rp) <span class="text-danger">*</span></label>

            <input
                type="number"
                name="price"
                id="price"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $product->price ?? '') }}"
                placeholder="Contoh: 15000"
                min="0"
                step="0.01"
                required>

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- STOK -->
        <div class="col-md-6 mb-3">
            <label for="stock">Jumlah Stok <span class="text-danger">*</span></label>

            <input
                type="number"
                name="stock"
                id="stock"
                class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock', $product->stock ?? 0) }}"
                placeholder="Contoh: 50"
                min="0"
                required>

            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- DESKRIPSI -->
        <div class="col-12 mb-3">
            <label for="description">Deskripsi Produk</label>

            <textarea
                name="description"
                id="description"
                rows="4"
                class="form-control @error('description') is-invalid @enderror"
                placeholder="Tuliskan deskripsi singkat produk...">{{ old('description', $product->description ?? '') }}</textarea>

            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="bw-form-section mt-4">
        <i class="fas fa-image mr-2"></i>
        Foto Produk
    </div>

    <div class="row align-items-center">

        <div class="col-md-5">

            <div class="bw-image-preview" id="imagePreview">

                @if($currentImage)
                    <img
                        src="{{ asset('storage/' . $currentImage) }}"
                        alt="Foto produk"
                        id="previewImg">
                @else
                    <div class="bw-image-placeholder" id="previewPlaceholder">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <div>Preview gambar produk</div>
                    </div>
                @endif

            </div>

        </div>

        <div class="col-md-7">

            <label for="image">Upload Gambar</label>

            <input
                type="file"
                name="image"
                id="image"
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                class="form-control-file @error('image') is-invalid @enderror">

            <small class="form-text text-muted mt-2">
                Format JPG, JPEG, PNG, atau WEBP.
                Ukuran maksimal 5 MB.
            </small>

            @if($isEdit && $currentImage)
                <small class="form-text text-info">
                    Kosongkan jika tidak ingin mengganti foto lama.
                </small>
            @endif

            @error('image')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror

        </div>

    </div>

    <!-- TOMBOL -->
    <div class="bw-form-footer">

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-2"></i>
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Produk' }}
        </button>

        <a href="{{ route('products.index') }}"
           class="btn btn-light border">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image');
    const previewBox = document.getElementById('imagePreview');

    if (!imageInput || !previewBox) {
        return;
    }

    imageInput.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (!file) {
            return;
        }

        if (!file.type.startsWith('image/')) {
            alert('Pilih file gambar yang valid.');
            this.value = '';
            return;
        }

        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 5 MB.');
            this.value = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            previewBox.innerHTML = '';

            const img = document.createElement('img');
            img.src = event.target.result;
            img.alt = 'Preview produk';
            img.id = 'previewImg';

            previewBox.appendChild(img);
        };

        reader.readAsDataURL(file);
    });
});
</script>
