<?php

namespace App\Filament\Admin\Resources\SuratKeterangans\Pages;

use App\Filament\Admin\Resources\SuratKeterangans\SuratKeteranganResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSuratKeterangan extends EditRecord
{
    protected static string $resource = SuratKeteranganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
