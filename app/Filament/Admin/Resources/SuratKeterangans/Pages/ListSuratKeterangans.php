<?php

namespace App\Filament\Admin\Resources\SuratKeterangans\Pages;

use App\Filament\Admin\Resources\SuratKeterangans\SuratKeteranganResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSuratKeterangans extends ListRecords
{
    protected static string $resource = SuratKeteranganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
