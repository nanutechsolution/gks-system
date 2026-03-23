<?php

namespace App\Filament\Admin\Resources\Keluargas\Pages;

use App\Filament\Admin\Resources\Keluargas\KeluargaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKeluargas extends ListRecords
{
    protected static string $resource = KeluargaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
