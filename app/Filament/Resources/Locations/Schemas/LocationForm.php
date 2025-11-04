<?php

namespace App\Filament\Resources\Locations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class LocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(auth()->id()),
                
                Section::make('Basic Information')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        
                        Textarea::make('short_description')
                            ->required()
                            ->maxLength(500)
                            ->rows(3)
                            ->columnSpanFull()
                            ->hint('Brief description for listings'),
                        
                        Textarea::make('long_description')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull()
                            ->hint('Detailed description for the location page'),
                    ])
                    ->columns(2),

                Section::make('Location & Coordinates')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('latitude')
                                    ->required()
                                    ->numeric()
                                    ->step(0.00000001)
                                    ->minValue(-90)
                                    ->maxValue(90)
                                    ->hint('Decimal degrees'),
                                
                                TextInput::make('longitude')
                                    ->required()
                                    ->numeric()
                                    ->step(0.00000001)
                                    ->minValue(-180)
                                    ->maxValue(180)
                                    ->hint('Decimal degrees'),
                            ]),
                    ]),

                Section::make('Pricing')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('entry_price')
                                    ->numeric()
                                    ->step(0.01)
                                    ->prefix('$')
                                    ->hint('Leave empty if free'),
                                
                                TextInput::make('currency')
                                    ->default('USD')
                                    ->maxLength(10),
                            ]),
                    ]),

                Section::make('Best Times to Visit')
                    ->schema([
                        TextInput::make('best_time_year')
                            ->maxLength(255)
                            ->hint('e.g., "March to September" or "All year"')
                            ->columnSpanFull(),
                        
                        TextInput::make('best_hours')
                            ->maxLength(255)
                            ->hint('e.g., "6AM-10AM" or "Sunset time"')
                            ->columnSpanFull(),
                        
                        TextInput::make('best_tide_level')
                            ->maxLength(255)
                            ->hint('e.g., "Low tide", "High tide", or leave empty if not applicable')
                            ->columnSpanFull(),
                    ]),

                Section::make('Suitable Vehicles')
                    ->schema([
                        CheckboxList::make('suitable_vehicles')
                            ->options([
                                'bike' => 'Bike / Bicycle',
                                'motorcycle' => 'Motorcycle',
                                'car' => 'Car / Sedan',
                                'suv' => 'SUV',
                                'offroader' => 'Off-roader / 4x4',
                                'bus' => 'Bus / Large vehicle',
                                'walk' => 'Walking only',
                            ])
                            ->columns(2)
                            ->hint('Select all that apply'),
                    ]),

                Section::make('Approval Status')
                    ->schema([
                        Toggle::make('is_approved')
                            ->label('Approved for public viewing')
                            ->helperText('Only admins should approve locations')
                            ->disabled(fn () => !auth()->user()->isAdmin()),
                    ])
                    ->visible(fn ($record) => auth()->user()->isAdmin() || $record !== null),
            ]);
    }
}
