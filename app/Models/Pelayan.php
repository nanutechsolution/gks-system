<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pelayan extends Model
{
       use SoftDeletes;
    
    protected $fillable = [
        'jemaat_id', 'nama_lengkap', 'jabatan', 'telepon', 
        'nomor_sk', 'mulai_bertugas', 'akhir_bertugas',
        'insentif_per_layanan', 'is_aktif', 'metadata'
    ];
    
    protected $casts = [
        'mulai_bertugas' => 'date',
        'akhir_bertugas' => 'date',
        'is_aktif' => 'boolean',
        'metadata' => 'array', // Mengubah JSON menjadi Array PHP otomatis
    ];
    
    // Relasi ke Data Induk Jemaat
    public function jemaat() {
        return $this->belongsTo(Jemaat::class);
    }
    
    public function jadwal_ibadah() {
        return $this->hasMany(JadwalIbadah::class);
    }

    public function jadwal_pks() {
        return $this->hasMany(PksRumahTangga::class);
    }
}
