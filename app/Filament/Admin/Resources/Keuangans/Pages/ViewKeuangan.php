<?php

namespace App\Filament\Admin\Resources\Keuangans\Pages;

use App\Filament\Admin\Resources\Keuangans\KeuanganResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewKeuangan extends ViewRecord
{
    protected static string $resource = KeuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
