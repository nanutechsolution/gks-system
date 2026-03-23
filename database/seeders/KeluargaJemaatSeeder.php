<?php

namespace Database\Seeders;

use App\Models\Keluarga;
use App\Models\Jemaat;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class KeluargaJemaatSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Data Keluarga Pdt. Alponia Malo
        $keluarga1 = Keluarga::create([
            'nomor_kk' => '5317010101010001',
            'nama_keluarga' => 'Keluarga Malo',
            'alamat_kk' => 'Pastori GKS Reda Pada, Waingapu',
            'sektor' => 'Sektor I',
        ]);

        Jemaat::create([
            'keluarga_id' => $keluarga1->id,
            'hubungan_keluarga' => 'Kepala Keluarga',
            'nomor_induk' => 'GKS-RP-001',
            'nama_lengkap' => 'Pdt. Alponia Malo, S.Th',
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => 'Waingapu',
            'tanggal_lahir' => '1985-05-12',
            'alamat' => 'Pastori GKS Reda Pada',
            'sektor' => 'Sektor I',
            'status_anggota' => 'Aktif',
            'status_baptis' => true,
            'tanggal_baptis' => '1985-08-20',
            'pendeta_baptis' => 'Pdt. S. Namah, S.Th',
            'status_sidi' => true,
            'tanggal_sidi' => '2002-04-14',
            'pendeta_sidi' => 'Pdt. R. Kalla, M.Th',
        ]);

        // 2. Data Keluarga Pnt. Benyamin T. Dona
        $keluarga2 = Keluarga::create([
            'nomor_kk' => '5317010101010002',
            'nama_keluarga' => 'Keluarga Dona',
            'alamat_kk' => 'Jl. Merdeka No. 10, Reda Pada',
            'sektor' => 'Sektor II',
        ]);

        Jemaat::create([
            'keluarga_id' => $keluarga2->id,
            'hubungan_keluarga' => 'Kepala Keluarga',
            'nomor_induk' => 'GKS-RP-002',
            'nama_lengkap' => 'Pnt. Benyamin T. Dona',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Lolo Ole',
            'tanggal_lahir' => '1978-11-25',
            'alamat' => 'Jl. Merdeka No. 10',
            'sektor' => 'Sektor II',
            'status_anggota' => 'Aktif',
            'status_baptis' => true,
            'tanggal_baptis' => '1979-01-10',
            'pendeta_baptis' => 'Pdt. J. Lado',
            'status_sidi' => true,
            'tanggal_sidi' => '1995-06-12',
            'pendeta_sidi' => 'Pdt. A. Malo',
        ]);

        Jemaat::create([
            'keluarga_id' => $keluarga2->id,
            'hubungan_keluarga' => 'Istri',
            'nomor_induk' => 'GKS-RP-003',
            'nama_lengkap' => 'Maria Dona',
            'jenis_kelamin' => 'Perempuan',
            'tempat_lahir' => 'Waingapu',
            'tanggal_lahir' => '1982-03-15',
            'alamat' => 'Jl. Merdeka No. 10',
            'sektor' => 'Sektor II',
            'status_anggota' => 'Aktif',
            'status_baptis' => true,
            'status_sidi' => true,
        ]);

        // 3. Data Keluarga Jemaat Contoh (Anak yang baru dibaptis untuk testing)
        $keluarga3 = Keluarga::create([
            'nomor_kk' => '5317010101010003',
            'nama_keluarga' => 'Keluarga Umbu Domu',
            'alamat_kk' => 'Kampung Baru, Reda Pada',
            'sektor' => 'Sektor III',
        ]);

        Jemaat::create([
            'keluarga_id' => $keluarga3->id,
            'hubungan_keluarga' => 'Anak',
            'nomor_induk' => 'GKS-RP-004',
            'nama_lengkap' => 'Anak Kecil Umbu',
            'jenis_kelamin' => 'Laki-laki',
            'tempat_lahir' => 'Reda Pada',
            'tanggal_lahir' => '2024-01-01',
            'alamat' => 'Kampung Baru',
            'sektor' => 'Sektor III',
            'status_anggota' => 'Aktif',
            'status_baptis' => true,
            'tanggal_baptis' => '2026-02-15',
            'pendeta_baptis' => 'Pdt. Alponia Malo, S.Th',
            'status_sidi' => false,
        ]);
    }
}