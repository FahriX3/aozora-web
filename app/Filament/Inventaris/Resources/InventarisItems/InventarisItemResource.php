<?php

namespace App\Filament\Inventaris\Resources\InventarisItems;

use App\Filament\Inventaris\Resources\InventarisItems\Pages\CreateInventarisItem;
use App\Filament\Inventaris\Resources\InventarisItems\Pages\EditInventarisItem;
use App\Filament\Inventaris\Resources\InventarisItems\Pages\ListInventarisItems;
use App\Filament\Inventaris\Resources\InventarisItems\Schemas\InventarisItemForm;
use App\Filament\Inventaris\Resources\InventarisItems\Tables\InventarisItemsTable;
use App\Models\InventarisItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class InventarisItemResource extends Resource
{
    protected static ?string $model = InventarisItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Inventaris';

    protected static ?string $navigationLabel = 'Data Barang';

    protected static ?string $modelLabel = 'Barang Inventaris';

    protected static ?string $pluralModelLabel = 'Data Barang';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'nama_barang';

    public static function form(Schema $schema): Schema
    {
        return InventarisItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InventarisItemsTable::configure($table);
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
            'index' => ListInventarisItems::route('/'),
            'create' => CreateInventarisItem::route('/create'),
            'edit' => EditInventarisItem::route('/{record}/edit'),
        ];
    }
}
