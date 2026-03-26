<?php

namespace App\Filament\Admin\Resources\Pelayans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PelayanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jemaat_id')
                    ->numeric(),
                TextInput::make('nama_lengkap')
                    ->required(),
                Select::make('jabatan')
                    ->options([
            'Pendeta' => 'Pendeta',
            'Vikaris' => 'Vikaris',
            'Penatua' => 'Penatua',
            'Diaken' => 'Diaken',
            'Pemusik' => 'Pemusik',
            'Karyawan' => 'Karyawan',
            'Tamu' => 'Tamu',
        ])
                    ->required(),
                TextInput::make('telepon')
                    ->tel(),
                TextInput::make('nomor_sk'),
                DatePicker::make('mulai_bertugas'),
                DatePicker::make('akhir_bertugas'),
                TextInput::make('insentif_per_layanan')
                    ->required()
                    ->numeric()
                    ->default(0.0),
                Toggle::make('is_aktif')
                    ->required(),
                TextInput::make('metadata'),
            ]);
    }
}
