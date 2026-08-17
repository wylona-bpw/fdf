<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nom')
                    ->required()
                    ->maxLength(255),
                TextInput::make('role')
                    ->label('Rôle')
                    ->placeholder('Ex : Bénévole, Bénéficiaire, Partenaire...')
                    ->maxLength(255),
                Textarea::make('content')
                    ->label('Témoignage')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                FileUpload::make('photo')
                    ->label('Photo')
                    ->image()
                    ->disk('public')
                    ->directory('testimonials')
                    ->avatar(),
                Toggle::make('is_published')
                    ->label('Publié')
                    ->default(true),
                TextInput::make('sort_order')
                    ->label('Ordre')
                    ->numeric()
                    ->default(0),
            ]);
    }
}
