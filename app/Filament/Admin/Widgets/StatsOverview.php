<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Jemaat;
use App\Models\Keuangan;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    use HasWidgetShield;
    protected function getStats(): array
    {
        // Hitung total jemaat aktif
        $totalJemaat = Jemaat::where('status_anggota', 'Aktif')->count();

        // Hitung total uang
        $pemasukan = Keuangan::where('jenis', 'Pemasukan')->sum('nominal');
        $pengeluaran = Keuangan::where('jenis', 'Pengeluaran')->sum('nominal');
        $saldo = $pemasukan - $pengeluaran;

        return [
            Stat::make('Total Jemaat Aktif', $totalJemaat . ' Jiwa')
                ->description('Anggota jemaat terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Total Pemasukan', 'Rp ' . number_format($pemasukan, 0, ',', '.'))
                ->description('Seluruh kas masuk')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

            Stat::make('Saldo Kas Saat Ini', 'Rp ' . number_format($saldo, 0, ',', '.'))
                ->description('Sisa uang di kas gereja')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color($saldo >= 0 ? 'success' : 'danger'),
        ];
    }
}
