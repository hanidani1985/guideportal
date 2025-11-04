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
use Illuminate\Database\Eloquent\Builder;

class LocationEditResource extends Resource
{
    protected static ?string $model = LocationEdit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Edit Requests';

    protected static ?string $modelLabel = 'Edit Request';

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

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Tour guides can only see their own edit requests
        if (auth()->user() && !auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        return $query;
    }
}
