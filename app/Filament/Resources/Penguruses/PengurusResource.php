<?php

namespace App\Filament\Resources\Penguruses;

use App\Filament\Resources\Penguruses\Pages\CreatePengurus;
use App\Filament\Resources\Penguruses\Pages\EditPengurus;
use App\Filament\Resources\Penguruses\Pages\ListPenguruses;
use App\Filament\Resources\Penguruses\Schemas\PengurusForm;
use App\Filament\Resources\Penguruses\Tables\PengurusesTable;
use App\Models\Pengurus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PengurusResource extends Resource
{
    protected static ?string $model = Pengurus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen Konten';

    protected static ?string $navigationLabel = 'Data Pengurus';

    protected static ?string $modelLabel = 'Pengurus';

    protected static ?string $pluralModelLabel = 'Data Pengurus';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return PengurusForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengurusesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPenguruses::route('/'),
            'create' => CreatePengurus::route('/create'),
            'edit' => EditPengurus::route('/{record}/edit'),
        ];
    }
}
