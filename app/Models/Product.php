<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sekolah',
        'harga_produk',
        'nama_produk',
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

    public function produk(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
