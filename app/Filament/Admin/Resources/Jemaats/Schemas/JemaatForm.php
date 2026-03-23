<?php

namespace App\Filament\Admin\Resources\Jemaats\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JemaatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pribadi')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextInput::make('nomor_induk')
                            ->label('Nomor Induk Anggota')
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: GKS-RP-001')
                            ->maxLength(255),
                        TextInput::make('nama_lengkap')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->required(),
                        TextInput::make('tempat_lahir')
                            ->label('Tempat Lahir')
                            ->maxLength(255),
                        DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->native(false)
                            ->displayFormat('d/m/Y'),
                    ])->columns(2),

                Section::make('Kontak & Pelayanan')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->rows(3)
                            ->columnSpanFull(),
                        TextInput::make('sektor')
                            ->label('Sektor / Wilayah Pelayanan')
                            ->placeholder('Contoh: Sektor I')
                            ->maxLength(255),
                        Select::make('status_anggota')
                            ->label('Status Anggota')
                            ->options([
                                'Aktif' => 'Aktif',
                                'Pindah' => 'Pindah',
                                'Meninggal' => 'Meninggal',
                            ])
                            ->default('Aktif')
                            ->required(),
                    ])->columns(2),

                Section::make('Status Sakramen')
                    ->icon('heroicon-o-sparkles')
                    ->description('Lengkapi data ini untuk keperluan pencetakan Piagam Baptis/Sidi.')
                    ->schema([
                        // BAGIAN BAPTIS
                        Toggle::make('status_baptis')
                            ->label('Sudah Dibaptis?')
                            ->live() // Membuat form reaktif
                            ->columnSpanFull(),

                        DatePicker::make('tanggal_baptis')
                            ->label('Tanggal Baptis')
                            ->native(false)
                            ->visible(fn($get) => $get('status_baptis')),

                        TextInput::make('tempat_baptis')
                            ->label('Tempat Baptis')
                            ->placeholder('GKS Jemaat Reda Pada')
                            ->visible(fn($get) => $get('status_baptis')),

                        TextInput::make('pendeta_baptis')
                            ->label('Pendeta yang Membaptis')
                            ->visible(fn($get) => $get('status_baptis'))
                            ->columnSpanFull(),

                        // BAGIAN SIDI
                        Toggle::make('status_sidi')
                            ->label('Sudah Sidi?')
                            ->live()
                            ->columnSpanFull(),

                        DatePicker::make('tanggal_sidi')
                            ->label('Tanggal Sidi')
                            ->native(false)
                            ->visible(fn($get) => $get('status_sidi')),

                        TextInput::make('tempat_sidi')
                            ->label('Tempat Sidi')
                            ->visible(fn($get) => $get('status_sidi')),

                        TextInput::make('pendeta_sidi')
                            ->label('Pendeta yang Melayani Sidi')
                            ->visible(fn($get) => $get('status_sidi'))
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
