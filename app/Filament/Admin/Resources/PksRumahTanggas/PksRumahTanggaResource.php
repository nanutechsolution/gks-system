<?php

namespace App\Filament\Admin\Resources\PksRumahTanggas;

use App\Enums\NavigationGroupEnum;
use App\Filament\Admin\Resources\PksRumahTanggas\Pages\CreatePksRumahTangga;
use App\Filament\Admin\Resources\PksRumahTanggas\Pages\EditPksRumahTangga;
use App\Filament\Admin\Resources\PksRumahTanggas\Pages\ListPksRumahTanggas;
use App\Filament\Admin\Resources\PksRumahTanggas\Pages\ViewPksRumahTangga;
use App\Filament\Admin\Resources\PksRumahTanggas\Schemas\PksRumahTanggaForm;
use App\Filament\Admin\Resources\PksRumahTanggas\Schemas\PksRumahTanggaInfolist;
use App\Filament\Admin\Resources\PksRumahTanggas\Tables\PksRumahTanggasTable;
use App\Models\PksRumahTangga;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PksRumahTanggaResource extends Resource
{
    protected static ?string $model = PksRumahTangga::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;
    protected static ?string $navigationLabel = 'Jadwal PKS';
    protected static ?string $recordTitleAttribute = 'pelayan_firman';
    protected static string|UnitEnum|null $navigationGroup = NavigationGroupEnum::Pelayanan->value;
    public static function form(Schema $schema): Schema
    {
        return PksRumahTanggaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PksRumahTanggaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PksRumahTanggasTable::configure($table);
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
            'index' => ListPksRumahTanggas::route('/'),
            'create' => CreatePksRumahTangga::route('/create'),
            'view' => ViewPksRumahTangga::route('/{record}'),
            'edit' => EditPksRumahTangga::route('/{record}/edit'),
        ];
    }
}
