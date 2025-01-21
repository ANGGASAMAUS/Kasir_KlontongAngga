@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Tambah Transaksi</h1>
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Tambah Transaksi</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="kasir_id" class="form-label">Kasir</label>
                    <select name="kasir_id" id="kasir_id" class="form-control" required>
                        <option value="" disabled selected>Pilih Kasir</option>
                        @foreach ($kasir as $k)
                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="produk-container">
                    <div class="produk-item mb-3">
                        <label for="produk_id[]" class="form-label">Produk</label>
                        <select name="produk_id[]" class="form-control mb-2" required>
                            <option value="" disabled selected>Pilih Produk</option>
                            @foreach ($produk as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                            @endforeach
                        </select>
                        <label for="jumlah[]" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah[]" class="form-control" min="1" required>
                    </div>
                </div>
                <button type="button" id="add-produk" class="btn btn-secondary mb-3">Tambah Produk</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById('add-produk').addEventListener('click', function() {
        const produkContainer = document.getElementById('produk-container');
        const produkItem = document.createElement('div');
        produkItem.className = 'produk-item mb-3';
        produkItem.innerHTML = `
            <label for="produk_id[]" class="form-label">Produk</label>
            <select name="produk_id[]" class="form-control mb-2" required>
                <option value="" disabled selected>Pilih Produk</option>
                @foreach ($produk as $p)
                <option value="{{ $p->id }}">{{ $p->nama }}</option>
                @endforeach
            </select>
            <label for="jumlah[]" class="form-label">Jumlah</label>
            <input type="number" name="jumlah[]" class="form-control" min="1" required>
        `;
        produkContainer.appendChild(produkItem);
    });
</script>
@endsection
