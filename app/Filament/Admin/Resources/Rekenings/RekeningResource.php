<?php

namespace App\Filament\Admin\Resources\Rekenings;

use App\Filament\Admin\Resources\Rekenings\Pages\ManageRekenings;
use App\Models\Rekening;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class RekeningResource extends Resource
{
    protected static ?string $model = Rekening::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCreditCard;
    protected static string | UnitEnum  | null $navigationGroup = 'Administrasi';
    protected static ?string $modelLabel = 'Rekening Kas';
    protected static ?string $pluralModelLabel = 'Daftar Rekening Kas';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_kas')
                    ->label('Nama Kas / Bank')
                    ->required()
                    ->placeholder('Contoh: Kas Tunai Brankas, Bank NTT, Bank BRI')
                    ->maxLength(255)
                    ->columnSpanFull(),

                TextInput::make('nomor_rekening')
                    ->label('Nomor Rekening')
                    ->placeholder('Kosongkan jika Kas Tunai')
                    ->maxLength(255),

                TextInput::make('atas_nama')
                    ->label('Atas Nama')
                    ->placeholder('Misal: GKS Jemaat Reda Pada')
                    ->maxLength(255),

                TextInput::make('saldo_awal')
                    ->label('Saldo Awal (Rp)')
                    ->required()
                    ->numeric()
                    ->prefix('Rp')
                    ->default(0)
                    ->helperText('Masukkan saldo saat pertama kali menggunakan sistem ini.')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_kas')
                    ->label('Nama Kas')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('nomor_rekening')
                    ->label('No. Rekening')
                    ->searchable()
                    ->description(fn(Rekening $record): ?string => $record->atas_nama),

                TextColumn::make('saldo_awal')
                    ->label('Saldo Awal')
                    ->money('IDR')
                    ->sortable()
                    ->color('gray'),

                TextColumn::make('saldo_akhir')
                    ->label('Saldo Saat Ini')
                    ->money('IDR')
                    ->weight('bold')
                    ->color('primary')
                    ->state(fn(Rekening $record) => $record->saldo_akhir)
                    ->tooltip('Saldo Awal + Total Pemasukan - Total Pengeluaran'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageRekenings::route('/'),
        ];
    }
}
