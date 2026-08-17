<?php

namespace App\Filament\Resources\Articles\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Article')
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
                            ->columnSpanFull(),
                        Select::make('category_id')
                            ->label('Catégorie')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload(),
                        FileUpload::make('cover_image')
                            ->label('Photo de couverture')
                            ->image()
                            ->disk('public')
                            ->directory('articles'),
                        Textarea::make('excerpt')
                            ->label('Résumé')
                            ->rows(2)
                            ->columnSpanFull(),
                        RichEditor::make('body')
                            ->label('Contenu')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Référencement (SEO)')
                    ->columns(2)
                    ->collapsed()
                    ->schema([
                        TextInput::make('meta_title')->label('Titre méta'),
                        TextInput::make('meta_description')->label('Description méta'),
                    ]),

                Section::make('Publication')
                    ->columns(2)
                    ->schema([
                        Toggle::make('is_published')
                            ->label('Publié')
                            ->live()
                            ->default(false),
                        DateTimePicker::make('published_at')
                            ->label('Date de publication')
                            ->native(false)
                            ->visible(fn (callable $get) => $get('is_published')),
                    ]),
            ]);
    }
}
