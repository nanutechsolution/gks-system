<?php

namespace App\Filament\Admin\Resources\Rekenings\Pages;

use App\Filament\Admin\Resources\Rekenings\RekeningResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageRekenings extends ManageRecords
{
    protected static string $resource = RekeningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
