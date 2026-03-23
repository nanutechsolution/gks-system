<?php

namespace App\Filament\Admin\Resources\Users;

use App\Enums\NavigationGroupEnum;
use App\Filament\Admin\Resources\Users\Pages\ManageUsers;
use App\Models\User;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use UnitEnum;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;
    protected static ?string $recordTitleAttribute = 'name';
    protected static ?string $navigationLabel = 'Manajemen Pengguna';
    protected static ?int $navigationSort = 1;
    protected static string | UnitEnum  | null $navigationGroup = NavigationGroupEnum::AksesKontrol->value;
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Informasi Akun')
                        ->description('Data dasar identitas pengguna untuk akses masuk ke sistem.')
                        ->icon('heroicon-o-user-circle')
                        ->schema([
                            TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->placeholder('Masukkan nama lengkap...')
                                ->required()
                                ->maxLength(255),

                            TextInput::make('email')
                                ->label('Alamat Email')
                                ->email()
                                ->placeholder('email@contoh.com')
                                ->required()
                                ->maxLength(255)
                                ->unique(ignoreRecord: true),
                        ])->columns(2),

                    Section::make('Keamanan & Akses')
                        ->description('Atur kata sandi dan hak akses peran (Role) pengguna.')
                        ->icon('heroicon-o-shield-check')
                        ->schema([
                            TextInput::make('password')
                                ->label('Kata Sandi')
                                ->password()
                                ->revealable()
                                ->dehydrateStateUsing(fn($state) => Hash::make($state))
                                ->dehydrated(fn($state) => filled($state))
                                ->required(fn(string $context): bool => $context === 'create')
                                ->maxLength(255)
                                ->placeholder(fn(string $context): string => $context === 'edit' ? 'Kosongkan jika tidak ingin mengubah' : 'Buat password minimal 8 karakter')
                                ->helperText('Pastikan password kuat dan aman.'),

                            Select::make('roles')
                                ->label('Peran (Role)')
                                ->relationship('roles', 'name')
                                ->multiple()
                                ->preload()
                                ->searchable()
                                ->placeholder('Pilih peran pengguna...')
                                ->helperText('Tentukan apa saja yang boleh diakses oleh pengguna ini.'),
                        ])->columns(2),
                ])->columnSpanFull(),
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Profil Pengguna')
                    ->icon('heroicon-o-user')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Lengkap')
                            ->weight('bold')
                            ->size('lg'),

                        TextEntry::make('email')
                            ->label('Alamat Email')
                            ->icon('heroicon-m-envelope')
                            ->copyable(),

                        TextEntry::make('roles.name')
                            ->label('Hak Akses / Peran')
                            ->badge()
                            ->color('info')
                            ->placeholder('Tidak ada peran'),
                    ])->columns(2),

                Section::make('Jejak Audit')
                    ->icon('heroicon-o-cpu-chip')
                    ->schema([
                        TextEntry::make('email_verified_at')
                            ->label('Email Diverifikasi')
                            ->dateTime()
                            ->placeholder('Belum diverifikasi'),

                        TextEntry::make('created_at')
                            ->label('Dibuat Pada')
                            ->dateTime()
                            ->color('gray'),

                        TextEntry::make('updated_at')
                            ->label('Terakhir Diperbarui')
                            ->dateTime()
                            ->color('gray'),
                    ])->columns(3)
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('roles.name')
                    ->label('Peran (Role)')
                    ->badge()
                    ->color('info')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    // LOGIKA PENGAMAN: Mencegah penghapusan admin utama atau diri sendiri
                    DeleteAction::make()
                        ->hidden(fn(User $record) => $record->id === 1 || $record->id === auth()->id()),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $records->filter(fn($record) => $record->id !== 1 && $record->id !== auth()->id())->each->delete();
                        }),
                ]),
            ])->emptyStateHeading('Tidak ada pengguna')
            ->emptyStateDescription('Silakan tambahkan pengguna baru untuk mengelola akses sistem.')
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageUsers::route('/'),
        ];
    }
}
