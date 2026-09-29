<?php

namespace App\Filament\Inventaris\Resources;

use App\Filament\Inventaris\Resources\ReturnResource\Pages;
use App\Models\Loan;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\Action;

class ReturnResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-path-rounded-square';
    
    protected static ?string $navigationLabel = 'Pengembalian';
    
    protected static ?string $pluralModelLabel = 'Pengembalian';

    public static function table(Table $table): Table
    {
        return $table
            ->query(Loan::query()->where('status', 'borrowed'))
            ->columns([
                ImageColumn::make('borrow_proof_image')
                    ->label('Bukti Pinjam')
                    ->circular(),
                TextColumn::make('borrower_name')
                    ->label('Peminjam')
                    ->getStateUsing(fn ($record) => $record->borrower_type === 'internal' ? $record->user?->name : $record->external_borrower_name . ' (Eksternal)')
                    ->searchable(['external_borrower_name']),
                TextColumn::make('item.name')
                    ->label('Barang'),
                TextColumn::make('quantity')
                    ->label('Jml')
                    ->numeric(),
                TextColumn::make('borrow_date')
                    ->label('Tgl Pinjam')
                    ->dateTime(),
            ])
            ->recordActions([
                Action::make('proses_kembali')
                    ->label('Kembalikan')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->form([
                        \Filament\Forms\Components\Select::make('status')
                            ->label('Status Pengembalian')
                            ->options([
                                'returned' => 'Sudah Dikembalikan (Normal)',
                                'late' => 'Terlambat',
                                'damaged' => 'Rusak',
                                'lost' => 'Hilang',
                            ])
                            ->default('returned')
                            ->required(),
                        \Filament\Forms\Components\DateTimePicker::make('return_date')
                            ->label('Waktu Pengembalian')
                            ->default(now())
                            ->required(),
                        \Filament\Forms\Components\Select::make('condition_when_returned')
                            ->label('Kondisi Saat Dikembalikan')
                            ->options([
                                'Sangat Baik' => 'Sangat Baik',
                                'Baik' => 'Baik',
                                'Kurang Baik' => 'Kurang Baik',
                                'Rusak' => 'Rusak',
                            ])
                            ->default('Baik')
                            ->required(),
                        \Filament\Forms\Components\FileUpload::make('return_proof_image')
                            ->label('Foto Bukti Pengembalian')
                            ->image()
                            ->imageEditor()
                            ->directory('proofs')
                            ->required(),
                        \Filament\Forms\Components\Hidden::make('return_recorded_by_id')
                            ->default(fn() => auth()->id()),
                        \Filament\Forms\Components\Hidden::make('return_recorder_ip')
                            ->default(fn() => request()->ip()),
                        \Filament\Forms\Components\Hidden::make('return_recorder_location')
                            ->extraAttributes([
                                'x-data' => '{}',
                                'x-init' => '$nextTick(() => {
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition((pos) => {
                                            $wire.set("mountedTableActionsData.0.return_recorder_location", pos.coords.latitude + "," + pos.coords.longitude);
                                        });
                                    }
                                })'
                            ]),
                    ])
                    ->action(function ($record, array $data): void {
                        $record->update($data);
                    }),
            ])
            ->emptyStateHeading('Tidak ada barang yang sedang dipinjam')
            ->emptyStateDescription('Semua barang aman terkendali.');
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Inventaris\Resources\ReturnResource\Pages\ListReturns::route('/'),
        ];
    }
}
