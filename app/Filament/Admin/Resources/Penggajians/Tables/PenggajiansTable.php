<?php

namespace App\Filament\Admin\Resources\Penggajians\Tables;

use Filament\Actions\ActionGroup as ActionsActionGroup;
use Filament\Actions\BulkActionGroup as ActionsBulkActionGroup;
use Filament\Actions\DeleteAction as ActionsDeleteAction;
use Filament\Actions\DeleteBulkAction as ActionsDeleteBulkAction;
use Filament\Actions\EditAction as ActionsEditAction;
use Filament\Actions\ForceDeleteAction as ActionsForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction as ActionsForceDeleteBulkAction;
use Filament\Actions\RestoreAction as ActionsRestoreAction;
use Filament\Actions\RestoreBulkAction as ActionsRestoreBulkAction;
use Filament\Actions\ViewAction as ActionsViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PenggajiansTable
{
    /**
     * Konfigurasi Tabel Riwayat Penggajian / Insentif Pelayan.
     * Menggunakan standar UI/UX modern Filament 5.
     */
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pelayan.nama_lengkap')
                    ->label('Nama Pelayan')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    // Menampilkan jabatan pelayan di bawah namanya
                    ->description(fn($record) => $record->pelayan->jabatan ?? '-'),

                TextColumn::make('periode_bulan')
                    ->label('Periode')
                    ->searchable()
                    ->badge()
                    ->color('info'),

                TextColumn::make('tanggal_bayar')
                    ->label('Tanggal Bayar')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('total_kehadiran')
                    ->label('Total Tugas')
                    ->numeric()
                    ->sortable()
                    ->suffix(' Kali')
                    ->alignCenter()
                    ->badge()
                    ->color('gray'),

                TextColumn::make('total_insentif')
                    ->label('Total Dibayarkan')
                    ->money('IDR')
                    ->sortable()
                    ->weight('bold')
                    ->color('success'),

                TextColumn::make('catatan')
                    ->label('Keterangan')
                    ->limit(30)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('deleted_at')
                    ->label('Dihapus Pada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('periode_bulan')
                    ->label('Filter Periode')
                    ->options(function () {
                        return \App\Models\Penggajian::query()
                            ->pluck('periode_bulan', 'periode_bulan')
                            ->toArray();
                    }),
                TrashedFilter::make()
                    ->label('Data Terhapus'),
            ])
            ->recordActions([
                ActionsActionGroup::make([
                    ActionsViewAction::make(),
                    ActionsEditAction::make(),
                    ActionsDeleteAction::make(),
                    ActionsForceDeleteAction::make(),
                    ActionsRestoreAction::make(),
                ])
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->tooltip('Opsi'),
            ])
            ->toolbarActions([
                ActionsBulkActionGroup::make([
                    ActionsDeleteBulkAction::make(),
                    ActionsForceDeleteBulkAction::make(),
                    ActionsRestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('tanggal_bayar', 'desc')
            ->emptyStateHeading('Belum ada riwayat penggajian')
            ->emptyStateDescription('Buat data pembayaran insentif pelayan untuk melihat rekam jejaknya di sini.');
    }
}
