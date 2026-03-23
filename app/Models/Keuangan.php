<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'rekening_id',
        'tanggal',
        'jenis',
        'kategori',
        'nominal',
        'bukti_transaksi',
        'referensi',
        'keterangan',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'nominal' => 'decimal:2',
    ];


    public function rekening()
    {
        return $this->belongsTo(Rekening::class);
    }
}
