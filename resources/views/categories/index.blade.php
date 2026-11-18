@extends('layouts.app')

@section('title','Kategori Produk')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="fw-bold">Kategori Produk</h3>

    <a class="btn btn-primary" href="{{ route('categories.create') }}">
        Tambah Kategori
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-hover align-middle">

                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Jumlah Produk</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($categories as $category)

                        <tr>
                            <td class="fw-semibold">
                                {{ $category->name }}
                            </td>

                            <td>
                                {{ $category->description ?? '-' }}
                            </td>

                            <td>
                                {{ $category->products_count }}
                            </td>

                            <td>
                                @if($category->status == 'Aktif')
                                    <span class="badge bg-success">
                                        Aktif
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>

                            <td>
                                <a
                                    class="btn btn-sm btn-warning"
                                    href="{{ route('categories.edit',$category) }}"
                                >
                                    Edit
                                </a>

                                <form
                                    class="d-inline"
                                    method="POST"
                                    action="{{ route('categories.destroy',$category) }}"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Hapus kategori?')"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center text-secondary">
                                Belum ada kategori.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>
        </div>

        {{ $categories->links() }}

    </div>
</div>

@endsection
