<?php

namespace App\Filament\Resources\Albums\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Photos & vidéos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('type')
                    ->label('Type')
                    ->options(['photo' => 'Photo', 'video' => 'Vidéo'])
                    ->required()
                    ->live()
                    ->default('photo'),
                FileUpload::make('file_path')
                    ->label('Photo')
                    ->image()
                    ->disk('public')
                    ->directory('gallery')
                    ->visible(fn (Get $get) => $get('type') === 'photo')
                    ->required(fn (Get $get) => $get('type') === 'photo'),
                TextInput::make('video_url')
                    ->label('URL de la vidéo')
                    ->url()
                    ->helperText('Lien direct vers le fichier vidéo (mp4) ou vers YouTube/Vimeo.')
                    ->visible(fn (Get $get) => $get('type') === 'video')
                    ->required(fn (Get $get) => $get('type') === 'video'),
                FileUpload::make('thumbnail_path')
                    ->label('Miniature de la vidéo')
                    ->image()
                    ->disk('public')
                    ->directory('gallery')
                    ->helperText('Image affichée à la place de la vidéo dans la grille.')
                    ->visible(fn (Get $get) => $get('type') === 'video'),
                TextInput::make('caption')
                    ->label('Légende')
                    ->maxLength(255)
                    ->columnSpanFull(),
                TextInput::make('sort_order')
                    ->label('Ordre')
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('caption')
            ->columns([
                ImageColumn::make('displayThumbnail')
                    ->label('')
                    ->disk('public')
                    ->square()
                    ->width(56)
                    ->height(56)
                    ->state(fn ($record) => $record->type === 'video' ? $record->thumbnail_path : $record->file_path),
                TextColumn::make('type')
                    ->label('Type')
                    ->badge(),
                TextColumn::make('caption')
                    ->label('Légende')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
