<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sekolah',
        'img',
        'harga_produk',
        'nama_produk',
        'deskripsi',
        'total_jual',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('by_user', function (Builder $builder){
            if(Auth::check() && !Auth::user()->is_admin){
                $builder->where('id_sekolah', Auth::user()->id_sekolah);
            }
        });
    }


    public function getTotalSalesAttribute()
    {
        return $this->sales->sum('jumlah');
    }

    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(School::class, 'id_sekolah', 'id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'id_produk', 'id');
    }

    public function produk(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
