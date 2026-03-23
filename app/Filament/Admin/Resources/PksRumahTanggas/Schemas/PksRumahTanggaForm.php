<?php

namespace App\Filament\Admin\Resources\PksRumahTanggas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PksRumahTanggaForm
{
    /**
     * Konfigurasi Form PKS Rumah Tangga.
     * Layout Sidebar untuk memisahkan detail tuan rumah dan jadwal pelayanan.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Informasi Tuan Rumah')
                        ->description('Pilih keluarga yang akan menjadi lokasi ibadah PKS.')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Select::make('keluarga_id')
                                ->label('Keluarga (Tuan Rumah)')
                                ->relationship('keluarga', 'nama_keluarga')
                                ->searchable()
                                ->preload()
                                ->required()
                                ->helperText('Ketik nama keluarga untuk mencari data.'),

                            TextInput::make('sektor')
                                ->label('Sektor / Wilayah Pelayanan')
                                ->placeholder('Misal: Sektor I atau Wilayah A')
                                ->required()
                                ->datalist(fn() => \App\Models\Keluarga::distinct()->pluck('sektor')->toArray()),
                        ])->columns(2),

                    // BAGIAN 2: PETUGAS PELAYANAN
                    Section::make('Petugas Pelayanan')
                        ->description('Daftar pelayan yang bertugas dalam ibadah.')
                        ->icon('heroicon-o-user-group')
                        ->schema([
                            TextInput::make('pelayan_firman')
                                ->label('Pelayan Firman (Pengkhotbah)')
                                ->placeholder('Nama Pendeta / Penatua / Diaken')
                                ->required(),

                            TextInput::make('liturgos')
                                ->label('Liturgos / Pemimpin Pujian')
                                ->placeholder('Nama petugas'),

                            TextInput::make('pemusik')
                                ->label('Pemusik / Pengiring')
                                ->placeholder('Nama pemusik atau pemain gitar'),

                            TextInput::make('tema')
                                ->label('Tema / Bahan Alkitab')
                                ->placeholder('Misal: Yohanes 3:16 - Kasih Allah')
                                ->columnSpanFull(),
                        ])->columns(2),
                ])->columnSpan(['lg' => 2]),

                // BAGIAN 3: WAKTU PELAKSANAAN (SIDEBAR)
                Group::make()->schema([
                    Section::make('Waktu Ibadah')
                        ->icon('heroicon-o-clock')
                        ->schema([
                            DatePicker::make('tanggal')
                                ->label('Hari / Tanggal')
                                ->required()
                                ->native(false)
                                ->displayFormat('d F Y')
                                ->closeOnDateSelection(),

                            TimePicker::make('jam')
                                ->label('Jam Mulai (WITA)')
                                ->default('18:00')
                                ->required()
                                ->seconds(false),
                        ]),
                ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
    }
}