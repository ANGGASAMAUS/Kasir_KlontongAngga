@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-primary">Daftar Produk</h1>
        <a href="{{ route('produk.create') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle"></i> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($produk->isEmpty())
        <div class="text-center mt-5">
            <h3 class="text-secondary">Belum ada produk yang tersedia</h3>
            <a href="{{ route('produk.create') }}" class="btn btn-outline-primary mt-3">Tambah Produk Sekarang</a>
        </div>
    @else
        <div class="row g-4">
            @foreach ($produk as $item)
                <div class="col-md-4">
                    <div class="card border-0 shadow-lg">
                        <div class="position-relative">
                            @if ($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" 
                                     class="card-img-top rounded-top" 
                                     alt="{{ $item->nama }}" 
                                     style="height: 250px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/300x200?text=No+Image" 
                                     class="card-img-top rounded-top" 
                                     alt="No Image">
                            @endif
                            <div class="badge bg-primary position-absolute top-0 end-0 m-2 p-2">
                                Stok: {{ $item->stok }}
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title fw-bold text-dark">{{ $item->nama }}</h5>
                            <p class="card-text text-muted">Harga: 
                                <span class="fw-bold text-success">Rp{{ number_format($item->harga, 0, ',', '.') }}</span>
                            </p>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('produk.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer text-muted text-center">
                            Terakhir diperbarui: {{ $item->updated_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
