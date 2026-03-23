<?php

namespace App\Filament\Admin\Resources\JadwalIbadahs;

use App\Filament\Admin\Resources\JadwalIbadahs\Pages\CreateJadwalIbadah;
use App\Filament\Admin\Resources\JadwalIbadahs\Pages\EditJadwalIbadah;
use App\Filament\Admin\Resources\JadwalIbadahs\Pages\ListJadwalIbadahs;
use App\Filament\Admin\Resources\JadwalIbadahs\Pages\ViewJadwalIbadah;
use App\Filament\Admin\Resources\JadwalIbadahs\Schemas\JadwalIbadahForm;
use App\Filament\Admin\Resources\JadwalIbadahs\Schemas\JadwalIbadahInfolist;
use App\Filament\Admin\Resources\JadwalIbadahs\Tables\JadwalIbadahsTable;
use App\Models\JadwalIbadah;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JadwalIbadahResource extends Resource
{
    protected static ?string $model = JadwalIbadah::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;
    protected static ?string $navigationLabel = 'Jadwal Ibadah';
    protected static ?string $recordTitleAttribute = 'nama_ibadah';
    protected static string | UnitEnum  | null $navigationGroup = 'Pelayanan';

    public static function form(Schema $schema): Schema
    {
        return JadwalIbadahForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JadwalIbadahInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JadwalIbadahsTable::configure($table);
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
            'index' => ListJadwalIbadahs::route('/'),
            'create' => CreateJadwalIbadah::route('/create'),
            'view' => ViewJadwalIbadah::route('/{record}'),
            'edit' => EditJadwalIbadah::route('/{record}/edit'),
        ];
    }
}
