<?php

namespace App\Filament\Admin\Resources\Anggarans;

use App\Enums\NavigationGroupEnum;
use App\Filament\Admin\Resources\Anggarans\Pages\CreateAnggaran;
use App\Filament\Admin\Resources\Anggarans\Pages\EditAnggaran;
use App\Filament\Admin\Resources\Anggarans\Pages\ListAnggarans;
use App\Filament\Admin\Resources\Anggarans\Pages\ViewAnggaran;
use App\Filament\Admin\Resources\Anggarans\Schemas\AnggaranForm;
use App\Filament\Admin\Resources\Anggarans\Schemas\AnggaranInfolist;
use App\Filament\Admin\Resources\Anggarans\Tables\AnggaransTable;
use App\Models\Anggaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AnggaranResource extends Resource
{
    protected static ?string $model = Anggaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;
    protected static ?string $navigationLabel = 'Anggaran';
    protected static string | UnitEnum  | null $navigationGroup = NavigationGroupEnum::Administrasi->value;
    protected static ?string $recordTitleAttribute = 'nama_pos';

    public static function form(Schema $schema): Schema
    {
        return AnggaranForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AnggaranInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AnggaransTable::configure($table);
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
            'index' => ListAnggarans::route('/'),
            'create' => CreateAnggaran::route('/create'),
            'view' => ViewAnggaran::route('/{record}'),
            'edit' => EditAnggaran::route('/{record}/edit'),
        ];
    }
}
