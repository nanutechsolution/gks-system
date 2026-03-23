<?php

namespace App\Filament\Admin\Resources\PksRumahTanggas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PksRumahTanggaInfolist
{
    /**
     * Konfigurasi Infolist untuk melihat detail Jadwal PKS Rumah Tangga.
     * Menggunakan tata letak sidebar agar konsisten dengan tampilan Form.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // KOLOM UTAMA (KIRI)
                Group::make()->schema([
                    Section::make('Informasi Tuan Rumah')
                        ->icon('heroicon-o-home')
                        ->schema([
                            TextEntry::make('keluarga.nama_keluarga')
                                ->label('Keluarga (Tuan Rumah)')
                                ->weight('bold')
                                ->size('lg')
                                ->color('primary'),

                            TextEntry::make('sektor')
                                ->label('Sektor / Wilayah')
                                ->badge()
                                ->color('info'),

                            TextEntry::make('keluarga.alamat_kk')
                                ->label('Alamat Rumah')
                                ->icon('heroicon-o-map-pin')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Detail Pelayanan')
                        ->icon('heroicon-o-user-group')
                        ->schema([
                            TextEntry::make('pelayan_firman')
                                ->label('Pelayan Firman')
                                ->weight('medium'),

                            TextEntry::make('liturgos')
                                ->label('Liturgos / Pemimpin Pujian')
                                ->placeholder('Belum ditentukan'),

                            TextEntry::make('pemusik')
                                ->label('Pemusik / Pengiring')
                                ->placeholder('Tidak ada pemusik'),

                            TextEntry::make('tema')
                                ->label('Tema / Bahan Alkitab')
                                ->placeholder('Tidak ada tema khusus')
                                ->columnSpanFull(),
                        ])
                ]),
                Group::make()->schema([
                    Section::make('Waktu Pelaksanaan')
                        ->icon('heroicon-o-clock')
                        ->schema([
                            TextEntry::make('tanggal')
                                ->label('Hari / Tanggal')
                                ->date('l, d F Y')
                                ->weight('bold'),

                            TextEntry::make('jam')
                                ->label('Jam Mulai')
                                ->time('H:i')
                                ->suffix(' WITA'),
                        ]),

                    Section::make('Informasi Sistem')
                        ->icon('heroicon-o-cpu-chip')
                        ->schema([
                            TextEntry::make('created_at')
                                ->label('Dicatat Pada')
                                ->dateTime('d/m/Y H:i')
                                ->color('gray'),

                            TextEntry::make('updated_at')
                                ->label('Perubahan Terakhir')
                                ->dateTime('d/m/Y H:i')
                                ->color('gray'),
                        ])->collapsed(),
                ])
            ]);
    }
}
