<?php

namespace App\Filament\Admin\Resources\Jemaats\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Infolists\Components\IconEntry;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class JemaatInfolist
{
    /**
     * Konfigurasi Infolist untuk detail data Jemaat.
     * Menggunakan standar modular Filament 5.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pribadi')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextEntry::make('nomor_induk')
                            ->label('Nomor Induk Anggota')
                            ->placeholder('Belum diatur')
                            ->copyable(),
                        TextEntry::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->weight('bold')
                            ->size('lg'),
                        TextEntry::make('jenis_kelamin')
                            ->label('Jenis Kelamin'),
                        TextEntry::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->placeholder('-'),
                        TextEntry::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->date('d F Y')
                            ->placeholder('-'),
                    ])->columns(2),

                Section::make('Kontak & Wilayah')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        TextEntry::make('alamat')
                            ->label('Alamat Lengkap')
                            ->placeholder('Alamat belum diisi')
                            ->columnSpanFull(),
                        TextEntry::make('sektor')
                            ->label('Sektor / Wilayah Pelayanan')
                            ->placeholder('Belum ditentukan'),
                        TextEntry::make('status_anggota')
                            ->label('Status Keanggotaan')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Aktif' => 'success',
                                'Pindah' => 'warning',
                                'Meninggal' => 'danger',
                                default => 'gray',
                            }),
                    ])->columns(2),

                Section::make('Status Sakramen')
                    ->icon('heroicon-o-sparkles')
                    ->schema([
                        // Detail Baptis
                        Grid::make(3)
                            ->schema([
                                IconEntry::make('status_baptis')
                                    ->label('Status Baptis')
                                    ->boolean(),
                                TextEntry::make('tanggal_baptis')
                                    ->label('Tanggal Baptis')
                                    ->date('d F Y')
                                    ->placeholder('-')
                                    ->visible(fn ($record) => $record->status_baptis),
                                TextEntry::make('tempat_baptis')
                                    ->label('Tempat Baptis')
                                    ->placeholder('-')
                                    ->visible(fn ($record) => $record->status_baptis),
                                TextEntry::make('pendeta_baptis')
                                    ->label('Pendeta Baptis')
                                    ->placeholder('-')
                                    ->columnSpanFull()
                                    ->visible(fn ($record) => $record->status_baptis),
                            ]),

                        // Detail Sidi
                        Grid::make(3)
                            ->schema([
                                IconEntry::make('status_sidi')
                                    ->label('Status Sidi')
                                    ->boolean(),
                                TextEntry::make('tanggal_sidi')
                                    ->label('Tanggal Sidi')
                                    ->date('d F Y')
                                    ->placeholder('-')
                                    ->visible(fn ($record) => $record->status_sidi),
                                TextEntry::make('tempat_sidi')
                                    ->label('Tempat Sidi')
                                    ->placeholder('-')
                                    ->visible(fn ($record) => $record->status_sidi),
                                TextEntry::make('pendeta_sidi')
                                    ->label('Pendeta Sidi')
                                    ->placeholder('-')
                                    ->columnSpanFull()
                                    ->visible(fn ($record) => $record->status_sidi),
                            ])->extraAttributes(['class' => 'mt-4 pt-4 border-t']),
                    ]),

                Section::make('Data Sistem')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Waktu Pendaftaran')
                            ->dateTime()
                            ->color('gray'),
                        TextEntry::make('updated_at')
                            ->label('Pembaruan Terakhir')
                            ->dateTime()
                            ->color('gray'),
                    ])->columns(2)
                    ->collapsed(),
            ]);
    }
}