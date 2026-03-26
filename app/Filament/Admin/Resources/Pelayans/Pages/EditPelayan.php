<?php

namespace App\Filament\Admin\Resources\Pelayans\Pages;

use App\Filament\Admin\Resources\Pelayans\PelayanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPelayan extends EditRecord
{
    protected static string $resource = PelayanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
