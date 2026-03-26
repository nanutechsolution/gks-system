<?php

namespace App\Filament\Admin\Resources\Pelayans;

use App\Filament\Admin\Resources\Pelayans\Pages\CreatePelayan;
use App\Filament\Admin\Resources\Pelayans\Pages\EditPelayan;
use App\Filament\Admin\Resources\Pelayans\Pages\ListPelayans;
use App\Filament\Admin\Resources\Pelayans\Pages\ViewPelayan;
use App\Filament\Admin\Resources\Pelayans\Schemas\PelayanForm;
use App\Filament\Admin\Resources\Pelayans\Schemas\PelayanInfolist;
use App\Filament\Admin\Resources\Pelayans\Tables\PelayansTable;
use App\Models\Pelayan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PelayanResource extends Resource
{
    protected static ?string $model = Pelayan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_lengkap';

    public static function form(Schema $schema): Schema
    {
        return PelayanForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PelayanInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PelayansTable::configure($table);
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
            'index' => ListPelayans::route('/'),
            'create' => CreatePelayan::route('/create'),
            'view' => ViewPelayan::route('/{record}'),
            'edit' => EditPelayan::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
