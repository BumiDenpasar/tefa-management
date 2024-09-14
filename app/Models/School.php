<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sekolah',
        'nama_tefa',
        'deskripsi',
        'no_kontak',
        'npsn',
    ];

    public function bantuan(): BelongsToMany
    {
        return $this->BelongsToMany(Funding::class, "school_fundings", "id_sekolah", "id_bantuan");
    }

    public function produk(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
