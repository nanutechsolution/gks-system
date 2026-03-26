<?php

namespace App\Filament\Admin\Resources\Pelayans\Pages;

use App\Filament\Admin\Resources\Pelayans\PelayanResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPelayan extends ViewRecord
{
    protected static string $resource = PelayanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
