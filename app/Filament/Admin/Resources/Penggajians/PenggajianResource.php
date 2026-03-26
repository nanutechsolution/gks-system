<?php

namespace App\Filament\Admin\Resources\Penggajians;

use App\Filament\Admin\Resources\Penggajians\Pages\CreatePenggajian;
use App\Filament\Admin\Resources\Penggajians\Pages\EditPenggajian;
use App\Filament\Admin\Resources\Penggajians\Pages\ListPenggajians;
use App\Filament\Admin\Resources\Penggajians\Pages\ViewPenggajian;
use App\Filament\Admin\Resources\Penggajians\Schemas\PenggajianForm;
use App\Filament\Admin\Resources\Penggajians\Schemas\PenggajianInfolist;
use App\Filament\Admin\Resources\Penggajians\Tables\PenggajiansTable;
use App\Models\Penggajian;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PenggajianResource extends Resource
{
    protected static ?string $model = Penggajian::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_lengkap';

    public static function form(Schema $schema): Schema
    {
        return PenggajianForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PenggajianInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PenggajiansTable::configure($table);
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
            'index' => ListPenggajians::route('/'),
            'create' => CreatePenggajian::route('/create'),
            'view' => ViewPenggajian::route('/{record}'),
            'edit' => EditPenggajian::route('/{record}/edit'),
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
