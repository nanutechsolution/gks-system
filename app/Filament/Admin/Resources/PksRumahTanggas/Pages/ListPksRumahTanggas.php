<?php

namespace App\Filament\Admin\Resources\PksRumahTanggas\Pages;

use App\Filament\Admin\Resources\PksRumahTanggas\PksRumahTanggaResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPksRumahTanggas extends ListRecords
{
    protected static string $resource = PksRumahTanggaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('cetak_jadwal')
                ->icon('heroicon-o-printer')
                ->color('success')
                ->url(fn() => route('cetak.jadwal-pks'))
                ->openUrlInNewTab(),
            CreateAction::make(),
        ];
    }
}
