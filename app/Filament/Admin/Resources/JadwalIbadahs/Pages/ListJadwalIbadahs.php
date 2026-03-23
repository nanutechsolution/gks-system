<?php

namespace App\Filament\Admin\Resources\JadwalIbadahs\Pages;

use App\Filament\Admin\Resources\JadwalIbadahs\JadwalIbadahResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJadwalIbadahs extends ListRecords
{
    protected static string $resource = JadwalIbadahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
