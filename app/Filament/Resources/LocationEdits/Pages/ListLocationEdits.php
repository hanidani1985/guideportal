<?php

namespace App\Filament\Resources\LocationEdits\Pages;

use App\Filament\Resources\LocationEdits\LocationEditResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLocationEdits extends ListRecords
{
    protected static string $resource = LocationEditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
