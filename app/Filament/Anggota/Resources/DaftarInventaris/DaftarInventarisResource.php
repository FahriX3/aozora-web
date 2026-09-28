<?php

namespace App\Filament\Anggota\Resources\DaftarInventaris;

use App\Filament\Anggota\Resources\DaftarInventaris\Pages\ListDaftarInventaris;
use App\Filament\Anggota\Resources\DaftarInventaris\Pages\ViewDaftarInventaris;
use App\Filament\Anggota\Resources\DaftarInventaris\Schemas\DaftarInventarisForm;
use App\Filament\Anggota\Resources\DaftarInventaris\Tables\DaftarInventarisTable;
use App\Models\InventarisItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class DaftarInventarisResource extends Resource
{
    protected static ?string $model = InventarisItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static string|UnitEnum|null $navigationGroup = 'Inventaris & Perlengkapan';

    protected static ?string $navigationLabel = 'Katalog Inventaris';

    protected static ?string $modelLabel = 'Barang Inventaris';

    protected static ?string $pluralModelLabel = 'Katalog Inventaris';

    protected static ?int $navigationSort = 1;

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function form(Schema $schema): Schema
    {
        return DaftarInventarisForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DaftarInventarisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDaftarInventaris::route('/'),
            'view' => ViewDaftarInventaris::route('/{record}'),
        ];
    }
}
