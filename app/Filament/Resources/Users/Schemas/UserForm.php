<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Akun')
                    ->description('Detail login dan identitas akun pengguna')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('name')
                                ->label('Nama Lengkap')
                                ->placeholder('Contoh: Tegar Satrio Utomo')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->label('Alamat Email')
                                ->placeholder('nama@aozora.local')
                                ->email()
                                ->required()
                                ->unique('users', 'email', ignoreRecord: true)
                                ->maxLength(255),
                        ]),
                        TextInput::make('password')
                            ->label('Kata Sandi')
                            ->password()
                            ->revealable()
                            ->placeholder('Minimal 8 karakter')
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->helperText('Kosongkan jika tidak ingin mengubah kata sandi saat mengedit akun.'),
                    ]),

                Section::make('Hak Akses & Peran')
                    ->description('Tentukan role akun untuk membatasi akses modul dan panel')
                    ->schema([
                        Select::make('roles')
                            ->label('Peran (Role)')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->helperText('Pilih satu atau lebih role: super_admin, admin, koordinator_inventaris, atau anggota.')
                            ->required(),
                    ]),
            ]);
    }
}
