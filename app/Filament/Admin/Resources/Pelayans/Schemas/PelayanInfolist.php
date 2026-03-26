<?php

namespace App\Filament\Admin\Resources\Pelayans\Schemas;

use App\Models\Pelayan;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PelayanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('jemaat_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('nama_lengkap'),
                TextEntry::make('jabatan')
                    ->badge(),
                TextEntry::make('telepon')
                    ->placeholder('-'),
                TextEntry::make('nomor_sk')
                    ->placeholder('-'),
                TextEntry::make('mulai_bertugas')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('akhir_bertugas')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('insentif_per_layanan')
                    ->numeric(),
                IconEntry::make('is_aktif')
                    ->boolean(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Pelayan $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
