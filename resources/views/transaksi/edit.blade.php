@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Transaksi</h1>
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Edit Transaksi</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="kasir_id" class="form-label">Kasir</label>
                    <select name="kasir_id" id="kasir_id" class="form-control" required>
                        @foreach ($kasir as $k)
                        <option value="{{ $k->id }}" {{ $transaksi->kasir_id == $k->id ? 'selected' : '' }}>{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="produk_id" class="form-label">Produk</label>
                    <select name="produk_id" id="produk_id" class="form-control" required>
                        @foreach ($produk as $p)
                        <option value="{{ $p->id }}" {{ $transaksi->produk_id == $p->id ? 'selected' : '' }}>{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" value="{{ $transaksi->jumlah }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
