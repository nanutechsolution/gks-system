<?php

namespace App\Filament\Admin\Resources\Keluargas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class KeluargaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomor_kk')
                    ->label('Nomor Kartu Keluarga (KK)')
                    ->unique(ignoreRecord: true),
                TextInput::make('nama_keluarga')
                    ->label('Nama Keluarga')
                    ->placeholder('Contoh: Keluarga Umbu Rehi')
                    ->required(),
                Select::make('sektor')
                    ->options([
                        'Sektor 1' => 'Sektor 1',
                        'Sektor 2' => 'Sektor 2',
                    ]),
                Textarea::make('alamat_kk')
                    ->label('Alamat Rumah')
                    ->columnSpanFull(),
            ])->columns(2);
    }
}
