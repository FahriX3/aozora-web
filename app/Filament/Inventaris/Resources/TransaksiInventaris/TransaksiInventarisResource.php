<?php

namespace App\Filament\Inventaris\Resources\TransaksiInventaris;

use App\Filament\Inventaris\Resources\TransaksiInventaris\Pages\CreateTransaksiInventaris;
use App\Filament\Inventaris\Resources\TransaksiInventaris\Pages\EditTransaksiInventaris;
use App\Filament\Inventaris\Resources\TransaksiInventaris\Pages\ListTransaksiInventaris;
use App\Filament\Inventaris\Resources\TransaksiInventaris\Schemas\TransaksiInventarisForm;
use App\Filament\Inventaris\Resources\TransaksiInventaris\Tables\TransaksiInventarisTable;
use App\Models\TransaksiInventaris;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TransaksiInventarisResource extends Resource
{
    protected static ?string $model = TransaksiInventaris::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArrowsRightLeft;

    protected static string|UnitEnum|null $navigationGroup = 'Logistik & Inventaris';

    protected static ?string $navigationLabel = 'Mutasi & Peminjaman';

    protected static ?string $modelLabel = 'Transaksi Inventaris';

    protected static ?string $pluralModelLabel = 'Mutasi Barang';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return TransaksiInventarisForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TransaksiInventarisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTransaksiInventaris::route('/'),
            'create' => CreateTransaksiInventaris::route('/create'),
            'edit' => EditTransaksiInventaris::route('/{record}/edit'),
        ];
    }
}
