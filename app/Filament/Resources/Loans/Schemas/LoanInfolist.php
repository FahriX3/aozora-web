<?php

namespace App\Filament\Resources\Loans\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Schema;

class LoanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(['default' => 1, 'md' => 3])
                    ->columnSpanFull()
                    ->schema([
                    Group::make()->schema([
                        Section::make('Informasi Peminjam')
                            ->schema([
                                TextEntry::make('borrower_type')
                                    ->badge()
                                    ->label('Tipe Peminjam'),
                                TextEntry::make('user.name')
                                    ->label('Peminjam Internal')
                                    ->placeholder('-')
                                    ->visible(fn ($record) => $record->borrower_type === 'internal'),
                                TextEntry::make('external_borrower_name')
                                    ->label('Nama (Eksternal)')
                                    ->placeholder('-')
                                    ->visible(fn ($record) => $record->borrower_type === 'external'),
                                TextEntry::make('external_borrower_origin')
                                    ->label('Asal (Eksternal)')
                                    ->placeholder('-')
                                    ->visible(fn ($record) => $record->borrower_type === 'external'),
                            ])->columns(2),

                        Section::make('Informasi Barang')
                            ->schema([
                                TextEntry::make('item.name')
                                    ->label('Nama Barang')
                                    ->weight('bold'),
                                TextEntry::make('quantity')
                                    ->label('Jumlah Pinjam')
                                    ->numeric(),
                                TextEntry::make('status')
                                    ->badge()
                                    ->color(fn (string $state): string => match ($state) {
                                        'dipinjam' => 'warning',
                                        'dikembalikan' => 'success',
                                        'hilang' => 'danger',
                                        'rusak' => 'danger',
                                        default => 'gray',
                                    }),
                            ])->columns(3),

                        Section::make('Catatan Peminjaman')
                            ->schema([
                                TextEntry::make('borrow_date')
                                    ->label('Tanggal Pinjam')
                                    ->date(),
                                TextEntry::make('condition_when_borrowed')
                                    ->label('Kondisi Saat Dipinjam'),
                                ImageEntry::make('borrow_proof_image')
                                    ->label('Bukti Peminjaman')
                                    ->columnSpanFull(),
                            ])->columns(2),

                        Section::make('Catatan Pengembalian')
                            ->schema([
                                TextEntry::make('return_date')
                                    ->label('Tanggal Kembali')
                                    ->date()
                                    ->placeholder('Belum dikembalikan'),
                                TextEntry::make('condition_when_returned')
                                    ->label('Kondisi Saat Dikembalikan')
                                    ->placeholder('-'),
                                ImageEntry::make('return_proof_image')
                                    ->label('Bukti Pengembalian')
                                    ->columnSpanFull()
                                    ->placeholder('Belum ada bukti'),
                            ])->columns(2),
                    ])->columnSpan(['default' => 1, 'md' => 2]),

                    Group::make()->schema([
                        Section::make('Tracking Pencatat Peminjaman')
                            ->schema([
                                TextEntry::make('recordedBy.name')
                                    ->label('Dicatat Oleh')
                                    ->icon('heroicon-m-user'),
                                TextEntry::make('recorder_ip')
                                    ->label('IP Address')
                                    ->icon('heroicon-m-globe-alt')
                                    ->copyable(),
                                TextEntry::make('recorder_location')
                                    ->label('GPS Location')
                                    ->icon('heroicon-m-map-pin')
                                    ->copyable()
                                    ->url(fn ($record) => $record->recorder_location ? 'https://maps.google.com/?q=' . $record->recorder_location : null)
                                    ->openUrlInNewTab(),
                            ]),

                        Section::make('Tracking Pencatat Pengembalian')
                            ->schema([
                                TextEntry::make('returnRecordedBy.name')
                                    ->label('Dikembalikan Oleh')
                                    ->icon('heroicon-m-user')
                                    ->placeholder('-'),
                                TextEntry::make('return_recorder_ip')
                                    ->label('IP Address')
                                    ->icon('heroicon-m-globe-alt')
                                    ->placeholder('-')
                                    ->copyable(),
                                TextEntry::make('return_recorder_location')
                                    ->label('GPS Location')
                                    ->icon('heroicon-m-map-pin')
                                    ->placeholder('-')
                                    ->copyable()
                                    ->url(fn ($record) => $record->return_recorder_location ? 'https://maps.google.com/?q=' . $record->return_recorder_location : null)
                                    ->openUrlInNewTab(),
                            ])
                            ->visible(fn ($record) => $record->status !== 'dipinjam'),
                    ])->columnSpan(['default' => 1, 'md' => 1]),
                ]),
            ]);
    }
}
