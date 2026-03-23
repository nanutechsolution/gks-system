<?php

namespace App\Filament\Admin\Resources\Keluargas\RelationManagers;

use App\Models\Jemaat;
use Closure;
use Filament\Actions\ActionGroup;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get as UtilitiesGet;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AnggotaRelationManager extends RelationManager
{
    protected static string $relationship = 'anggota';

    /**
     * Form untuk menambah anggota baru langsung di dalam keluarga.
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                Select::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ])
                    ->required(),

                Select::make('hubungan_keluarga')
                    ->label('Hubungan Keluarga')
                    ->options([
                        'Kepala Keluarga' => 'Kepala Keluarga',
                        'Istri' => 'Istri',
                        'Anak' => 'Anak',
                        'Famili Lain' => 'Famili Lain',
                    ])
                    ->required()
                    ->rules([
                        // VALIDASI: Mencegah Kepala Keluarga Ganda
                        // Kita bungkus dalam fn(Get $get) agar Filament bisa mengevaluasi dengan benar
                        fn(UtilitiesGet $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                            if ($value !== 'Kepala Keluarga') {
                                return;
                            }

                            $exists = Jemaat::where('keluarga_id', $this->getOwnerRecord()->getKey())
                                ->where('hubungan_keluarga', 'Kepala Keluarga')
                                ->when($get('id'), fn($query, $id) => $query->where('id', '!=', $id))
                                ->exists();

                            if ($exists) {
                                $fail("Keluarga ini sudah memiliki seorang Kepala Keluarga. Mohon periksa kembali.");
                            }
                        },
                    ]),

                Select::make('status_anggota')
                    ->label('Status Anggota')
                    ->options([
                        'Aktif' => 'Aktif',
                        'Pindah' => 'Pindah',
                        'Meninggal' => 'Meninggal',
                    ])
                    ->default('Aktif')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_lengkap')
            ->columns([
                TextColumn::make('nama_lengkap')
                    ->label('Nama Anggota')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('hubungan_keluarga')
                    ->label('Hubungan')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Kepala Keluarga' => 'primary',
                        'Istri' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('jenis_kelamin')
                    ->label("L/P")
                    ->formatStateUsing(fn($state) => $state === 'Laki-laki' ? 'L' : 'P'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Anggota Baru'),

                // Aksi untuk menghubungkan jemaat yang sudah ada ke keluarga ini
                AssociateAction::make()
                    ->label('Hubungkan Jemaat')
                    ->preloadRecordSelect()
                    ->multiple()
                    ->form(fn(AssociateAction $action): array => [
                        $action->getRecordSelect(), // Pencarian Jemaat
                        Select::make('hubungan_keluarga')
                            ->options([
                                'Kepala Keluarga' => 'Kepala Keluarga',
                                'Istri' => 'Istri',
                                'Anak' => 'Anak',
                                'Famili Lain' => 'Famili Lain',
                            ])
                            ->required()
                            ->rules([
                                // PERBAIKAN: Dibungkus dengan fn() => agar $attribute bisa di-resolve saat validasi dijalankan
                                fn(): Closure => function (string $attribute, $value, Closure $fail) {
                                    if ($value !== 'Kepala Keluarga') {
                                        return;
                                    }

                                    $exists = Jemaat::where('keluarga_id', $this->getOwnerRecord()->getKey())
                                        ->where('hubungan_keluarga', 'Kepala Keluarga')
                                        ->exists();

                                    if ($exists) {
                                        $fail("Gagal menghubungkan: Keluarga ini sudah memiliki Kepala Keluarga.");
                                    }
                                },
                            ]),
                    ])
                    ->action(function (array $data, AssociateAction $action): void {
                        $recordIds = (array) ($data['recordId'] ?? []);

                        foreach ($recordIds as $id) {
                            $jemaat = Jemaat::find($id);
                            if ($jemaat) {
                                $jemaat->update([
                                    'keluarga_id' => $this->getOwnerRecord()->getKey(),
                                    'hubungan_keluarga' => $data['hubungan_keluarga'],
                                ]);
                            }
                        }

                        $action->success();
                    }),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    DissociateAction::make()
                        ->label('Keluarkan dari Keluarga'),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
