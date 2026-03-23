<?php

namespace App\Filament\Admin\Resources\Keluargas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class KeluargaInfolist
{
    /**
     * Konfigurasi Infolist untuk detail data Keluarga.
     * Menggunakan standar modular Filament 5.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Data Utama Keluarga')
                    ->icon('heroicon-o-home-modern')
                    ->schema([
                        TextEntry::make('nomor_kk')
                            ->label('Nomor Kartu Keluarga (KK)')
                            ->weight('bold')
                            ->placeholder('-')
                            ->copyable(),
                        TextEntry::make('nama_keluarga')
                            ->label('Nama Keluarga')
                            ->size('lg')
                            ->weight('bold')
                            ->color('primary'),
                        TextEntry::make('sektor')
                            ->label('Sektor / Wilayah')
                            ->badge()
                            ->color('info')
                            ->placeholder('-'),
                    ])->columns(2),

                Section::make('Domisili & Lokasi')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        TextEntry::make('alamat_kk')
                            ->label('Alamat Lengkap Rumah')
                            ->placeholder('Alamat belum diisi')
                            ->columnSpanFull(),
                    ]),

                Section::make('Informasi Sistem')
                    ->icon('heroicon-o-cpu-chip')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Data Dibuat Pada')
                            ->dateTime('d F Y, H:i')
                            ->color('gray'),
                        TextEntry::make('updated_at')
                            ->label('Terakhir Diperbarui')
                            ->dateTime('d F Y, H:i')
                            ->color('gray'),
                    ])->columns(2)
                    ->collapsed(),
            ]);
    }
}