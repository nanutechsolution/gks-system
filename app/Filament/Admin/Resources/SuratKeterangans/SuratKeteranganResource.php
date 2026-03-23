<?php

namespace App\Filament\Admin\Resources\SuratKeterangans;

use App\Enums\NavigationGroupEnum;
use App\Filament\Admin\Resources\SuratKeterangans\Pages\CreateSuratKeterangan;
use App\Filament\Admin\Resources\SuratKeterangans\Pages\EditSuratKeterangan;
use App\Filament\Admin\Resources\SuratKeterangans\Pages\ListSuratKeterangans;
use App\Filament\Admin\Resources\SuratKeterangans\Pages\ViewSuratKeterangan;
use App\Filament\Admin\Resources\SuratKeterangans\Schemas\SuratKeteranganForm;
use App\Filament\Admin\Resources\SuratKeterangans\Schemas\SuratKeteranganInfolist;
use App\Filament\Admin\Resources\SuratKeterangans\Tables\SuratKeterangansTable;
use App\Models\SuratKeterangan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class SuratKeteranganResource extends Resource
{
    protected static ?string $model = SuratKeterangan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEnvelopeOpen;
    protected static string|UnitEnum|null $navigationGroup = NavigationGroupEnum::Pelayanan->value;
    protected static ?string $navigationLabel = 'Surat Keterangan';
    protected static ?string $recordTitleAttribute = 'nomor_surat';

    public static function form(Schema $schema): Schema
    {
        return SuratKeteranganForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SuratKeteranganInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SuratKeterangansTable::configure($table);
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
            'index' => ListSuratKeterangans::route('/'),
            'create' => CreateSuratKeterangan::route('/create'),
            'view' => ViewSuratKeterangan::route('/{record}'),
            'edit' => EditSuratKeterangan::route('/{record}/edit'),
        ];
    }
}
