<?php

namespace App\Filament\Resources\LocationImages;

use App\Filament\Resources\LocationImages\Pages\CreateLocationImage;
use App\Filament\Resources\LocationImages\Pages\EditLocationImage;
use App\Filament\Resources\LocationImages\Pages\ListLocationImages;
use App\Filament\Resources\LocationImages\Schemas\LocationImageForm;
use App\Filament\Resources\LocationImages\Tables\LocationImagesTable;
use App\Models\LocationImage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LocationImageResource extends Resource
{
    protected static ?string $model = LocationImage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return LocationImageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LocationImagesTable::configure($table);
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
            'index' => ListLocationImages::route('/'),
            'create' => CreateLocationImage::route('/create'),
            'edit' => EditLocationImage::route('/{record}/edit'),
        ];
    }
}
