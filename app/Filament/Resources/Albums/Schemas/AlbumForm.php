<?php

namespace App\Filament\Resources\Albums\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AlbumForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Mission / album')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null)
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('Utilisé dans l\'URL : /galerie/mon-slug')
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->columnSpanFull(),
                        DatePicker::make('event_date')
                            ->label('Date de la mission')
                            ->native(false),
                        TextInput::make('location')
                            ->label('Lieu')
                            ->placeholder('Ex : Yaoundé-Ayéné, Cameroun'),
                        FileUpload::make('cover_image')
                            ->label('Photo de couverture')
                            ->image()
                            ->disk('public')
                            ->directory('gallery')
                            ->helperText('Affichée sur la galerie et les cartes de missions du site.')
                            ->columnSpanFull(),
                    ]),

                Section::make('Publication')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Publié')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Ordre d\'affichage')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }
}
