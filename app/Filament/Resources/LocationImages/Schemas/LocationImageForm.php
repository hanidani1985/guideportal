<?php

namespace App\Filament\Resources\LocationImages\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Schemas\Schema;
use App\Models\Location;

class LocationImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(auth()->id()),
                
                Section::make('Image Details')
                    ->schema([
                        Select::make('location_id')
                            ->label('Location')
                            ->required()
                            ->relationship('location', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                // Quick location creation can be added later
                            ]),
                        
                        FileUpload::make('image_path')
                            ->label('Image')
                            ->image()
                            ->required()
                            ->directory('location-images')
                            ->imageEditor()
                            ->maxSize(5120) // 5MB
                            ->columnSpanFull(),
                        
                        TextInput::make('caption')
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->hint('Optional description of the image'),
                        
                        Toggle::make('is_approved')
                            ->label('Approved')
                            ->helperText('Only admins should approve images')
                            ->disabled(fn () => !auth()->user()->isAdmin())
                            ->visible(fn ($record) => auth()->user()->isAdmin() || $record !== null),
                    ]),
            ]);
    }
}
