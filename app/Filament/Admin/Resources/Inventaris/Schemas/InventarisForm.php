<?php

namespace App\Filament\Admin\Resources\Inventaris\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InventarisForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Barang')
                    ->schema([
                        TextInput::make('kode_barang')
                            ->label('Kode Barang / Label')
                            ->placeholder('Contoh: GKS-001')
                            ->unique(ignoreRecord: true),
                        TextInput::make('nama_barang')
                            ->label('Nama Barang')
                            ->required(),
                        Select::make('kategori')
                            ->options([
                                'Elektronik' => 'Elektronik',
                                'Alat Musik' => 'Alat Musik',
                                'Sound System' => 'Sound System',
                                'Mebeul' => 'Mebeul (Meja/Kursi)',
                                'Kendaraan' => 'Kendaraan',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required()
                            ->searchable(),
                    ])->columns(2),

                Section::make('Detail & Kondisi')
                    ->schema([
                        TextInput::make('jumlah')
                            ->numeric()
                            ->default(1)
                            ->required(),
                        TextInput::make('satuan')
                            ->placeholder('Unit/Pcs/Set')
                            ->default('Unit'),
                        Select::make('kondisi')
                            ->options([
                                'Baik' => 'Baik',
                                'Rusak Ringan' => 'Rusak Ringan',
                                'Rusak Berat' => 'Rusak Berat',
                            ])
                            ->required(),
                        TextInput::make('lokasi')
                            ->placeholder('Ruang Pastori / Gedung Gereja'),
                    ])->columns(2),

                Section::make('Media & Tambahan')
                    ->schema([
                        FileUpload::make('foto_barang')
                            ->image()
                            ->directory('inventaris')
                            ->columnSpanFull(),
                        DatePicker::make('tanggal_perolehan')
                            ->native(false),
                        Textarea::make('keterangan')
                            ->rows(2),
                    ])->columns(2),
            ]);
    }
}
