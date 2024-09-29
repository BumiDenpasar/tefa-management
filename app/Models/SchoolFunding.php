<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolFunding extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'school_id',
        'funding_id',
    ];

    public function schools(): HasMany
    {
        return $this->hasMany(School::class, 'id', 'school_id');
    }

    public function fundings(): HasMany
    {
        return $this->hasMany(Funding::class,'id', 'funding_id');
    }
}
