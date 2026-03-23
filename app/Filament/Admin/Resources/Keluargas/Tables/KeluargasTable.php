<?php

namespace App\Filament\Admin\Resources\Keluargas\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class KeluargasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_kk')
                    ->label('No. Kartu Keluarga')
                    ->searchable()
                    ->sortable()
                    ->copyable() // Memudahkan admin copy-paste No KK
                    ->fontFamily('mono') // Font monospaced agar angka sejajar
                    ->description(fn($record) => $record->alamat_kk),

                TextColumn::make('nama_keluarga')
                    ->label('Nama Keluarga')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->size('lg')
                    ->color('primary'),

                // FITUR UX: Menampilkan jumlah anggota keluarga langsung di tabel
                TextColumn::make('anggota_count')
                    ->label('Anggota')
                    ->counts('anggota')
                    ->badge()
                    ->color('gray')
                    ->suffix(' Jiwa')
                    ->alignCenter(),

                TextColumn::make('sektor')
                    ->label('Sektor')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info')
                    ->placeholder('Belum diatur'),

                TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('sektor')
                    ->label('Filter Sektor')
                    ->placeholder('Semua Sektor'),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->label('Lihat Detail Anggota'),
                    EditAction::make(),
                ])
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->tooltip('Opsi'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])->defaultSort('created_at', 'desc')
            ->emptyStateHeading('Belum ada data keluarga')
            ->emptyStateDescription('Mulai dengan menambahkan data keluarga baru atau hubungkan jemaat yang ada.')
            ->emptyStateIcon('heroicon-o-home-modern');
    }
}
