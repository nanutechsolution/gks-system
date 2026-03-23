<?php

namespace App\Filament\Admin\Resources\Jemaats\Pages;

use App\Filament\Admin\Resources\Jemaats\JemaatResource;
use App\Filament\Exports\JemaatExporter;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Support\Icons\Heroicon;

class ListJemaats extends ListRecords
{
    protected static string $resource = JemaatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ExportAction::make()
                ->exporter(JemaatExporter::class)
                ->label('Export Data')
                ->color('success')
                ->icon(Heroicon::OutlinedArrowDownTray),
            CreateAction::make(),
        ];
    }
}
