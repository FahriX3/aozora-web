<?php

namespace App\Filament\Inventaris\Resources\Loans\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LoanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Wizard::make([
                    \Filament\Schemas\Components\Wizard\Step::make('Data Peminjaman')
                        ->description('Detail barang dan peminjam')
                        ->schema([
                            \Filament\Forms\Components\Radio::make('borrower_type')
                                ->label('Tipe Peminjam')
                                ->options([
                                    'internal' => 'Internal (Pengurus/User Terdaftar)',
                                    'external' => 'Eksternal (Orang Luar)'
                                ])
                                ->default('internal')
                                ->inline()
                                ->live()
                                ->required(),
                            
                            \Filament\Forms\Components\Select::make('user_id')
                                ->relationship('user', 'name')
                                ->searchable()
                                ->preload()
                                ->label('Pilih Peminjam')
                                ->required(fn ($get) => $get('borrower_type') === 'internal')
                                ->hidden(fn ($get) => $get('borrower_type') === 'external'),
                                
                            \Filament\Forms\Components\TextInput::make('external_borrower_name')
                                ->label('Nama Lengkap Peminjam')
                                ->required(fn ($get) => $get('borrower_type') === 'external')
                                ->hidden(fn ($get) => $get('borrower_type') === 'internal'),
                                
                            \Filament\Forms\Components\TextInput::make('external_borrower_origin')
                                ->label('Asal / Instansi / Kelas (Bebas)')
                                ->hidden(fn ($get) => $get('borrower_type') === 'internal'),

                            \Filament\Forms\Components\Select::make('item_id')
                                ->relationship('item', 'name')
                                ->searchable()
                                ->preload()
                                ->label('Barang')
                                ->required(),
                            \Filament\Forms\Components\TextInput::make('quantity')
                                ->label('Jumlah')
                                ->required()
                                ->numeric()
                                ->default(1),
                            \Filament\Forms\Components\DateTimePicker::make('borrow_date')
                                ->label('Waktu Peminjaman')
                                ->default(now())
                                ->required(),
                        ]),
                        
                    \Filament\Schemas\Components\Wizard\Step::make('Bukti Pinjam')
                        ->description('Kondisi dan foto saat dipinjam')
                        ->schema([
                            \Filament\Forms\Components\Select::make('condition_when_borrowed')
                                ->label('Kondisi Saat Dipinjam')
                                ->options([
                                    'Sangat Baik' => 'Sangat Baik',
                                    'Baik' => 'Baik',
                                    'Kurang Baik' => 'Kurang Baik',
                                    'Rusak' => 'Rusak',
                                ])
                                ->default('Baik')
                                ->required(),
                            \Filament\Forms\Components\FileUpload::make('borrow_proof_image')
                                ->label('Foto Bukti Serah Terima')
                                ->image()
                                ->imageEditor()
                                ->directory('proofs')
                                ->required(),
                            \Filament\Forms\Components\Hidden::make('recorded_by_id')
                                ->default(fn () => auth()->id()),
                            \Filament\Forms\Components\Hidden::make('recorder_ip')
                                ->default(fn () => request()->ip()),
                            \Filament\Forms\Components\Hidden::make('recorder_location')
                                ->extraAttributes([
                                    'x-data' => '{}',
                                    'x-init' => '$nextTick(() => {
                                        if (navigator.geolocation) {
                                            navigator.geolocation.getCurrentPosition((pos) => {
                                                let loc = pos.coords.latitude + "," + pos.coords.longitude;
                                                $wire.set("data.recorder_location", loc);
                                            });
                                        }
                                    })'
                                ]),
                        ]),
                ])->columnSpanFull()
            ]);
    }
}
