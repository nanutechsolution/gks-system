<?php

namespace App\Filament\Admin\Resources\Anggarans\Schemas;

use App\Models\Anggaran;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\RawJs;
use Illuminate\Support\Number;
use Illuminate\Support\Str;

class AnggaranForm
{
    /**
     * Konfigurasi Form Anggaran (RAPB).
     * Versi Super User-Friendly dengan Layout Sidebar Modern & Auto-Format Rupiah.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Kolom Kiri (Lebar 2/3) - Untuk Detail Identitas
                Group::make()->schema([
                    // BAGIAN 1: PEMILIHAN JENIS (Sangat Visual)
                    Section::make('Apa yang ingin Anda anggarkan?')
                        ->description('Pilih apakah Anda sedang merencanakan uang masuk atau uang keluar.')
                        ->schema([
                            ToggleButtons::make('jenis')
                                ->label('') // Sengaja disembunyikan agar lebih bersih
                                ->options([
                                    'Pendapatan' => 'Rencana Pendapatan (Target Uang Masuk)',
                                    'Belanja' => 'Rencana Belanja (Pagu Uang Keluar)',
                                ])
                                ->colors([
                                    'Pendapatan' => 'success', // Hijau
                                    'Belanja' => 'danger',     // Merah
                                ])
                                ->icons([
                                    'Pendapatan' => 'heroicon-o-arrow-trending-up',
                                    'Belanja' => 'heroicon-o-arrow-trending-down',
                                ])
                                ->inline()
                                ->required()
                                ->live() // Menghidupkan reaksi form otomatis ke bawah
                                ->columnSpanFull(),
                        ]),

                    // BAGIAN 2: KLASIFIKASI (Tersembunyi sampai "Jenis" dipilih)
                    Section::make(fn (Get $get) => $get('jenis') === 'Pendapatan' ? 'Detail Pos Pendapatan' : 'Detail Pos Belanja')
                        ->icon('heroicon-o-tag')
                        ->schema([
                            TextInput::make('tahun')
                                ->label('Tahun Anggaran')
                                ->numeric()
                                ->default(now()->year) // Otomatis tahun saat ini
                                ->required()
                                ->live() // Reaktif agar hint kode pos bisa ambil tahun yang benar
                                ->extraInputAttributes(['class' => 'font-bold text-lg']),

                            TextInput::make('kode_pos')
                                ->label('Nomor Kode Pos')
                                ->placeholder(fn (Get $get) => $get('jenis') === 'Pendapatan' ? 'Misal: 1.1' : 'Misal: 2.1.1')
                                ->required()
                                ->maxLength(20)
                                // FITUR CERDAS 1: Menampilkan kode terakhir yang digunakan
                                ->hint(function (Get $get) {
                                    $jenis = $get('jenis');
                                    $tahun = $get('tahun');
                                    if (!$jenis || !$tahun) return null;

                                    $lastAnggaran = Anggaran::where('jenis', $jenis)
                                        ->where('tahun', $tahun)
                                        ->orderBy('id', 'desc')
                                        ->first();

                                    if ($lastAnggaran) {
                                        return "Info: Pos terakhir dibuat adalah {$lastAnggaran->kode_pos} ({$lastAnggaran->nama_pos})";
                                    }

                                    return "Belum ada kode untuk " . $jenis;
                                })
                                ->hintIcon('heroicon-o-information-circle')
                                ->hintColor('info')
                                ->helperText('Lanjutkan penomoran dari info kode terakhir di atas.'),

                            TextInput::make('kelompok_pos')
                                ->label(fn (Get $get) => $get('jenis') === 'Pendapatan' ? 'Kelompok Pendapatan (Opsional)' : 'Kelompok Belanja (Opsional)')
                                ->placeholder(fn (Get $get) => $get('jenis') === 'Pendapatan' ? 'Misal: Pendapatan Rutin' : 'Misal: Insentif Karyawan')
                                // FITUR CERDAS 2: Menampilkan dropdown sugesti grup yang sudah ada
                                ->datalist(function (Get $get) {
                                    $jenis = $get('jenis');
                                    if (!$jenis) return [];

                                    return Anggaran::where('jenis', $jenis)
                                        ->whereNotNull('kelompok_pos')
                                        ->where('kelompok_pos', '!=', '')
                                        ->pluck('kelompok_pos')
                                        ->unique()
                                        ->toArray();
                                })
                                ->autocomplete(false)
                                ->helperText('Klik kolom ini 2x untuk memilih dari daftar kelompok yang sudah ada, atau ketik baru.')
                                ->columnSpanFull(),

                            TextInput::make('nama_pos')
                                ->label(fn (Get $get) => $get('jenis') === 'Pendapatan' ? 'Nama Sumber Pendapatan' : 'Nama Uraian Belanja')
                                ->placeholder(fn (Get $get) => $get('jenis') === 'Pendapatan' ? 'Misal: Kolekte Ibadah Raya' : 'Misal: Gaji, Listrik, atau ATK')
                                ->required()
                                ->columnSpanFull(),
                        ])->columns(2)
                        ->hidden(fn (Get $get) => ! $get('jenis')), // Sembunyikan jika belum pilih jenis
                ])->columnSpan(['lg' => 2]),

                // Kolom Kanan (Lebar 1/3) - Sidebar untuk Angka/Nominal
                Group::make()->schema([
                    Section::make('Batas & Target Anggaran')
                        ->icon('heroicon-o-banknotes')
                        ->description('Masukkan nilai target penerimaan atau pagu batas maksimal belanja.')
                        ->schema([
                            TextInput::make('target_per_bulan')
                                ->label(fn (Get $get) => $get('jenis') === 'Pendapatan' ? 'Target Per Bulan (Rp)' : 'Pagu Belanja Per Bulan (Rp)')
                                ->prefix('Rp')
                                ->mask(RawJs::make('$money($input)'))
                                ->stripCharacters(',') // Menghapus koma saat disimpan ke database
                                ->numeric()
                                ->live(onBlur: true)
                                // Jika per bulan diisi, maka nilai per tahun otomatis dikali 12
                                ->afterStateUpdated(function (?string $state, Set $set) {
                                    if ($state) {
                                        // Membersihkan format koma sebelum dikalikan
                                        $cleanState = (float) str_replace(',', '', $state);
                                        $set('target_per_tahun', number_format($cleanState * 12, 0, '.', ''));
                                    } else {
                                        $set('target_per_tahun', null);
                                    }
                                })
                                ->helperText('Opsional: Isi ini, dan kami akan menghitung total setahun otomatis.'),

                            TextInput::make('target_per_tahun')
                                ->label(fn (Get $get) => $get('jenis') === 'Pendapatan' ? 'Total Target Setahun (Rp)' : 'Total Batas Belanja Setahun (Rp)')
                                ->prefix('Rp')
                                ->mask(RawJs::make('$money($input)'))
                                ->stripCharacters(',')
                                ->numeric()
                                ->required()
                                ->extraInputAttributes(['class' => 'text-2xl font-extrabold text-primary-600']) // Membesarkan font angka secara signifikan
                                ->helperText('Angka mutlak yang menjadi pedoman Majelis selama satu tahun penuh.'),
                        ])
                        ->hidden(fn (Get $get) => ! $get('jenis')),
                ])->columnSpan(['lg' => 1]),
            ])
            ->columns(3); // Membagi form menjadi 3 porsi (2 untuk kiri, 1 untuk kanan)
    }
}