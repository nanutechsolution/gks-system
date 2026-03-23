<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Keuangan;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class KeuanganChart extends ChartWidget
{
    use HasWidgetShield;
    protected  ?string $heading = 'Grafik Keuangan Tahun Ini';
    protected static ?int $sort = 2;
    protected function getData(): array
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];

        // Siapkan array kosong untuk 12 bulan
        $pemasukanData = array_fill(0, 12, 0);
        $pengeluaranData = array_fill(0, 12, 0);

        // Ambil data Pemasukan per bulan di tahun ini
        $pemasukan = Keuangan::where('jenis', 'Pemasukan')
            ->whereYear('tanggal', now()->year)
            ->selectRaw('MONTH(tanggal) as month, SUM(nominal) as total')
            ->groupBy('month')
            ->get();

        foreach ($pemasukan as $item) {
            $pemasukanData[$item->month - 1] = $item->total;
        }

        // Ambil data Pengeluaran per bulan di tahun ini
        $pengeluaran = Keuangan::where('jenis', 'Pengeluaran')
            ->whereYear('tanggal', now()->year)
            ->selectRaw('MONTH(tanggal) as month, SUM(nominal) as total')
            ->groupBy('month')
            ->get();

        foreach ($pengeluaran as $item) {
            $pengeluaranData[$item->month - 1] = $item->total;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $pemasukanData,
                    'borderColor' => '#10b981', // Warna hijau
                    'backgroundColor' => 'rgba(16, 185, 129, 0.2)', // Hijau transparan
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $pengeluaranData,
                    'borderColor' => '#ef4444', // Warna merah
                    'backgroundColor' => 'rgba(239, 68, 68, 0.2)', // Merah transparan
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
