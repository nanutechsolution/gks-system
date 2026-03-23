<?php

namespace App\Filament\Admin\Resources\Keuangans\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class KeuanganInfolist
{
    /**
     * Konfigurasi Infolist untuk melihat detail Transaksi Keuangan.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Utama')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        TextEntry::make('tanggal')
                            ->label('Tanggal Transaksi')
                            ->date('d F Y')
                            ->icon('heroicon-o-calendar'),
                            
                        TextEntry::make('rekening.nama_kas')
                            ->label('Sumber / Tujuan Kas')
                            ->weight('bold')
                            ->color('primary')
                            ->icon('heroicon-o-credit-card'),
                            
                        TextEntry::make('jenis')
                            ->label('Jenis Transaksi')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Pemasukan' => 'success',
                                'Pengeluaran' => 'danger',
                            }),
                            
                        TextEntry::make('kategori')
                            ->label('Pos Anggaran (Kategori)'),
                            
                        TextEntry::make('nominal')
                            ->label('Nominal Transaksi')
                            ->money('IDR')
                            ->weight('bold')
                            ->size('lg'),
                            
                        TextEntry::make('referensi')
                            ->label('Nomor Referensi/Kwitansi')
                            ->placeholder('Tidak ada referensi')
                            ->copyable(),
                    ])->columns(2),

                Section::make('Keterangan & Bukti Digital')
                    ->icon('heroicon-o-document-magnifying-glass')
                    ->schema([
                        TextEntry::make('keterangan')
                            ->label('Catatan Tambahan')
                            ->placeholder('Tidak ada catatan')
                            ->columnSpanFull(),
                            
                        ImageEntry::make('bukti_transaksi')
                            ->label('Foto Bukti / Struk')
                            ->hidden(fn ($record) => ! $record->bukti_transaksi)
                            ->columnSpanFull()
                            ->extraImgAttributes([
                                'class' => 'rounded-lg border shadow-sm max-w-md',
                            ]),
                    ]),

                Section::make('Data Sistem')
                    ->icon('heroicon-o-cpu-chip')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dicatat Pada')
                            ->dateTime('d M Y, H:i')
                            ->color('gray'),
                        TextEntry::make('updated_at')
                            ->label('Terakhir Diperbarui')
                            ->dateTime('d M Y, H:i')
                            ->color('gray'),
                    ])->columns(2)
                    ->collapsed(),
            ]);
    }
}