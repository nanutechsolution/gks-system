<?php

namespace App\Filament\Admin\Resources\SuratKeterangans\Schemas;

use App\Models\SuratKeterangan;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SuratKeteranganForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Pembuatan Surat Keterangan')
                    ->description('Pilih jemaat dan tentukan jenis surat yang akan dibuat.')
                    ->schema([
                        TextInput::make('nomor_surat')
                            ->label('Nomor Surat')
                            ->default(fn() => 'SK/GKS-RP/' . date('Y') . '/' . (SuratKeterangan::count() + 1))
                            ->required(),

                        Select::make('jemaat_id')
                            ->label('Nama Jemaat')
                            ->relationship('jemaat', 'nama_lengkap')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('jenis_surat')
                            ->label('Jenis Surat')
                            ->options([
                                'Pindah' => 'Surat Keterangan Pindah',
                                'Anggota Aktif' => 'Surat Keterangan Anggota',
                                'Rekomendasi Nikah' => 'Surat Rekomendasi Nikah',
                                'Lainnya' => 'Lain-lain',
                            ])
                            ->required()
                            ->live(),

                        TextInput::make('tujuan_surat')
                            ->label('Ditujukan Kepada')
                            ->placeholder('Misal: Majelis Jemaat GKS Waingapu')
                            ->required(),

                        Textarea::make('keperluan')
                            ->label('Alasan / Keperluan')
                            ->placeholder('Tulis alasan surat ini dibuat...')
                            ->rows(3)
                            ->columnSpanFull(),

                        DatePicker::make('tanggal_surat')
                            ->default(now())
                            ->required(),
                    ])->columns(2)
            ]);
    }
}
