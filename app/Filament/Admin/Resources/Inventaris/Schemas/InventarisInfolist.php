<?php

namespace App\Filament\Admin\Resources\Inventaris\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InventarisInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('kode_barang')
                    ->placeholder('-'),
                TextEntry::make('nama_barang'),
                TextEntry::make('kategori'),
                TextEntry::make('jumlah')
                    ->numeric(),
                TextEntry::make('satuan'),
                TextEntry::make('kondisi')
                    ->badge(),
                TextEntry::make('lokasi')
                    ->placeholder('-'),
                TextEntry::make('tanggal_perolehan')
                    ->date()
                    ->placeholder('-'),
                TextEntry::make('foto_barang')
                    ->placeholder('-'),
                TextEntry::make('keterangan')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
