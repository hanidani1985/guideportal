<?php

namespace App\Filament\Resources\LocationEdits\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\KeyValue;
use Filament\Schemas\Schema;

class LocationEditForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(auth()->id()),
                
                Section::make('Edit Request Details')
                    ->schema([
                        Select::make('location_id')
                            ->label('Location')
                            ->required()
                            ->relationship('location', 'name')
                            ->searchable()
                            ->preload(),
                        
                        KeyValue::make('proposed_changes')
                            ->label('Proposed Changes')
                            ->required()
                            ->keyLabel('Field')
                            ->valueLabel('New Value')
                            ->columnSpanFull()
                            ->hint('Enter field name and new value'),
                        
                        Textarea::make('reason')
                            ->label('Reason for Edit')
                            ->rows(3)
                            ->columnSpanFull()
                            ->hint('Explain why this edit is needed'),
                    ]),
                
                Section::make('Review')
                    ->schema([
                        Select::make('status')
                            ->required()
                            ->default('pending')
                            ->options([
                                'pending' => 'Pending',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->disabled(fn () => !auth()->user()->isAdmin()),
                        
                        Textarea::make('review_notes')
                            ->label('Review Notes')
                            ->rows(3)
                            ->columnSpanFull()
                            ->visible(fn () => auth()->user()->isAdmin()),
                    ])
                    ->visible(fn ($record) => auth()->user()->isAdmin() || $record !== null),
            ]);
    }
}
