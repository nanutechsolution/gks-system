<?php

namespace App\Filament\Admin\Resources\JadwalIbadahs\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class JadwalIbadahInfolist
{
    /**
     * Konfigurasi Infolist untuk detail Jadwal Ibadah.
     * Menggunakan standar modular Filament 5.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pelaksanaan')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        TextEntry::make('nama_ibadah')
                            ->label('Nama Ibadah')
                            ->weight('bold')
                            ->size('lg')
                            ->color('primary')
                            ->columnSpanFull(),

                        TextEntry::make('waktu_mulai')
                            ->label('Waktu Pelaksanaan')
                            ->dateTime('l, d F Y - H:i')
                            ->icon('heroicon-o-clock')
                            ->weight('medium'),
                        TextEntry::make('pengkhotbah')
                            ->label('Pengkhotbah / Pelayan')
                            ->icon('heroicon-o-user')
                            ->placeholder('Belum ditentukan'),

                        TextEntry::make('lokasi')
                            ->label('Lokasi Ibadah')
                            ->icon('heroicon-o-map-pin')
                            ->default('Gedung Gereja Utama'),
                    ])->columns(2),

                Section::make('Keterangan Tambahan')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        TextEntry::make('keterangan')
                            ->label('Catatan Ibadah')
                            ->placeholder('Tidak ada keterangan tambahan')
                            ->columnSpanFull(),
                    ]),

                Section::make('Informasi Sistem')
                    ->icon('heroicon-o-cpu-chip')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Data Dibuat')
                            ->dateTime()
                            ->color('gray'),
                        TextEntry::make('updated_at')
                            ->label('Terakhir Diperbarui')
                            ->dateTime()
                            ->color('gray'),
                    ])->columns(2)
                    ->collapsed(),
            ]);
    }
}