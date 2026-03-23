<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaturan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_gereja',
        'nama_jemaat',
        'alamat_lengkap',
        'kota_surat',
        'nama_ketua_majelis',
        'nama_sekretaris',
        'logo_gereja',
    ];
}
