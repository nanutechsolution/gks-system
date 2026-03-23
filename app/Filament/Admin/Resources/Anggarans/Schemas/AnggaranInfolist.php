<?php

namespace App\Filament\Admin\Resources\Anggarans\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class AnggaranInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Klasifikasi Anggaran')
                    ->icon('heroicon-o-tag')
                    ->schema([
                        TextEntry::make('tahun')
                            ->label('Tahun'),
                        TextEntry::make('jenis')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'Pendapatan' => 'success',
                                'Belanja' => 'danger',
                            }),
                        TextEntry::make('kelompok_pos')
                            ->label('Kelompok Pos')
                            ->placeholder('Tanpa Kelompok'),
                        TextEntry::make('nama_pos')
                            ->label('Uraian Pos')
                            ->weight('bold'),
                    ])->columns(2),

                Section::make('Nilai Target Anggaran')
                    ->icon('heroicon-o-banknotes')
                    ->schema([
                        TextEntry::make('target_per_bulan')
                            ->label('Target Bulanan')
                            ->money('IDR'),
                        TextEntry::make('target_per_tahun')
                            ->label('Target Tahunan')
                            ->money('IDR')
                            ->weight('bold')
                            ->color('primary'),
                    ])->columns(2),
            ]);
    }
}