<?php

namespace App\Filament\Admin\Resources\Anggarans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AnggaransTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kode_pos')
                    ->label('Kode')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('nama_pos')
                    ->label('Uraian Pos')
                    ->description(fn($record) => $record->kelompok_pos)
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('jenis')
                    ->badge()
                    ->color(fn(string $state): string => $state === 'Pendapatan' ? 'success' : 'danger'),
                TextColumn::make('target_per_tahun')
                    ->label('Pagu RAP')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('realisasi')
                    ->label('Realisasi')
                    ->money('IDR')
                    ->state(fn($record) => $record->realisasi),
            ])
            ->defaultSort('kode_pos', 'asc')
            ->filters([
                SelectFilter::make('jenis')
                    ->options([
                        'Pendapatan' => 'Pendapatan',
                        'Belanja' => 'Belanja',
                    ]),
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
