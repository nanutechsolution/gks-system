<?php

namespace App\Filament\Admin\Resources\SuratKeterangans\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SuratKeterangansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_surat')
                    ->label('No. Surat')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->fontFamily('mono')
                    ->weight('bold'),

                TextColumn::make('jemaat.nama_lengkap')
                    ->label('Nama Jemaat')
                    ->searchable()
                    ->sortable()
                    ->description(fn($record) => "Tujuan: {$record->tujuan_surat}"),

                TextColumn::make('jenis_surat')
                    ->label('Jenis Dokumen')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pindah' => 'danger',
                        'Anggota Aktif' => 'success',
                        'Rekomendasi Nikah' => 'info',
                        default => 'gray',
                    }),

                TextColumn::make('tanggal_surat')
                    ->label('Tanggal Surat')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('jenis_surat')
                    ->label('Filter Jenis Surat')
                    ->options([
                        'Pindah' => 'Surat Pindah',
                        'Anggota Aktif' => 'Surat Anggota',
                        'Rekomendasi Nikah' => 'Rekomendasi Nikah',
                    ]),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    Action::make('cetak_surat')
                        ->label('Cetak Surat')
                        ->icon('heroicon-o-printer')
                        ->color('success')
                        ->url(fn($record) => route('cetak.surat-keterangan', $record))
                        ->openUrlInNewTab(),
                ])
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->tooltip('Opsi'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->defaultSort('tanggal_surat', 'desc')
            ->emptyStateHeading('Belum ada riwayat surat')
            ->emptyStateDescription('Semua surat keterangan yang dibuat akan tercatat di sini.');
    }
}
