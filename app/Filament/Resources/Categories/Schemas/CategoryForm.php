<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nom')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null),
                TextInput::make('slug')
                    ->label('Slug (URL)')
                    ->required()
                    ->unique(ignoreRecord: true),
                Textarea::make('description')
                    ->label('Description')
                    ->rows(2)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Active')
                    ->default(true),
                TextInput::make('sort_order')
                    ->label('Ordre')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
