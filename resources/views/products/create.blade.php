@extends('layouts.app')
@section('content')
<h3>Tambah Produk</h3>
<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
@csrf
@include('products._form')
<button class="btn btn-primary mt-3">Simpan Produk</button>
</form>
@endsection
@extends('layouts.app')

@section('title', 'Tambah Produk')
@section('page_heading', 'Tambah Produk Baru')

@section('content')

<div class="card border-0 mb-4"
     style="background:linear-gradient(120deg,#A9CFF3,#E4F2FF);">

    <div class="card-body p-4">

        <h3 class="font-weight-bold" style="color:#244D79;">
            <i class="fas fa-plus-circle mr-2"></i>
            Tambah Produk Stationery
        </h3>

        <p class="mb-0" style="color:#426D99;">
            Lengkapi informasi produk baru untuk
            BLUEWAVE STATIONERY.
        </p>

    </div>

</div>

<form
    method="POST"
    action="{{ route('products.store') }}"
    enctype="multipart/form-data">

    @csrf

    @include('products._form')

</form>

@endsection
