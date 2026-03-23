<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Anggaran;
use App\Models\Keuangan;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class AnggaranRealisasiChart extends ChartWidget
{
    use HasWidgetShield;
    protected  ?string $heading = 'Perbandingan Anggaran vs Realisasi 2026';

    protected function getData(): array
    {
        // Mengambil data anggaran pendapatan dan belanja
        $anggarans = Anggaran::where('tahun', 2026)->get();

        $labels = [];
        $rencanaData = [];
        $realisasiData = [];

        foreach ($anggarans as $anggaran) {
            // Kita hanya ambil pos-pos utama agar grafik tidak terlalu penuh
            // Atau Anda bisa memfilter berdasarkan kelompok_pos
            $labels[] = $anggaran->nama_pos;

            // Data Rencana dari tabel Anggaran
            $rencanaData[] = (float) $anggaran->target_per_tahun;

            // Data Realisasi dihitung otomatis dari tabel Keuangan berdasarkan kategori
            $realisasiData[] = (float) Keuangan::where('kategori', $anggaran->nama_pos)
                ->whereYear('tanggal', 2026)
                ->sum('nominal');
        }

        return [
            'datasets' => [
                [
                    'label' => 'Rencana (Anggaran)',
                    'data' => $rencanaData,
                    'backgroundColor' => '#94a3b8', // Warna abu-abu untuk rencana
                ],
                [
                    'label' => 'Realisasi (Uang Masuk/Keluar)',
                    'data' => $realisasiData,
                    'backgroundColor' => '#3b82f6', // Warna biru untuk realisasi
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }


    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'ticks' => [
                        'callback' => "function(value) { return 'Rp ' + value.toLocaleString('id-ID'); }",
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
        ];
    }
}
