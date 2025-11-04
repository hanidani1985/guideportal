<?php

namespace App\Filament\Resources\LocationEdits;

use App\Filament\Resources\LocationEdits\Pages\CreateLocationEdit;
use App\Filament\Resources\LocationEdits\Pages\EditLocationEdit;
use App\Filament\Resources\LocationEdits\Pages\ListLocationEdits;
use App\Filament\Resources\LocationEdits\Schemas\LocationEditForm;
use App\Filament\Resources\LocationEdits\Tables\LocationEditsTable;
use App\Models\LocationEdit;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LocationEditResource extends Resource
{
    protected static ?string $model = LocationEdit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LocationEditForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LocationEditsTable::configure($table);
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
            'index' => ListLocationEdits::route('/'),
            'create' => CreateLocationEdit::route('/create'),
            'edit' => EditLocationEdit::route('/{record}/edit'),
        ];
    }
}
