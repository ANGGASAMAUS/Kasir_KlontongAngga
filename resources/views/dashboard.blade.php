@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary">Selamat Datang di Aplikasi Kasir</h1>
        <p class="text-secondary">Kelola produk, kasir, dan transaksi Anda dengan mudah!</p>
    </div>

    <!-- Dashboard Content -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row g-4">
                <!-- Card Produk -->
                <div class="col-md-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-box text-primary display-3 mb-3"></i>
                            <h5 class="card-title fw-bold">Produk</h5>
                            <p class="card-text text-muted">Kelola daftar produk Anda dengan mudah.</p>
                            <a href="{{ route('produk.index') }}" class="btn btn-primary w-100">
                                <i class="bi bi-box"></i> Kelola Produk
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Kasir -->
                <div class="col-md-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-person text-success display-3 mb-3"></i>
                            <h5 class="card-title fw-bold">Kasir</h5>
                            <p class="card-text text-muted">Lihat dan atur data kasir dengan cepat.</p>
                            <a href="{{ route('kasir.index') }}" class="btn btn-success w-100">
                                <i class="bi bi-person"></i> Kelola Kasir
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card Transaksi -->
                <div class="col-md-4">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-receipt text-warning display-3 mb-3"></i>
                            <h5 class="card-title fw-bold">Transaksi</h5>
                            <p class="card-text text-muted">Kelola semua transaksi Anda dengan efisien.</p>
                            <a href="{{ route('transaksi.index') }}" class="btn btn-warning w-100">
                                <i class="bi bi-receipt"></i> Kelola Transaksi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-5 text-center">
        <p class="text-muted">Aplikasi Kasir v1.0 &bull; {{ date('Y') }}</p>
    </div>
</div>
@endsection
