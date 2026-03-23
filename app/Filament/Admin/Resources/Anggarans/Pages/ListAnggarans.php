<?php

namespace App\Filament\Admin\Resources\Anggarans\Pages;

use App\Filament\Admin\Resources\Anggarans\AnggaranResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAnggarans extends ListRecords
{
    protected static string $resource = AnggaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('cetak_pdf')
                ->label('Cetak Laporan PDF')
                ->color('success')
                ->icon('heroicon-o-printer')
                ->url(fn() => route('cetak.anggaran', ['tahun' => 2026]))
                ->openUrlInNewTab(),
            CreateAction::make(),
        ];
    }
}
