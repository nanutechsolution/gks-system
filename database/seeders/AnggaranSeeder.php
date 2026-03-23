<?php

namespace Database\Seeders;

use App\Models\Anggaran;
use Illuminate\Database\Seeder;

class AnggaranSeeder extends Seeder
{
    /**
     * Jalankan seeder database.
     * Mengisi data RAP GKS Jemaat Reda Pada Tahun 2026 dengan Kode Pos (COA).
     */
    public function run(): void
    {
        // ====================================================================
        // A. RENCANA PENDAPATAN
        // ====================================================================
        $pendapatan = [
            ['kode' => '1.1', 'nama' => 'Mingguan', 'target' => 35000000],
            ['kode' => '1.2', 'nama' => 'PKS', 'target' => 25000000],
            ['kode' => '1.3', 'nama' => 'Syukuran', 'target' => 34000000],
            ['kode' => '1.4', 'nama' => 'PMK', 'target' => 8000000],
            ['kode' => '1.5', 'nama' => 'HRK', 'target' => 5000000],
            ['kode' => '1.6', 'nama' => 'HH', 'target' => 5000000],
            ['kode' => '1.7', 'nama' => 'Perpuluhan', 'target' => 14000000],
            ['kode' => '1.8', 'nama' => 'Istimewa', 'target' => 4000000],
            ['kode' => '1.9', 'nama' => 'Urusan Adat', 'target' => 1700000],
            ['kode' => '1.10', 'nama' => 'Akta Gerejawi', 'target' => 5000000],
            ['kode' => '1.11', 'nama' => 'Lelang', 'target' => 10000000],
            ['kode' => '1.12', 'nama' => 'Tanas', 'target' => 1000000],
            ['kode' => '1.13', 'nama' => 'Ternas', 'target' => 3000000],
            ['kode' => '1.14', 'nama' => 'TTA', 'target' => 3000000],
            ['kode' => '1.15', 'nama' => 'Duka', 'target' => 1500000],
            ['kode' => '1.16', 'nama' => 'SSG', 'target' => 3000000],
            ['kode' => '1.17', 'nama' => 'BK/Nazar', 'target' => 500000],
            ['kode' => '1.18', 'nama' => 'SMKA', 'target' => 1000000],
            ['kode' => '1.19', 'nama' => 'Sadar 2000', 'target' => 3000000],
            ['kode' => '1.20', 'nama' => 'Tak Terduga', 'target' => 282000],
        ];

        foreach ($pendapatan as $item) {
            Anggaran::updateOrCreate(
                ['kode_pos' => $item['kode'], 'tahun' => 2026],
                [
                    'jenis' => 'Pendapatan',
                    'nama_pos' => $item['nama'],
                    'target_per_bulan' => $item['target'] / 12,
                    'target_per_tahun' => $item['target'],
                ]
            );
        }

        // ====================================================================
        // B. RENCANA BELANJA (Disalin persis sesuai foto dokumen fisik)
        // ====================================================================
        $belanja = [
            // I. Pemeliharaan Pengerja
            ['kode' => '2.1.1', 'kelompok' => 'Pemeliharaan Pengerja', 'nama' => 'Pdt. Alponia Malo, S.Th', 'bln' => 4860500, 'thn' => 58326000],
            ['kode' => '2.1.2', 'kelompok' => 'Pemeliharaan Pengerja', 'nama' => 'Vic.', 'bln' => 1500000, 'thn' => 18000000],
            ['kode' => '2.1.3', 'kelompok' => 'Pemeliharaan Pengerja', 'nama' => 'KA. Anderias Bili Koba', 'bln' => 1200000, 'thn' => 14400000],
            
            // II. Iuran Dana Pensiun
            ['kode' => '2.2.1', 'kelompok' => 'Iuran Dana Pensiun', 'nama' => 'Pdt. Alponia Malo, S.Th (Pensiun)', 'bln' => 488000, 'thn' => 5856000],
            ['kode' => '2.2.2', 'kelompok' => 'Iuran Dana Pensiun', 'nama' => 'Vic. (Pensiun)', 'bln' => 165000, 'thn' => 1980000],

            // III. Biaya Perumahan
            ['kode' => '2.3.1', 'kelompok' => 'Biaya Perumahan', 'nama' => 'Pdt. Alponia Malo, S.Th (Perumahan)', 'bln' => 250000, 'thn' => 3000000],

            // IV. Insentif Karyawan
            ['kode' => '2.4.1', 'kelompok' => 'Insentif Karyawan', 'nama' => 'Sekretaris Jemaat', 'bln' => 550000, 'thn' => 6600000],
            ['kode' => '2.4.2', 'kelompok' => 'Insentif Karyawan', 'nama' => 'Bendahara Jemaat', 'bln' => 350000, 'thn' => 4200000],
            ['kode' => '2.4.3', 'kelompok' => 'Insentif Karyawan', 'nama' => 'Bendahara Cabang', 'bln' => 200000, 'thn' => 2400000],
            ['kode' => '2.4.4', 'kelompok' => 'Insentif Karyawan', 'nama' => 'Koster Pusat', 'bln' => 250000, 'thn' => 3000000],
            ['kode' => '2.4.5', 'kelompok' => 'Insentif Karyawan', 'nama' => 'Koster Cabang', 'bln' => 200000, 'thn' => 2400000],
            ['kode' => '2.4.6', 'kelompok' => 'Insentif Karyawan', 'nama' => 'Guru Sekolah Minggu Pusat', 'bln' => 225000, 'thn' => 2700000],
            ['kode' => '2.4.7', 'kelompok' => 'Insentif Karyawan', 'nama' => 'Guru Sekolah Minggu Cabang', 'bln' => 100000, 'thn' => 1200000],
            ['kode' => '2.4.8', 'kelompok' => 'Insentif Karyawan', 'nama' => 'Pemusik', 'bln' => 150000, 'thn' => 1800000],

            // V. Belanja Lain-lain
            ['kode' => '2.5.1', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Pos Umum Klasis (PUK)', 'bln' => 0, 'thn' => 1500000],
            ['kode' => '2.5.2', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'ATK', 'bln' => 0, 'thn' => 500000],
            ['kode' => '2.5.3', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'PMK', 'bln' => 0, 'thn' => 500000],
            ['kode' => '2.5.4', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Rapat', 'bln' => 0, 'thn' => 4000000],
            ['kode' => '2.5.5', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'SSG', 'bln' => 0, 'thn' => 200000],
            ['kode' => '2.5.6', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Transportasi', 'bln' => 0, 'thn' => 3000000],
            ['kode' => '2.5.7', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'HRG', 'bln' => 0, 'thn' => 1000000],
            ['kode' => '2.5.8', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Perutusan Klasis', 'bln' => 0, 'thn' => 750000],
            ['kode' => '2.5.9', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Perutusan MK', 'bln' => 0, 'thn' => 300000],
            ['kode' => '2.5.10', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Perutusan BPMK', 'bln' => 0, 'thn' => 300000],
            ['kode' => '2.5.11', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Perutusan BPP', 'bln' => 0, 'thn' => 300000],
            ['kode' => '2.5.12', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'PA Pengerja', 'bln' => 0, 'thn' => 300000],
            ['kode' => '2.5.13', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Mahasiswa Praktek', 'bln' => 0, 'thn' => 1600000],
            ['kode' => '2.5.14', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Perlengkapan Gereja', 'bln' => 0, 'thn' => 3000000],
            ['kode' => '2.5.15', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Diakonia', 'bln' => 0, 'thn' => 5000000],
            ['kode' => '2.5.16', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Tamu Jemaat', 'bln' => 0, 'thn' => 1500000],
            ['kode' => '2.5.17', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Transport Tukar Mimbar Klasis', 'bln' => 0, 'thn' => 350000],
            ['kode' => '2.5.18', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Tranport Tukar Mimbar Sinode', 'bln' => 0, 'thn' => 500000],
            ['kode' => '2.5.19', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Bantuan Ke Komisi Jemaat', 'bln' => 0, 'thn' => 1000000],
            ['kode' => '2.5.20', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Operasional Sinode', 'bln' => 0, 'thn' => 3000000],
            ['kode' => '2.5.21', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Operasional Perwakilan SBD', 'bln' => 0, 'thn' => 1500000],
            ['kode' => '2.5.22', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Pembangunan Kantor Perwakilan', 'bln' => 0, 'thn' => 1200000],
            ['kode' => '2.5.23', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Listrik', 'bln' => 0, 'thn' => 1320000],
            ['kode' => '2.5.24', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Mission Trif', 'bln' => 0, 'thn' => 500000],
            ['kode' => '2.5.25', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Konven', 'bln' => 0, 'thn' => 1000000],
            ['kode' => '2.5.26', 'kelompok' => 'Belanja Lain-Lain', 'nama' => 'Tak Terduga', 'bln' => 0, 'thn' => 3000000],
        ];

        foreach ($belanja as $item) {
            Anggaran::updateOrCreate(
                ['kode_pos' => $item['kode'], 'tahun' => 2026],
                [
                    'jenis' => 'Belanja',
                    'kelompok_pos' => $item['kelompok'],
                    'nama_pos' => $item['nama'],
                    'target_per_bulan' => $item['bln'],
                    'target_per_tahun' => $item['thn'],
                ]
            );
        }
    }
}