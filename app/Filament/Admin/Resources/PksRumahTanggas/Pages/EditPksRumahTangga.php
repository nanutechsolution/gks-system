<?php

namespace App\Filament\Admin\Resources\PksRumahTanggas\Pages;

use App\Filament\Admin\Resources\PksRumahTanggas\PksRumahTanggaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPksRumahTangga extends EditRecord
{
    protected static string $resource = PksRumahTanggaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
