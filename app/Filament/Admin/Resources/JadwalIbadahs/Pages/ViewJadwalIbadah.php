<?php

namespace App\Filament\Admin\Resources\JadwalIbadahs\Pages;

use App\Filament\Admin\Resources\JadwalIbadahs\JadwalIbadahResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewJadwalIbadah extends ViewRecord
{
    protected static string $resource = JadwalIbadahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
