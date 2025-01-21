@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 text-center">Daftar Transaksi</h1>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-lg">
            <i class="bi bi-plus-circle"></i> Tambah Transaksi
        </a>
        <a href="#" onclick="window.print();" class="btn btn-success btn-lg">
            <i class="bi bi-printer"></i> Cetak Transaksi
        </a>
    </div>

    <!-- Card Section -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Table Section -->
            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Kasir</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksi as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->kasir->nama }}</td>
                                <td>
                                    <div class="d-flex flex-column">
                                        @foreach ($item->produk as $produk)
                                            <div>
                                                <strong>{{ $produk->nama }}</strong>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        @foreach ($item->produk as $produk)
                                            <div>
                                                {{ $produk->pivot->jumlah }}
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td>Rp{{ number_format($item->total_harga, 2, ',', '.') }}</td>
                                <td>{{ $item->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('transaksi.show', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                    <a href="{{ route('transaksi.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('transaksi.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
