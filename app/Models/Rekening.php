<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{

    protected $fillable = ['nama_kas', 'nomor_rekening', 'atas_nama', 'saldo_awal'];

    // Hitung saldo real-time per rekening
    public function getSaldoAkhirAttribute()
    {
        $pemasukan = \App\Models\Keuangan::where('rekening_id', $this->id)->where('jenis', 'Pemasukan')->sum('nominal');
        $pengeluaran = \App\Models\Keuangan::where('rekening_id', $this->id)->where('jenis', 'Pengeluaran')->sum('nominal');
        return $this->saldo_awal + $pemasukan - $pengeluaran;
    }
}
