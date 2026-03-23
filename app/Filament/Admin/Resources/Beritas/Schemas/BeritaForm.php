<?php

namespace App\Filament\Admin\Resources\Beritas\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BeritaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(fn() => auth()->id()),
                Group::make()
                    ->schema([
                        Section::make('Konten Utama')
                            ->schema([
                                TextInput::make('judul')
                                    ->label('Judul Berita/Pengumuman')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true) // Generate slug otomatis saat user selesai mengetik judul
                                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                TextInput::make('slug')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(ignoreRecord: true)
                                    ->disabled() // Slug tidak perlu diedit manual
                                    ->dehydrated(), // Tetap kirim data ke database meskipun disabled

                                Textarea::make('ringkasan')
                                    ->label('Ringkasan Singkat')
                                    ->rows(3)
                                    ->columnSpanFull()
                                    ->helperText('Ditampilkan di halaman depan website sebelum pengunjung mengklik baca selengkapnya.'),

                                RichEditor::make('konten')
                                    ->label('Isi Konten')
                                    ->required()
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        'blockquote',
                                        'bold',
                                        'bulletList',
                                        'h2',
                                        'h3',
                                        'italic',
                                        'link',
                                        'orderedList',
                                        'redo',
                                        'strike',
                                        'underline',
                                        'undo',
                                    ]),
                            ])->columns(2),
                    ])->columnSpan(['lg' => 2]), // Membuat kolom kiri lebih lebar

                Group::make()
                    ->schema([
                        Section::make('Media & Status')
                            ->schema([
                                FileUpload::make('gambar_sampul')
                                    ->label('Gambar Sampul')
                                    ->image()
                                    ->directory('berita-images')
                                    ->maxSize(2048) // Maksimal 2MB
                                    ->columnSpanFull(),

                                DatePicker::make('tanggal_publish')
                                    ->label('Tanggal Publish')
                                    ->default(now())
                                    ->required()
                                    ->native(false),

                                Toggle::make('is_published')
                                    ->label('Publikasikan?')
                                    ->default(true)
                                    ->helperText('Matikan jika artikel ini masih berupa draft.'),
                            ]),
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }
}
