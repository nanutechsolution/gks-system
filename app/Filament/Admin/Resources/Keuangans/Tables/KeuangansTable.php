<?php

namespace App\Filament\Admin\Resources\Keuangans\Tables;

use App\Filament\Exports\KeuanganExporter;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Support\Enums\Alignment;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class KeuangansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                TextColumn::make('rekening.nama_kas')
                    ->label('Kas / Rekening')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Pemasukan' => 'success',
                        'Pengeluaran' => 'danger',
                    }),

                TextColumn::make('kategori')
                    ->label('Kategori (RAP)')
                    ->searchable(),

                TextColumn::make('nominal')
                    ->label('Nominal')
                    ->money('IDR')
                    ->sortable()
                    ->alignment(Alignment::End)
                    ->summarize([
                        Sum::make()
                            ->label('Total Pemasukan')
                            ->money('IDR')
                            ->query(fn($query) => $query->where('jenis', 'Pemasukan')),
                        Sum::make()
                            ->label('Total Pengeluaran')
                            ->money('IDR')
                            ->query(fn($query) => $query->where('jenis', 'Pengeluaran')),
                    ]),

                TextColumn::make('referensi')
                    ->label('No. Ref')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                ImageColumn::make('bukti_transaksi')
                    ->label('Bukti')
                    ->square()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(30)
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('jenis')
                    ->options([
                        'Pemasukan' => 'Pemasukan',
                        'Pengeluaran' => 'Pengeluaran',
                    ]),
                SelectFilter::make('rekening_id')
                    ->relationship('rekening', 'nama_kas')
                    ->label('Filter Kas/Rekening'),
                Filter::make('periode_tanggal')
                    ->form([
                        DatePicker::make('dari_tanggal')->label('Dari Tanggal')->native(false),
                        DatePicker::make('sampai_tanggal')->label('Sampai Tanggal')->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tanggal', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tanggal', '<=', $date),
                            );
                    })
                    ->label('Filter Periode (Cut-off)'),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(KeuanganExporter::class)
                    ->label('Export Excel')
                    ->color('success')
                    ->icon(Heroicon::OutlinedArrowDownTray),
            ])
            ->recordActions([
               ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    Action::make('cetak_bukti')
                        ->label('Cetak BKM/BKK')
                        ->icon('heroicon-o-printer')
                        ->color('warning')
                        ->url(fn ($record) => route('cetak.bukti-kas', $record))
                        ->openUrlInNewTab(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ExportBulkAction::make()
                        ->exporter(KeuanganExporter::class)
                        ->label('Export Buku Kas (Excel)')
                        ->icon('heroicon-o-document-arrow-down'),
                ]),
            ])->defaultSort('tanggal', 'desc');
    }
}
