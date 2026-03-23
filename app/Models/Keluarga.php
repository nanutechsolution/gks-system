<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keluarga extends Model
{
    protected $fillable = ['nomor_kk', 'nama_keluarga', 'alamat_kk', 'sektor'];

    public function anggota()
    {
        return $this->hasMany(Jemaat::class);
    }
}
