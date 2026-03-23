<?php

namespace App\Filament\Admin\Resources\Keuangans\Schemas;

use App\Models\Anggaran;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class KeuanganForm
{
    /**
     * Konfigurasi Form Keuangan.
     * Versi Super User-Friendly dengan Grouping Dropdown.
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    // BAGIAN 1: PEMILIHAN JENIS (Sangat Visual)
                    Section::make('Apa yang ingin Anda catat?')
                        ->description('Pilih salah satu tombol di bawah ini terlebih dahulu.')
                        ->schema([
                            ToggleButtons::make('jenis')
                                ->label('') // Label disembunyikan karena judul section sudah jelas
                                ->options([
                                    'Pemasukan' => 'Mencatat Uang Masuk',
                                    'Pengeluaran' => 'Mencatat Uang Keluar',
                                ])
                                ->colors([
                                    'Pemasukan' => 'success', // Tombol Hijau
                                    'Pengeluaran' => 'danger',  // Tombol Merah
                                ])
                                ->icons([
                                    'Pemasukan' => 'heroicon-o-arrow-down-on-square',
                                    'Pengeluaran' => 'heroicon-o-arrow-up-on-square',
                                ])
                                ->inline()
                                ->required()
                                ->live() // Memicu perubahan form di bawahnya secara instan
                                ->afterStateUpdated(fn (Set $set) => $set('kategori', null))
                                ->columnSpanFull(),
                        ]),

                    // BAGIAN 2: DETAIL TRANSAKSI (Label Dinamis Berdasarkan Pilihan di Atas)
                    Section::make(fn (Get $get) => $get('jenis') === 'Pengeluaran' ? 'Detail Uang Keluar' : 'Detail Uang Masuk')
                        ->icon('heroicon-o-banknotes')
                        ->schema([
                            Select::make('rekening_id')
                                // Label berubah sesuai konteks
                                ->label(fn (Get $get) => $get('jenis') === 'Pengeluaran' ? 'Ambil uang dari Kas mana?' : 'Simpan uang ke Kas mana?')
                                ->relationship('rekening', 'nama_kas')
                                ->required()
                                ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('nama_kas')->required()->label('Nama Kas (Misal: Kas Tunai Brankas)'),
                                ])
                                // Penjelasan tambahan
                                ->helperText(fn (Get $get) => $get('jenis') === 'Pengeluaran' ? 'Pilih laci/rekening yang uangnya akan berkurang.' : 'Pilih laci/rekening tempat uang ini akan disimpan.'),

                            Select::make('kategori')
                                // Label berubah sesuai konteks
                                ->label(fn (Get $get) => $get('jenis') === 'Pengeluaran' ? 'Untuk bayar apa? (Pos Belanja)' : 'Dari mana asalnya? (Pos Pendapatan)')
                                ->placeholder('Pilih Pos Anggaran...')
                                ->required()
                                ->searchable()
                                ->preload()
                                // Logika Grouping Berdasarkan Kelompok Pos
                                ->options(function (Get $get) {
                                    $jenis = $get('jenis');
                                    if (!$jenis) return [];

                                    $jenisAnggaran = ($jenis === 'Pemasukan') ? 'Pendapatan' : 'Belanja';

                                    // Ambil data anggaran diurutkan dari kode pos terkecil ke terbesar
                                    $anggarans = Anggaran::query()
                                        ->where('jenis', $jenisAnggaran)
                                        ->orderBy('kode_pos')
                                        ->get();

                                    $options = [];
                                    foreach ($anggarans as $anggaran) {
                                        // Jika tidak ada kelompok_pos, masukkan ke grup default
                                        $namaKelompok = $anggaran->kelompok_pos ?: 'Daftar Pos ' . $jenisAnggaran;
                                        
                                        // Format: $options['Nama Grup']['Value'] = 'Label'
                                        $options[$namaKelompok][$anggaran->nama_pos] = "{$anggaran->kode_pos} - {$anggaran->nama_pos}";
                                    }

                                    return $options;
                                })
                                ->helperText('Pilih Pos Anggaran yang tepat agar laporan akhir tahun bisa tersusun otomatis.'),

                            TextInput::make('nominal')
                                ->label('Jumlah Uang (Rp)')
                                ->required()
                                ->numeric()
                                ->prefix('Rp')
                                ->placeholder('Contoh: 1500000')
                                ->maxValue(999999999999)
                                ->columnSpanFull(),
                        ])->columns(2)
                        // Section ini disembunyikan jika user belum memilih jenis transaksi
                        ->hidden(fn (Get $get) => ! $get('jenis')),

                    // BAGIAN 3: CATATAN
                    Section::make('Keterangan & Referensi')
                        ->schema([
                            TextInput::make('referensi')
                                ->label('Nomor Referensi / Kwitansi (Opsional)')
                                ->placeholder('Kosongkan jika tidak ada nomor seri')
                                ->maxLength(255),

                            Textarea::make('keterangan')
                                ->label('Catatan Tambahan (Uraian)')
                                ->placeholder('Tuliskan rinciannya di sini. Misal: Kolekte Ibadah Pemuda, atau Beli Lampu 2 buah...')
                                ->rows(3),
                        ])->columns(1)
                        ->hidden(fn (Get $get) => ! $get('jenis')),

                ])->columnSpan(['lg' => 2]),

                // BAGIAN 4: SIDEBAR KANAN (Waktu & Bukti)
                Group::make()->schema([
                    Section::make('Waktu & Bukti Digital')
                        ->icon('heroicon-o-document-check')
                        ->schema([
                            DatePicker::make('tanggal')
                                ->label('Tanggal Transaksi')
                                ->required()
                                ->default(now())
                                ->native(false)
                                ->displayFormat('d F Y'),

                            FileUpload::make('bukti_transaksi')
                                ->label('Upload Bukti (Foto/Struk)')
                                ->image()
                                ->imageEditor()
                                ->directory('bukti-transaksi')
                                ->maxSize(5120) // Maksimal 5MB
                                ->helperText('Foto nota, kwitansi fisik, atau screenshot bukti transfer bank.'),
                        ]),
                ])->columnSpan(['lg' => 1])
                ->hidden(fn (Get $get) => ! $get('jenis')),
            ])
            ->columns(3);
    }
}