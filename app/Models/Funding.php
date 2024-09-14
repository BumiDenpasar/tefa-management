<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Funding extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_bantuan',
        'total_bantuan',
        'sumber_bantuan',
    ];

    public function sekolah(): BelongsToMany
    {
        return $this->belongsToMany(School::class, "school_fundings", "id_sekolah", "id_sekolah"
    , "id_bantuan");
    }
}
