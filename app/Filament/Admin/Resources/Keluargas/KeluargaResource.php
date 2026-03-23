<?php

namespace App\Filament\Admin\Resources\Keluargas;

use App\Filament\Admin\Resources\Keluargas\Pages\CreateKeluarga;
use App\Filament\Admin\Resources\Keluargas\Pages\EditKeluarga;
use App\Filament\Admin\Resources\Keluargas\Pages\ListKeluargas;
use App\Filament\Admin\Resources\Keluargas\Pages\ViewKeluarga;
use App\Filament\Admin\Resources\Keluargas\Schemas\KeluargaForm;
use App\Filament\Admin\Resources\Keluargas\Schemas\KeluargaInfolist;
use App\Filament\Admin\Resources\Keluargas\Tables\KeluargasTable;
use App\Models\Keluarga;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KeluargaResource extends Resource
{
    protected static ?string $model = Keluarga::class;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;
    protected static string | UnitEnum  | null $navigationGroup = 'Data Master';
    protected static ?string $recordTitleAttribute = 'nama_keluarga';
    protected static ?string $navigationLabel = 'Keluarga';
    protected static ?string $modelLabel = 'Keluarga';
    protected static ?string $pluralModelLabel = 'Keluarga';
    
    public static function form(Schema $schema): Schema
    {
        return KeluargaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return KeluargaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KeluargasTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\AnggotaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListKeluargas::route('/'),
            'create' => CreateKeluarga::route('/create'),
            'view' => ViewKeluarga::route('/{record}'),
            'edit' => EditKeluarga::route('/{record}/edit'),
        ];
    }
}
