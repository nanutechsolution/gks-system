<?php

namespace App\Filament\Admin\Resources\Beritas;

use App\Filament\Admin\Resources\Beritas\Pages\CreateBerita;
use App\Filament\Admin\Resources\Beritas\Pages\EditBerita;
use App\Filament\Admin\Resources\Beritas\Pages\ListBeritas;
use App\Filament\Admin\Resources\Beritas\Schemas\BeritaForm;
use App\Filament\Admin\Resources\Beritas\Tables\BeritasTable;
use App\Models\Berita;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedNewspaper;
    protected static string | UnitEnum  | null $navigationGroup = 'Publikasi';
    protected static ?string $navigationLabel = 'Berita & Artikel';
    public static function form(Schema $schema): Schema
    {
        return BeritaForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BeritasTable::configure($table);
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
            'index' => ListBeritas::route('/'),
            'create' => CreateBerita::route('/create'),
            'edit' => EditBerita::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();

        // Jika user adalah super_admin, tampilkan semua berita
        if (auth()->user()->hasRole('super_admin')) {
            return $query;
        }

        // Jika bukan super_admin, hanya tampilkan berita buatannya sendiri
        return $query->where('user_id', auth()->id());
    }
}
