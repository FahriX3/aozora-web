<?php

namespace App\Filament\Anggota\Resources\LaporKerusakan;

use App\Filament\Anggota\Resources\LaporKerusakan\Pages\CreateLaporKerusakan;
use App\Filament\Anggota\Resources\LaporKerusakan\Pages\ListLaporKerusakan;
use App\Filament\Anggota\Resources\LaporKerusakan\Pages\ViewLaporKerusakan;
use App\Filament\Anggota\Resources\LaporKerusakan\Schemas\LaporKerusakanForm;
use App\Filament\Anggota\Resources\LaporKerusakan\Tables\LaporKerusakanTable;
use App\Models\LaporanKerusakan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class LaporKerusakanResource extends Resource
{
    protected static ?string $model = LaporanKerusakan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;

    protected static string|UnitEnum|null $navigationGroup = 'Inventaris & Perlengkapan';

    protected static ?string $navigationLabel = 'Laporan Kerusakan Saya';

    protected static ?string $modelLabel = 'Laporan Kerusakan';

    protected static ?string $pluralModelLabel = 'Laporan Kerusakan';

    protected static ?int $navigationSort = 2;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('pelapor_user_id', auth()->id());
    }

    public static function form(Schema $schema): Schema
    {
        return LaporKerusakanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaporKerusakanTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLaporKerusakan::route('/'),
            'create' => CreateLaporKerusakan::route('/create'),
            'view' => ViewLaporKerusakan::route('/{record}'),
        ];
    }
}
