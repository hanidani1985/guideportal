<?php

namespace App\Filament\Resources\LocationEdits\Pages;

use App\Filament\Resources\LocationEdits\LocationEditResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLocationEdit extends EditRecord
{
    protected static string $resource = LocationEditResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
