<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jemaat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_induk',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'sektor',
        'status_anggota',
        'status_baptis',
        'status_sidi',
        'keluarga_id',
        'hubungan_keluarga',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'status_baptis' => 'boolean',
        'status_sidi' => 'boolean',
    ];


    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }
}
