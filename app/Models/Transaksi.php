<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = ['kasir_id', 'total_harga'];

    public function kasir()
    {
        return $this->belongsTo(Kasir::class);
    }

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'detail_transaksi')
                    ->withPivot('jumlah', 'subtotal');
    }
}
