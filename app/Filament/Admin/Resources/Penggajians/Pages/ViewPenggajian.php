<?php

namespace App\Filament\Admin\Resources\Penggajians\Pages;

use App\Filament\Admin\Resources\Penggajians\PenggajianResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPenggajian extends ViewRecord
{
    protected static string $resource = PenggajianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
