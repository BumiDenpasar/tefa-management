<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Facades\Auth;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'amount',
        'income',
    ];

   

    protected static function booted(): void
    {
        static::addGlobalScope('by_user', function (Builder $builder) {
            if (Auth::check() && !Auth::user()->is_admin) {
                $builder->whereHas('product', function ($query) {
                    $query->where('school_id', Auth::user()->school_id);
                });
            }
        });
    }

    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function school() : HasOneThrough
    {
        return $this->hasOneThrough(
            School::class,        
            Product::class,      
            'school_id',            // Foreign key on the Product table (linking Product to School)
            'id',                   // Foreign key on the School table (linking School to Product)
            'product_id',           // Local key on the Sale model (linking Sale to Product)
            'id'                    // Local key on the Product model (linking Product to School)
        );
    }
}
