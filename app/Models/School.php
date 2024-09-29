<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Facades\Auth;

class School extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'social_media',
        'tefa_name',
        'description',
        'contact_number',
        'npsn',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('by_user', function (Builder $builder){
            if(Auth::check() && !Auth::user()->is_admin){
                $builder->where('id', Auth::user()->school_id);
            }
        });
    }


    public function fundings(): BelongsToMany
    {
        return $this->BelongsToMany(Funding::class, "school_fundings", "school_id", "funding_id");
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, "school_id", 'id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'school_id', 'id');
    }

    public function sale() : HasOneThrough
    {
        return $this->hasOneThrough(Sale::class, Product::class, 'school_id', 'product_id', localKey: 'id', secondLocalKey: 'id');
    }
}
