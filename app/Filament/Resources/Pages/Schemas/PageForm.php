<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Contenu')
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')
                            ->label('Titre')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $context, $state, callable $set) => $context === 'create' ? $set('slug', Str::slug($state)) : null)
                            ->columnSpan(1),
                        TextInput::make('slug')
                            ->label('Slug (URL)')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->helperText('Utilisé dans l\'URL : /page/mon-slug (sauf pages spéciales déjà routées).')
                            ->columnSpan(1),
                        Select::make('template')
                            ->label('Gabarit')
                            ->options([
                                'default'      => 'Standard (titre + texte)',
                                'association'  => "L'association",
                                'actions'      => 'Nos actions',
                                'donate'       => 'Faire un don',
                                'transparency' => 'Transparence',
                            ])
                            ->required()
                            ->default('default')
                            ->helperText('Détermine la mise en page utilisée sur le site public.')
                            ->columnSpanFull(),
                        RichEditor::make('body')
                            ->label('Contenu')
                            ->columnSpanFull(),
                    ]),

                Section::make('Référencement (SEO)')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Titre méta')
                            ->maxLength(255),
                        TextInput::make('meta_description')
                            ->label('Description méta')
                            ->maxLength(255),
                    ]),

                Section::make('Publication')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Publiée')
                            ->default(true),
                        TextInput::make('sort_order')
                            ->label('Ordre d\'affichage')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }
}
