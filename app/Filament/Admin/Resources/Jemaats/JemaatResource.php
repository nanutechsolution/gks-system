<?php

namespace App\Filament\Admin\Resources\Jemaats;

use App\Enums\NavigationGroupEnum;
use App\Filament\Admin\Resources\Jemaats\Pages\CreateJemaat;
use App\Filament\Admin\Resources\Jemaats\Pages\EditJemaat;
use App\Filament\Admin\Resources\Jemaats\Pages\ListJemaats;
use App\Filament\Admin\Resources\Jemaats\Pages\ViewJemaat;
use App\Filament\Admin\Resources\Jemaats\Schemas\JemaatForm;
use App\Filament\Admin\Resources\Jemaats\Schemas\JemaatInfolist;
use App\Filament\Admin\Resources\Jemaats\Tables\JemaatsTable;
use App\Models\Jemaat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JemaatResource extends Resource
{
    protected static ?string $model = Jemaat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;
    protected static string | UnitEnum  | null $navigationGroup = NavigationGroupEnum::DataMaster->value;
    protected static ?string $navigationLabel = 'Jemaat';
    protected static ?string $recordTitleAttribute = 'nama_lengkap';

    protected static ?string $modelLabel = 'Jemaat';
    protected static ?string $pluralModelLabel = 'Jemaat';
    public static function form(Schema $schema): Schema
    {
        return JemaatForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JemaatInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JemaatsTable::configure($table);
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
            'index' => ListJemaats::route('/'),
            'create' => CreateJemaat::route('/create'),
            'view' => ViewJemaat::route('/{record}'),
            'edit' => EditJemaat::route('/{record}/edit'),
        ];
    }
}
