<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        return view('produk.index', compact('produk'));
    }

    public function create()
    {
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('produk_gambar', 'public');
            $validated['gambar'] = $path;
        }

        Produk::create($validated);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
{
    $produk = Produk::findOrFail($id);
    return view('produk.edit', compact('produk'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'stok' => 'required|integer',
        'harga' => 'required|numeric',
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $produk = Produk::findOrFail($id);

    if ($request->hasFile('gambar')) {
        // Hapus gambar lama jika ada
        if ($produk->gambar) {
            Storage::delete('public/' . $produk->gambar);
        }

        $path = $request->file('gambar')->store('produk_gambar', 'public');
        $validated['gambar'] = $path;
    }

    $produk->update($validated);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
}

public function destroy($id)
{
    $produk = Produk::findOrFail($id);

    // Hapus gambar jika ada
    if ($produk->gambar) {
        Storage::delete('public/' . $produk->gambar);
    }

    $produk->delete();

    return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
}

}

