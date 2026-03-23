<?php

namespace App\Filament\Admin\Resources\Keuangans;

use App\Filament\Admin\Resources\Keuangans\Pages\CreateKeuangan;
use App\Filament\Admin\Resources\Keuangans\Pages\EditKeuangan;
use App\Filament\Admin\Resources\Keuangans\Pages\ListKeuangans;
use App\Filament\Admin\Resources\Keuangans\Pages\ViewKeuangan;
use App\Filament\Admin\Resources\Keuangans\Schemas\KeuanganForm;
use App\Filament\Admin\Resources\Keuangans\Schemas\KeuanganInfolist;
use App\Filament\Admin\Resources\Keuangans\Tables\KeuangansTable;
use App\Models\Keuangan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KeuanganResource extends Resource
{
    protected static ?string $model = Keuangan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;
    protected static ?string $navigationLabel = 'Kas & Keuangan';
    protected static ?string $recordTitleAttribute = 'keterangan';
    protected static string | UnitEnum  | null $navigationGroup = 'Administrasi';
    public static function form(Schema $schema): Schema
    {
        return KeuanganForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KeuanganInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KeuangansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKeuangans::route('/'),
            'create' => CreateKeuangan::route('/create'),
            'view' => ViewKeuangan::route('/{record}'),
            'edit' => EditKeuangan::route('/{record}/edit'),
        ];
    }
}
