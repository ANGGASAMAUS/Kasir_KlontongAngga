<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = Transaksi::with(['kasir', 'produk'])->get();
        return view('transaksi.index', compact('transaksi'));
    }

    public function create()
    {
        $produk = Produk::all();
        $kasir = Kasir::all();
        return view('transaksi.create', compact('produk', 'kasir'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'kasir_id' => 'required|exists:kasir,id',
        'produk_id.*' => 'required|exists:produk,id',
        'jumlah.*' => 'required|integer|min:1',
    ]);

    $totalHarga = 0;
    $detail = [];

    foreach ($request->produk_id as $key => $produkId) {
        $produk = Produk::findOrFail($produkId);
        $jumlah = $request->jumlah[$key];
        $subtotal = $produk->harga * $jumlah;

        $totalHarga += $subtotal;

        $detail[] = [
            'produk_id' => $produkId,
            'jumlah' => $jumlah,
            'subtotal' => $subtotal,
        ];
    }

    $transaksi = Transaksi::create([
        'kasir_id' => $validated['kasir_id'],
        'total_harga' => $totalHarga,
    ]);

    foreach ($detail as $item) {
        $transaksi->produk()->attach($item['produk_id'], [
            'jumlah' => $item['jumlah'],
            'subtotal' => $item['subtotal'],
        ]);
    }

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
}





    public function edit($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $produk = Produk::all();
    $kasir = Kasir::all();
    return view('transaksi.edit', compact('transaksi', 'produk', 'kasir'));
}

public function update(Request $request, $id)
{
    $transaksi = Transaksi::findOrFail($id);

    $validated = $request->validate([
        'kasir_id' => 'required|exists:kasir,id',
        'produk_id' => 'required|exists:produk,id',
        'jumlah' => 'required|integer|min:1',
    ]);

    $produk = Produk::findOrFail($validated['produk_id']);
    $validated['total_harga'] = $produk->harga * $validated['jumlah'];

    $transaksi->update($validated);

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
}

public function destroy($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $transaksi->delete();

    return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
}

public function print()
{
    $transaksi = Transaksi::with(['kasir', 'produk'])->get();
    return view('transaksi.print', compact('transaksi'));
}

public function show($id)
{
    $transaksi = Transaksi::with(['kasir', 'produk'])->findOrFail($id);
    return view('transaksi.show', compact('transaksi'));
}


}
