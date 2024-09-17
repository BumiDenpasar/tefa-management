<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'logo',
        'nama_sekolah',
        'sosial_media',
        'nama_tefa',
        'deskripsi',
        'no_kontak',
        'npsn',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('by_user', function (Builder $builder){
            if(Auth::check() && !Auth::user()->is_admin){
                $builder->where('id', Auth::user()->id_sekolah);
            }
        });
    }


    public function bantuan(): BelongsToMany
    {
        return $this->BelongsToMany(Funding::class, "school_fundings", "id_sekolah", "id_bantuan");
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, "id_sekolah", 'id');
    }

    public function produk(): HasMany
    {
        return $this->hasMany(Product::class, 'id_sekolah', 'id');
    }
}
