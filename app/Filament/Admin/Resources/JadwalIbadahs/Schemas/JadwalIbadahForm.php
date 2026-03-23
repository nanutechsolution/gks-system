<?php

namespace App\Filament\Admin\Resources\JadwalIbadahs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Schema;

class JadwalIbadahForm
{
    /**
     * Konfigurasi Form Jadwal Ibadah.
     * Didesain dengan tata letak Sidebar untuk memisahkan informasi utama dan logistik.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Informasi Ibadah')
                        ->description('Tentukan nama dan rincian kegiatan ibadah.')
                        ->icon('heroicon-o-calendar-days')
                        ->schema([
                            TextInput::make('nama_ibadah')
                                ->label('Nama Ibadah / Kegiatan')
                                ->placeholder('Contoh: Ibadah Raya I, Ibadah Pemuda, atau Perayaan Natal')
                                ->required()
                                ->maxLength(255)
                                ->columnSpanFull(),

                            Textarea::make('keterangan')
                                ->label('Keterangan / Tema Khotbah')
                                ->placeholder('Tuliskan tema khotbah, nas pembimbing, atau catatan khusus lainnya di sini...')
                                ->rows(5)
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpan(['lg' => 2]),

                Group::make()->schema([
                    Section::make('Waktu & Pelaksana')
                        ->description('Atur kapan dan di mana ibadah dilaksanakan.')
                        ->icon('heroicon-o-clock')
                        ->schema([
                            DateTimePicker::make('waktu_mulai')
                                ->label('Waktu Pelaksanaan')
                                ->required()
                                ->native(false)
                                ->displayFormat('d M Y, H:i')
                                ->closeOnDateSelection()
                                ->helperText('Pastikan jam pelaksanaan sudah tepat.'),

                            TextInput::make('pengkhotbah')
                                ->label('Pelayan Firman / Pengkhotbah')
                                ->placeholder('Nama Pendeta / Penatua')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('lokasi')
                                ->label('Lokasi Kegiatan')
                                ->default('Gedung Gereja Utama')
                                ->placeholder('Misal: Gedung Gereja Utama atau Nama Cabang')
                                ->required()
                                ->maxLength(255),
                        ]),
                        
                    Section::make('Status Publikasi')
                        ->schema([
                            ToggleButtons::make('status_kategori')
                                ->label('Kategori Ibadah')
                                ->options([
                                    'rutin' => 'Mingguan',
                                    'khusus' => 'Hari Raya',
                                ])
                                ->icons([
                                    'rutin' => 'heroicon-o-arrow-path',
                                    'khusus' => 'heroicon-o-star',
                                ])
                                ->default('rutin')
                                ->inline(),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}