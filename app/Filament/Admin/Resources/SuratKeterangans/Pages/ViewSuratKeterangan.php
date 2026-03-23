<?php

namespace App\Filament\Admin\Resources\SuratKeterangans\Pages;

use App\Filament\Admin\Resources\SuratKeterangans\SuratKeteranganResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSuratKeterangan extends ViewRecord
{
    protected static string $resource = SuratKeteranganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
