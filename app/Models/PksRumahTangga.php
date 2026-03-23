<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PksRumahTangga extends Model
{
    protected $fillable = [
        'keluarga_id', 'tanggal', 'jam', 'pelayan_firman', 
        'liturgos', 'pemusik', 'tema', 'sektor'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(Keluarga::class);
    }
}
