<?php

namespace App\Filament\Admin\Resources\Inventaris;

use App\Filament\Admin\Resources\Inventaris\Pages\CreateInventaris;
use App\Filament\Admin\Resources\Inventaris\Pages\EditInventaris;
use App\Filament\Admin\Resources\Inventaris\Pages\ListInventaris;
use App\Filament\Admin\Resources\Inventaris\Pages\ViewInventaris;
use App\Filament\Admin\Resources\Inventaris\Schemas\InventarisForm;
use App\Filament\Admin\Resources\Inventaris\Schemas\InventarisInfolist;
use App\Filament\Admin\Resources\Inventaris\Tables\InventarisTable;
use App\Models\Inventaris;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class InventarisResource extends Resource
{
    protected static ?string $model = Inventaris::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static string | UnitEnum | null $navigationGroup = 'Administrasi';
    protected static ?int $navigationSort = 1;
    protected static ?string $recordTitleAttribute = 'nama_barang';
    protected static ?string $navigationLabel = 'Inventaris';

    public static function form(Schema $schema): Schema
    {
        return InventarisForm::configure($schema);
    }
    public static function infolist(Schema $schema): Schema
    {
        return InventarisInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InventarisTable::configure($table);
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
            'index' => ListInventaris::route('/'),
            'create' => CreateInventaris::route('/create'),
            'view' => ViewInventaris::route('/{record}'),
            'edit' => EditInventaris::route('/{record}/edit'),
        ];
    }
}
