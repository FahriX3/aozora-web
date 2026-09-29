<?php

namespace App\Filament\Inventaris\Resources\LaporanKerusakan;

use App\Filament\Inventaris\Resources\LaporanKerusakan\Pages\CreateLaporanKerusakan;
use App\Filament\Inventaris\Resources\LaporanKerusakan\Pages\EditLaporanKerusakan;
use App\Filament\Inventaris\Resources\LaporanKerusakan\Pages\ListLaporanKerusakan;
use App\Filament\Inventaris\Resources\LaporanKerusakan\Schemas\LaporanKerusakanForm;
use App\Filament\Inventaris\Resources\LaporanKerusakan\Tables\LaporanKerusakanTable;
use App\Models\LaporanKerusakan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class LaporanKerusakanResource extends Resource
{
    protected static ?string $model = LaporanKerusakan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;

    protected static string|UnitEnum|null $navigationGroup = 'Logistik & Inventaris';

    protected static ?string $navigationLabel = 'Laporan Kerusakan';

    protected static ?string $modelLabel = 'Laporan Kerusakan';

    protected static ?string $pluralModelLabel = 'Laporan Kerusakan';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'pending')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Schema $schema): Schema
    {
        return LaporanKerusakanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporanKerusakanTable::configure($table);
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
            'index' => ListLaporanKerusakan::route('/'),
            'create' => CreateLaporanKerusakan::route('/create'),
            'edit' => EditLaporanKerusakan::route('/{record}/edit'),
        ];
    }
}
