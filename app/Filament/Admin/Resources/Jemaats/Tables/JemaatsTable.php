<?php

namespace App\Filament\Admin\Resources\Jemaats\Tables;

use App\Filament\Exports\JemaatExporter;
use Filament\Actions\Action as ActionsAction;
use Filament\Actions\ActionGroup as ActionsActionGroup;
use Filament\Actions\BulkActionGroup as ActionsBulkActionGroup;
use Filament\Actions\DeleteBulkAction as ActionsDeleteBulkAction;
use Filament\Actions\EditAction as ActionsEditAction;
use Filament\Actions\ExportAction as ActionsExportAction;
use Filament\Actions\ExportBulkAction as ActionsExportBulkAction;
use Filament\Actions\ViewAction as ActionsViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class JemaatsTable
{
    /**
     * Konfigurasi Tabel Jemaat.
     * Menggunakan standar modular Filament 5.
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_induk')
                    ->label('No. Induk')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('jenis_kelamin')
                    ->label('L/P')
                    ->formatStateUsing(fn(string $state): string => $state === 'Laki-laki' ? 'L' : 'P')
                    ->tooltip(fn($state) => $state),

                TextColumn::make('sektor')
                    ->label('Sektor')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('status_anggota')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Aktif' => 'success',
                        'Pindah' => 'warning',
                        'Meninggal' => 'danger',
                        default => 'gray',
                    }),
                IconColumn::make('status_baptis')
                    ->label('Baptis')
                    ->boolean()
                    ->alignCenter(),

                IconColumn::make('status_sidi')
                    ->label('Sidi')
                    ->boolean()
                    ->alignCenter(),
            ])
            ->filters([
                SelectFilter::make('sektor')
                    ->label('Filter Sektor')
                    ->placeholder('Semua Sektor'),

                SelectFilter::make('status_anggota')
                    ->label('Filter Status')
                    ->options([
                        'Aktif' => 'Aktif',
                        'Pindah' => 'Pindah',
                        'Meninggal' => 'Meninggal',
                    ]),

                TernaryFilter::make('status_baptis')
                    ->label('Status Baptis'),

                TernaryFilter::make('status_sidi')
                    ->label('Status Sidi'),
            ])
            ->recordActions([
                ActionsActionGroup::make([
                    ActionsViewAction::make()->color('success'),
                    ActionsEditAction::make()->color('warning'),
                    ActionsAction::make('cetak_baptis')
                        ->label('Cetak Surat Baptis')
                        ->icon('heroicon-o-document-text')
                        ->color('info')
                        ->url(fn($record) => route('cetak.baptis', $record))
                        ->openUrlInNewTab()
                        ->visible(fn($record) => $record->status_baptis),
                ]),
            ])
            ->toolbarActions([
                ActionsBulkActionGroup::make([
                    ActionsDeleteBulkAction::make(),
                    ActionsExportBulkAction::make()
                        ->exporter(JemaatExporter::class)
                        ->label('Export Data Terpilih'),
                ]),
            ])
            ->defaultSort('nama_lengkap', 'asc')
            ->emptyStateHeading('Tidak ada data jemaat')
            ->emptyStateDescription('Silakan tambahkan jemaat baru untuk memulai.');
    }
}
