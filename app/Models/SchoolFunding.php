<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolFunding extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'id_sekolah',
        'id_bantuan',
    ];

    public function sekolah(): HasMany
    {
        return $this->hasMany(School::class, 'id', 'id_sekolah');
    }

    public function bantuan(): HasMany
    {
        return $this->hasMany(Funding::class,'id', 'id_bantuan');
    }
}
