<?php

namespace App\Filament\Exports;

use App\Models\Jemaat;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class JemaatExporter extends Exporter
{
    protected static ?string $model = Jemaat::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('nomor_induk')
                ->label('No. Induk'),
            ExportColumn::make('nama_lengkap')
                ->label('Nama Lengkap'),
            ExportColumn::make('jenis_kelamin')
                ->label('L/P'),
            ExportColumn::make('tempat_lahir')
                ->label('Tempat Lahir'),
            ExportColumn::make('tanggal_lahir')
                ->label('Tanggal Lahir'),
            ExportColumn::make('sektor')
                ->label('Sektor/Wilayah'),
            ExportColumn::make('status_anggota')
                ->label('Status'),
            ExportColumn::make('status_baptis')
                ->label('Baptis? (1=Ya, 0=Tidak)'),
            ExportColumn::make('status_sidi')
                ->label('Sidi? (1=Ya, 0=Tidak)'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Proses export data jemaat telah selesai dan siap diunduh. ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';
        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
