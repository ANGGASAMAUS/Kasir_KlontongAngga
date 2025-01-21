@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded-lg border-0">
        <div class="card-body p-5">
            <h2 class="text-center mb-4 text-primary">Detail Transaksi</h2>

            <!-- ID Transaksi -->
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <h5 class="fw-bold">ID Transaksi:</h5>
                    <p class="text-muted">{{ $transaksi->id }}</p>
                </div>
            </div>

            <!-- Kasir -->
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <h5 class="fw-bold">Kasir:</h5>
                    <p class="text-muted">{{ $transaksi->kasir->nama }}</p>
                </div>
            </div>

            <!-- Produk -->
            <div class="row mb-3">
                <div class="col-12">
                    <h5 class="fw-bold">Produk:</h5>
                    <ul class="list-group">
                        @foreach ($transaksi->produk as $produk)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $produk->nama }}</span>
                                <span class="badge bg-secondary">{{ $produk->pivot->jumlah }} pcs</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Total Harga -->
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <h5 class="fw-bold">Total Harga:</h5>
                    <p class="text-success">Rp{{ number_format($transaksi->total_harga, 2, ',', '.') }}</p>
                </div>
            </div>

            <!-- Tanggal -->
            <div class="row mb-3">
                <div class="col-12 col-md-6">
                    <h5 class="fw-bold">Tanggal:</h5>
                    <p class="text-muted">{{ $transaksi->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

            <!-- Print Button -->
            <div class="text-center">
                <button class="btn btn-success btn-lg" onclick="window.print()">
                    <i class="bi bi-printer"></i> Cetak Struk
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
