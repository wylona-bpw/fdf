<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Événement')
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
                            ->helperText('Utilisé dans l\'URL : /evenements/mon-slug')
                            ->columnSpanFull(),
                        DatePicker::make('event_date')
                            ->label('Date de l\'événement')
                            ->native(false)
                            ->required(),
                        TimePicker::make('event_time')
                            ->label('Heure (optionnel)')
                            ->native(false)
                            ->seconds(false),
                        TextInput::make('location')
                            ->label('Lieu')
                            ->placeholder('Ex : Guyancourt, France')
                            ->columnSpanFull(),
                        FileUpload::make('cover_image')
                            ->label('Photo de couverture')
                            ->image()
                            ->disk('public')
                            ->directory('events')
                            ->columnSpanFull(),
                        Textarea::make('excerpt')
                            ->label('Résumé')
                            ->rows(2)
                            ->columnSpanFull(),
                        RichEditor::make('body')
                            ->label('Description détaillée (optionnel)')
                            ->columnSpanFull(),
                    ]),

                Section::make('Inscription')
                    ->schema([
                        TextInput::make('registration_url')
                            ->label('Lien d\'inscription')
                            ->url()
                            ->helperText('Lien externe pour s\'inscrire — billetterie, formulaire Google, HelloAsso, etc. Laisser vide si non applicable.'),
                    ]),

                Section::make('Publication')
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Publié')
                            ->default(true),
                    ]),
            ]);
    }
}
