<?php

namespace App\Filament\Resources\Penguruses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PengurusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pengurus')
                    ->description('Kelola detail identitas dan posisi pengurus organisasi.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('nama')
                                ->label('Nama Lengkap')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('kelas')
                                ->label('Kelas')
                                ->required()
                                ->maxLength(50),
                        ]),
                        Grid::make(2)->schema([
                            TextInput::make('jabatan')
                                ->label('Jabatan')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('sub_jabatan')
                                ->label('Sub Jabatan')
                                ->maxLength(255),
                        ]),
                        Grid::make(2)->schema([
                            Select::make('divisi')
                                ->label('Divisi')
                                ->options([
                                    'Pengurus Inti' => 'Pengurus Inti',
                                    'Pemateri' => 'Pemateri',
                                    'Kegiatan' => 'Kegiatan',
                                    'Budaya Bahasa' => 'Budaya Bahasa',
                                    'PDD' => 'PDD',
                                    'Mediakom' => 'Mediakom',
                                    'Perkap' => 'Perkap',
                                ])
                                ->required(),
                            TextInput::make('urutan')
                                ->label('Urutan Tampilan')
                                ->numeric()
                                ->default(0),
                        ]),
                        FileUpload::make('avatar')
                            ->label('Foto Profil')
                            ->image()
                            ->directory('pengurus-avatars')
                            ->disk('public')
                            ->visibility('public'),
                    ]),
            ]);
    }
}
