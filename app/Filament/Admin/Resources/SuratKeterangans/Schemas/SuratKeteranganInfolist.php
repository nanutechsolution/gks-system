<?php

namespace App\Filament\Admin\Resources\SuratKeterangans\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SuratKeteranganInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nomor_surat'),
                TextEntry::make('jemaat_id')
                    ->numeric(),
                TextEntry::make('jenis_surat')
                    ->badge(),
                TextEntry::make('keperluan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('tanggal_surat')
                    ->date(),
                TextEntry::make('tujuan_surat')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
