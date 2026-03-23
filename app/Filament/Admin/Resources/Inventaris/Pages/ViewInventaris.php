<?php

namespace App\Filament\Admin\Resources\Inventaris\Pages;

use App\Filament\Admin\Resources\Inventaris\InventarisResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewInventaris extends ViewRecord
{
    protected static string $resource = InventarisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
