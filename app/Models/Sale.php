<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_produk',
        'jumlah',
        'pemasukan',
    ];

   

    protected static function booted(): void
    {
        static::addGlobalScope('by_user', function (Builder $builder) {
            if (Auth::check() && !Auth::user()->is_admin) {
                $builder->whereHas('produk', function ($query) {
                    $query->where('id_sekolah', Auth::user()->id_sekolah);
                });
            }
        });
    }

    public function produk(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'id_produk');
    }
}
