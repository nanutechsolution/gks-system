<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratKeterangan extends Model
{
    use HasFactory;

    protected $table = 'surat_keterangans';

    protected $fillable = [
        'nomor_surat',
        'jemaat_id',
        'jenis_surat',
        'keperluan',
        'tanggal_surat',
        'tujuan_surat',
    ];

    protected $casts = [
        'tanggal_surat' => 'date',
    ];

    /**
     * Relasi ke Jemaat (Pemilik Surat)
     */
    public function jemaat(): BelongsTo
    {
        return $this->belongsTo(Jemaat::class, 'jemaat_id');
    }
}