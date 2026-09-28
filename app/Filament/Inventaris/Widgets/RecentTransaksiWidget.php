<?php

namespace App\Filament\Inventaris\Widgets;

use App\Models\TransaksiInventaris;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentTransaksiWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'Aktivitas Transaksi Barang Terakhir';

    public function table(Table $table): Table
    {
        return $table
            ->query(TransaksiInventaris::query()->with(['inventarisItem', 'user'])->latest('tanggal')->latest('id')->limit(5))
            ->columns([
                TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),
                TextColumn::make('inventarisItem.nama_barang')
                    ->label('Nama Barang')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('tipe')
                    ->label('Jenis Mutasi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'masuk' => 'success',
                        'keluar' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'masuk' => '📥 Masuk / Kembali',
                        'keluar' => '📤 Keluar / Dipinjam',
                        default => $state,
                    }),
                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->suffix(' unit')
                    ->alignCenter(),
                TextColumn::make('user.name')
                    ->label('Pelaksana / Peminjam'),
                TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->limit(40),
            ])
            ->paginated(false);
    }
}
