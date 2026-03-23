<?php

namespace App\Filament\Admin\Resources\PksRumahTanggas\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PksRumahTanggasTable
{
    public static function configure(Table $table): Table
    {
        return $table
               ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                
                TextColumn::make('keluarga.nama_keluarga')
                    ->label('Tuan Rumah')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn ($record) => "Sektor: {$record->sektor}"),

                TextColumn::make('pelayan_firman')
                    ->label('Pelayan Firman')
                    ->icon('heroicon-o-user'),

                TextColumn::make('jam')
                    ->label('Waktu'),
            ])
            ->filters([
                SelectFilter::make('sektor')
                    ->label('Filter Sektor'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
