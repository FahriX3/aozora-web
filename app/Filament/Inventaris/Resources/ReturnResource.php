<?php

namespace App\Filament\Inventaris\Resources;

use App\Filament\Inventaris\Resources\ReturnResource\Pages;
use App\Models\Loan;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\Action;

class ReturnResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    protected static string|\UnitEnum|null $navigationGroup = 'Manajemen Inventaris';

    protected static ?string $navigationLabel = 'Pengembalian Barang';

    protected static ?string $pluralModelLabel = 'Pengembalian Barang';

    protected static ?string $modelLabel = 'Pengembalian';

    protected static ?int $navigationSort = 3;

    public static function table(Table $table): Table
    {
        return $table
            ->query(Loan::query()->where('status', 'borrowed'))
            ->columns([
                ImageColumn::make('borrow_proof_image')
                    ->label('Bukti Pinjam')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('borrower_name')
                    ->label('Peminjam')
                    ->getStateUsing(fn ($record) => $record->borrower_type === 'internal' ? $record->user?->name : $record->external_borrower_name . ' (Eksternal)')
                    ->searchable(['external_borrower_name']),
                TextColumn::make('inventarisItem.nama_barang')
                    ->label('Barang'),
                TextColumn::make('quantity')
                    ->label('Jml Dipinjam')
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
                                'returned' => 'Sudah Dikembalikan',
                                'late' => 'Terlambat',
                            ])
                            ->default('returned')
                            ->required(),

                        \Filament\Forms\Components\TextInput::make('returned_quantity_damaged')
                            ->label('Jml Kembali Rusak')
                            ->numeric()
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($set, $get, $record, $state) {
                                $damaged = (int) $state;
                                $lost = (int) $get('returned_quantity_lost');
                                $normal = $record->quantity - $damaged - $lost;
                                if ($normal < 0) {
                                    $normal = 0;
                                }
                                $set('returned_quantity_normal', $normal);
                            })
                            ->required(),

                        \Filament\Forms\Components\TextInput::make('returned_quantity_lost')
                            ->label('Jml Hilang')
                            ->numeric()
                            ->default(0)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($set, $get, $record, $state) {
                                $lost = (int) $state;
                                $damaged = (int) $get('returned_quantity_damaged');
                                $normal = $record->quantity - $damaged - $lost;
                                if ($normal < 0) {
                                    $normal = 0;
                                }
                                $set('returned_quantity_normal', $normal);
                            })
                            ->required(),

                        \Filament\Forms\Components\TextInput::make('returned_quantity_normal')
                            ->label('Jml Kembali Normal')
                            ->numeric()
                            ->default(fn ($record) => $record->quantity)
                            ->readOnly()
                            ->required()
                            ->rules([
                                fn ($get, $record) => function (string $attribute, $value, \Closure $fail) use ($get, $record) {
                                    $total = (int) $value + (int) $get('returned_quantity_damaged') + (int) $get('returned_quantity_lost');
                                    if ($total !== $record->quantity) {
                                        $fail("Total keseluruhan (Normal + Rusak + Hilang) harus sama dengan jumlah yang dipinjam ({$record->quantity} unit).");
                                    }
                                },
                            ]),

                        \Filament\Forms\Components\Textarea::make('return_notes')
                            ->label('Catatan & Deskripsi Kerusakan')
                            ->helperText('Wajib diisi jika ada barang rusak atau hilang.')
                            ->required(fn ($get) => (int) $get('returned_quantity_damaged') > 0 || (int) $get('returned_quantity_lost') > 0),

                        \Filament\Forms\Components\DateTimePicker::make('return_date')
                            ->label('Waktu Pengembalian')
                            ->default(now())
                            ->required(),

                        \Filament\Forms\Components\FileUpload::make('return_proof_image')
                            ->label('Foto Bukti Pengembalian & Kondisi Barang')
                            ->image()
                            ->imageEditor()
                            ->directory('proofs')
                            ->disk('public')
                            ->visibility('public')
                            ->required(),

                        \Filament\Forms\Components\Hidden::make('return_recorded_by_id')
                            ->default(fn () => auth()->id()),
                        \Filament\Forms\Components\Hidden::make('return_recorder_ip')
                            ->default(fn () => request()->ip()),
                        \Filament\Forms\Components\Hidden::make('return_recorder_location')
                            ->extraAttributes([
                                'x-data' => '{}',
                                'x-init' => '$nextTick(() => {
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition((pos) => {
                                            $wire.set("mountedTableActionsData.0.return_recorder_location", pos.coords.latitude + "," + pos.coords.longitude);
                                        });
                                    }
                                })',
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
