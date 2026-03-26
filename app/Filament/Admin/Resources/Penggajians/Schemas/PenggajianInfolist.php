<?php

namespace App\Filament\Admin\Resources\Penggajians\Schemas;

use App\Models\Penggajian;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PenggajianInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('pelayan_id')
                    ->numeric(),
                TextEntry::make('tanggal_bayar')
                    ->date(),
                TextEntry::make('periode_bulan'),
                TextEntry::make('total_kehadiran')
                    ->numeric(),
                TextEntry::make('total_insentif')
                    ->numeric(),
                TextEntry::make('catatan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Penggajian $record): bool => $record->trashed()),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
