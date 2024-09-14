<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sekolah',
        'harga_produk',
        'nama_produk',
        'total_jual',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
