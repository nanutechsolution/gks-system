<?php

namespace App\Filament\Admin\Resources\PksRumahTanggas\Pages;

use App\Filament\Admin\Resources\PksRumahTanggas\PksRumahTanggaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPksRumahTangga extends ViewRecord
{
    protected static string $resource = PksRumahTanggaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
