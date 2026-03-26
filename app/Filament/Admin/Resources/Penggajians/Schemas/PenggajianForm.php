<?php

namespace App\Filament\Admin\Resources\Penggajians\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Ramsey\Collection\Set;

class PenggajianForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Proses Penggajian')
                    ->schema([
                        Select::make('pelayan_id')
                            ->relationship('pelayan', 'nama_lengkap')
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn($state, Set $set) => self::updateTotal($state, $set)),
                        DatePicker::make('tanggal_bayar')->default(now())->required(),

                        Select::make('periode_bulan')
                            ->options([
                                'Maret 2026' => 'Maret 2026',
                                'April 2026' => 'April 2026',
                                // ... bisa dibuat dinamis
                            ])->required(),

                        TextInput::make('total_kehadiran')
                            ->numeric()
                            ->readOnly()
                            ->label('Total Tugas Bulan Ini'),

                        TextInput::make('total_insentif')
                            ->numeric()
                            ->prefix('Rp')
                            ->label('Total Yang Dibayarkan')
                            ->helperText('Dihitung dari: (Total Tugas x Insentif Per Layanan)'),
                    ])->columns(2)
            ]);
    }
    protected static function updateTotal($pelayanId, Set $set)
    {
        if (!$pelayanId) return;

        $pelayan = \App\Models\Pelayan::find($pelayanId);

        // Hitung total tugas di Ibadah Raya + PKS bulan ini
        $tugasIbadah = \App\Models\JadwalIbadah::where('pelayan_id', $pelayanId)
            ->whereMonth('waktu_mulai', now()->month)->count();

        $tugasPks = \App\Models\PksRumahTangga::where('pelayan_id', $pelayanId)
            ->whereMonth('tanggal', now()->month)->count();

        $totalTugas = $tugasIbadah + $tugasPks;

        $set('total_kehadiran', $totalTugas);
        $set('total_insentif', $totalTugas * $pelayan->insentif_per_layanan);
    }
}
