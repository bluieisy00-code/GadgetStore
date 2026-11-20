@extends('layouts.app')

@section('title', 'Edit Produk')
@section('page_heading', 'Edit Produk')

@section('content')

<div class="card border-0 mb-4"
     style="background:linear-gradient(120deg,#A9CFF3,#E4F2FF);">

    <div class="card-body p-4">

        <h3 class="font-weight-bold" style="color:#244D79;">
            <i class="fas fa-edit mr-2"></i>
            Edit Produk Stationery
        </h3>

        <p class="mb-0" style="color:#426D99;">
            Perbarui informasi produk:
            <strong>{{ $product->name }}</strong>
        </p>

    </div>

</div>

<form
    method="POST"
    action="{{ route('products.update', $product->id) }}"
    enctype="multipart/form-data">

    @csrf
    @method('PUT')

    @include('products._form')

</form>

@endsection
