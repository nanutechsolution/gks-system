<?php

namespace App\Filament\Admin\Resources\Inventaris\Pages;

use App\Filament\Admin\Resources\Inventaris\InventarisResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInventaris extends ListRecords
{
    protected static string $resource = InventarisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
