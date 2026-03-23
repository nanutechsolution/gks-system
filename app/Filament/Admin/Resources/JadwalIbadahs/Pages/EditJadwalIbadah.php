<?php

namespace App\Filament\Admin\Resources\JadwalIbadahs\Pages;

use App\Filament\Admin\Resources\JadwalIbadahs\JadwalIbadahResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditJadwalIbadah extends EditRecord
{
    protected static string $resource = JadwalIbadahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
