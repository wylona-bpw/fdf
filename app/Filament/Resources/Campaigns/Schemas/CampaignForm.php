<?php

namespace App\Filament\Resources\Campaigns\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CampaignForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Campagne')
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
                            ->helperText('Utilisé dans le lien : /faire-un-don?campaign=mon-slug')
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->columnSpanFull(),
                        FileUpload::make('cover_image')
                            ->label('Photo de la campagne')
                            ->image()
                            ->disk('public')
                            ->directory('campaigns')
                            ->columnSpanFull(),
                    ]),

                Section::make('Objectifs & suivi')
                    ->columns(3)
                    ->schema([
                        TextInput::make('goal_amount')
                            ->label('Objectif (€)')
                            ->numeric()
                            ->required()
                            ->default(0),
                        TextInput::make('raised_amount')
                            ->label('Montant collecté (€)')
                            ->numeric()
                            ->default(0)
                            ->helperText('À mettre à jour manuellement depuis votre tableau de bord HelloAsso.'),
                        TextInput::make('donors_count')
                            ->label('Nombre de donateurs')
                            ->numeric()
                            ->default(0)
                            ->helperText('À mettre à jour manuellement.'),
                    ]),

                Section::make('Planification')
                    ->columns(3)
                    ->schema([
                        DatePicker::make('starts_at')
                            ->label('Date de début')
                            ->native(false),
                        DatePicker::make('ends_at')
                            ->label('Date de fin')
                            ->native(false)
                            ->helperText('Utilisée pour afficher "jours restants".'),
                        Toggle::make('is_active')
                            ->label('Campagne active')
                            ->helperText('Une seule campagne active s\'affiche sur la page d\'accueil.')
                            ->default(false),
                    ]),
            ]);
    }
}
