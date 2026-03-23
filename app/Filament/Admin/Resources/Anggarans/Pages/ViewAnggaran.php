<?php

namespace App\Filament\Admin\Resources\Anggarans\Pages;

use App\Filament\Admin\Resources\Anggarans\AnggaranResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAnggaran extends ViewRecord
{
    protected static string $resource = AnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
