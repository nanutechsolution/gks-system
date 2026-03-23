<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggaran extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     * * @var string
     */
    protected $table = 'anggarans';

    /**
     * Kolom yang boleh diisi secara massal (Mass Assignment).
     * Sesuai dengan dokumen Rencana Pendapatan & Belanja 2026.
     * * @var array
     */
    protected $fillable = [
        'tahun',
        'jenis',           // Pendapatan atau Belanja
        'kode_pos',
        'kelompok_pos',    // Header (misal: Insentif Karyawan)
        'nama_pos',        // Uraian (misal: Sekretaris Jemaat)
        'target_per_bulan',
        'target_per_tahun',
    ];

    /**
     * Konversi tipe data otomatis.
     * * @var array
     */
    protected $casts = [
        'tahun' => 'integer',
        'target_per_bulan' => 'decimal:2',
        'target_per_tahun' => 'decimal:2',
    ];

    /**
     * Relasi ke data Keuangan (Transaksi Kas).
     * Mencocokkan berdasarkan kategori yang sama dengan nama_pos.
     */

    public function transaksi_kas(): HasMany
    {
        return $this->hasMany(Keuangan::class, 'kategori', 'nama_pos');
    }
    /**
     * Helper untuk menghitung total realisasi saat ini.
     * Berguna untuk pengecekan budget secara cepat di aplikasi.
     */
    public function getRealisasiAttribute()
    {
        return Keuangan::where('kategori', $this->nama_pos)
            ->whereYear('tanggal', $this->tahun)
            ->sum('nominal');
    }

    /**
     * Helper untuk menghitung sisa anggaran (Kurang/Lebih).
     */
    public function getSelisihAttribute()
    {
        return $this->target_per_tahun - $this->realisasi;
    }
}
