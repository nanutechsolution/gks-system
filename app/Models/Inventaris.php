<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'kategori',
        'jumlah',
        'satuan',
        'kondisi',
        'lokasi',
        'tanggal_perolehan',
        'foto_barang',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_perolehan' => 'date',
    ];
}
