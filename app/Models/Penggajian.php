<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penggajian extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'pelayan_id',
        'tanggal_bayar',
        'periode_bulan',
        'total_kehadiran',
        'total_insentif',
        'catatan'
    ];

    public function pelayan()
    {
        return $this->belongsTo(Pelayan::class);
    }
}
