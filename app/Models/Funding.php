<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Funding extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'amount',
        'source',
    ];

    public function schools(): BelongsToMany
    {
        return $this->belongsToMany(School::class, "school_fundings", "school_id", "school_id"
    , "funding_id");
    }
}
