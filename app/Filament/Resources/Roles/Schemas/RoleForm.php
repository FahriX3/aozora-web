<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detail Role / Peran')
                    ->description('Konfigurasi nama role dan hak akses (permissions) yang dimiliki')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Role')
                            ->placeholder('contoh: moderator_event')
                            ->required()
                            ->unique('roles', 'name', ignoreRecord: true)
                            ->maxLength(255),
                        Select::make('permissions')
                            ->label('Daftar Hak Akses (Permissions)')
                            ->relationship('permissions', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->helperText('Pilih izin spesifik yang diberikan kepada role ini.'),
                    ]),
            ]);
    }
}
