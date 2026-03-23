<?php

namespace Database\Seeders;

use App\Models\Rekening;
use Illuminate\Database\Seeder;

class RekeningSeeder extends Seeder
{
    /**
     * Jalankan seeder database untuk data Rekening Kas.
     */
    public function run(): void
    {
        $rekening = [
            [
                'nama_kas' => 'Kas Tunai (Brankas)',
                'nomor_rekening' => null,
                'atas_nama' => 'Bendahara GKS Reda Pada',
                'saldo_awal' => 2500000, // Misal saldo awal Rp 2.500.000
            ],
            [
                'nama_kas' => 'Bank BRI',
                'nomor_rekening' => '4682-01-000000-53-1',
                'atas_nama' => 'GKS Jemaat Reda Pada',
                'saldo_awal' => 15000000, // Misal saldo awal Rp 15.000.000
            ],
            [
                'nama_kas' => 'Bank NTT',
                'nomor_rekening' => '110-02-0000000-1',
                'atas_nama' => 'GKS Jemaat Reda Pada',
                'saldo_awal' => 5000000, // Misal saldo awal Rp 5.000.000
            ],
        ];

        foreach ($rekening as $kas) {
            Rekening::firstOrCreate(
                ['nama_kas' => $kas['nama_kas']], // Mencegah duplikasi nama kas
                [
                    'nomor_rekening' => $kas['nomor_rekening'],
                    'atas_nama' => $kas['atas_nama'],
                    'saldo_awal' => $kas['saldo_awal'],
                ]
            );
        }
    }
}