<?php

namespace App\Filament\Widgets;

use App\Models\Anggaran;
use App\Models\Keuangan;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class BudgetWarning extends BaseWidget
{
    use HasWidgetShield;
    /**
     * Menempatkan widget ini di paling atas (Sort 0) agar langsung terlihat 
     * jika ada anggaran yang kritis.
     */
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $stats = [];
        
        // Ambil semua anggaran belanja tahun 2026
        $anggarans = Anggaran::where('tahun', 2026)
            ->where('jenis', 'Belanja')
            ->get();

        foreach ($anggarans as $anggaran) {
            $realisasi = (float) Keuangan::where('kategori', $anggaran->nama_pos)
                ->whereYear('tanggal', 2026)
                ->sum('nominal');

            $target = (float) $anggaran->target_per_tahun;

            if ($target > 0) {
                $persentase = ($realisasi / $target) * 100;

                // Jika sudah mencapai 90% atau lebih, tampilkan peringatan
                if ($persentase >= 90) {
                    $stats[] = Stat::make(
                        label: 'KRITIS: ' . $anggaran->nama_pos,
                        value: 'Rp ' . number_format($realisasi, 0, ',', '.')
                    )
                        ->description('Sudah terpakai ' . number_format($persentase, 1) . '% dari Rp ' . number_format($target, 0, ',', '.'))
                        ->descriptionIcon('heroicon-m-exclamation-triangle')
                        ->color($persentase >= 100 ? 'danger' : 'warning')
                        ->chart([$realisasi * 0.5, $realisasi * 0.8, $realisasi]); // Mini chart untuk visualisasi kenaikan
                }
            }
        }

        // Jika tidak ada anggaran yang kritis, tampilkan status aman
        if (empty($stats)) {
            return [
                Stat::make('Status Anggaran Belanja', 'Semua Aman')
                    ->description('Belum ada pos belanja yang melebihi 90% limit.')
                    ->descriptionIcon('heroicon-m-check-badge')
                    ->color('success'),
            ];
        }

        return $stats;
    }
}