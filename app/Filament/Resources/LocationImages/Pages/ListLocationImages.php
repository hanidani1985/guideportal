<?php

namespace App\Filament\Resources\LocationImages\Pages;

use App\Filament\Resources\LocationImages\LocationImageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLocationImages extends ListRecords
{
    protected static string $resource = LocationImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
