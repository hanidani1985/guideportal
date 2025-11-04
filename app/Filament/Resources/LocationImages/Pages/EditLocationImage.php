<?php

namespace App\Filament\Resources\LocationImages\Pages;

use App\Filament\Resources\LocationImages\LocationImageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLocationImage extends EditRecord
{
    protected static string $resource = LocationImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
