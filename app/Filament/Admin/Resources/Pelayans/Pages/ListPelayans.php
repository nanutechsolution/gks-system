<?php

namespace App\Filament\Admin\Resources\Pelayans\Pages;

use App\Filament\Admin\Resources\Pelayans\PelayanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPelayans extends ListRecords
{
    protected static string $resource = PelayanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
