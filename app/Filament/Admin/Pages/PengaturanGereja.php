<?php

namespace App\Filament\Admin\Pages;

use App\Enums\NavigationGroupEnum;
use App\Models\Pengaturan;
use BackedEnum;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class PengaturanGereja extends Page implements HasForms
{
    use InteractsWithForms;
    use HasPageShield;

    // protected static ?string $navigationIcon = 'heroicon-o-building-library';
    // protected static ?string $navigationGroup = 'Pengaturan Sistem';
    protected static ?string $title = 'Profil & Pejabat Gereja';
    protected static ?int $navigationSort = 10;
    protected  string $view = 'filament.admin.pages.pengaturan-gereja';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;
    protected static string | UnitEnum  | null $navigationGroup = NavigationGroupEnum::AksesKontrol->value;
    protected static ?string $recordTitleAttribute = 'nama_pos';

    public ?array $data = [];

    public function mount(): void
    {
        // Ambil data pertama, jika tidak ada, buat instance kosong
        $pengaturan = Pengaturan::first();
        if ($pengaturan) {
            $this->form->fill($pengaturan->toArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Schema $Schema): Schema
    {
        return $Schema
            ->components([
                Grid::make(3)->schema([
                    Section::make('Identitas Gereja')
                        ->icon('heroicon-o-home-modern')
                        ->schema([
                            TextInput::make('nama_gereja')
                                ->label('Nama Sinode / Gereja')
                                ->required(),
                            TextInput::make('nama_jemaat')
                                ->label('Nama Jemaat')
                                ->required(),
                            Textarea::make('alamat_lengkap')
                                ->label('Alamat Lengkap')
                                ->rows(3),
                        ])->columnSpan(2),

                    Section::make('Media & Lokasi')
                        ->icon('heroicon-o-photo')
                        ->schema([
                            FileUpload::make('logo_gereja')
                                ->label('Logo Gereja')
                                ->image()
                                ->directory('pengaturan'),
                            TextInput::make('kota_surat')
                                ->label('Kota/Lokasi Surat')
                                ->placeholder('Misal: Lolo Ole atau Waingapu')
                                ->helperText('Akan tercetak di bagian bawah BKM/Surat sebelum tanggal.'),
                        ])->columnSpan(1),

                    Section::make('Pejabat Gereja (BPMJ)')
                        ->icon('heroicon-o-user-group')
                        ->description('Nama yang diinput di sini akan otomatis muncul sebagai penandatangan di semua cetakan PDF Laporan dan Bukti Kas.')
                        ->schema([
                            TextInput::make('nama_ketua_majelis')
                                ->label('Nama Ketua Majelis Jemaat')
                                ->placeholder('Misal: Pdt. Alponia Malo, S.Th')
                                ->required(),
                            TextInput::make('nama_sekretaris')
                                ->label('Nama Sekretaris Jemaat')
                                ->placeholder('Misal: Pnt. Benyamin T. Dona')
                                ->required(),
                        ])->columnSpanFull()->columns(2),
                ])
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $pengaturan = Pengaturan::first();

        if ($pengaturan) {
            $pengaturan->update($data);
        } else {
            Pengaturan::create($data);
        }

        Notification::make()
            ->success()
            ->title('Pengaturan Tersimpan')
            ->body('Data profil dan pejabat gereja berhasil diperbarui.')
            ->send();
    }
}
