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
        'school_id',
        'img',
        'description',
        'price',
        'name',
        'total_sales',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('by_user', function (Builder $builder){
            if(Auth::check() && !Auth::user()->is_admin){
                $builder->where('school_id', Auth::user()->school_id);
            }
        });
    }


    public function getTotalSalesAttribute()
    {
        return $this->sales->sum('amount');
    }

    public function getTotalProfitAttribute()
    {
        return $this->sales->sum('income');
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class, 'school_id', 'id');
    }

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'product_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
