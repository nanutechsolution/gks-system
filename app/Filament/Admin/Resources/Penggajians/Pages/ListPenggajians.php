<?php

namespace App\Filament\Admin\Resources\Penggajians\Pages;

use App\Filament\Admin\Resources\Penggajians\PenggajianResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPenggajians extends ListRecords
{
    protected static string $resource = PenggajianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
