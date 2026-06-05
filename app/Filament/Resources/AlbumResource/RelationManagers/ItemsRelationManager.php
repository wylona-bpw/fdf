<?php
namespace App\Filament\Resources\AlbumResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';
    protected static ?string $title = 'Photos & Vidéos';

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('type')
                ->label('Type')
                ->options(['photo' => 'Photo', 'video' => 'Vidéo'])
                ->default('photo')
                ->reactive(),
            Forms\Components\FileUpload::make('file_path')
                ->label('Fichier')
                ->image()->directory('gallery')->disk('public')
                ->imageResizeTargetWidth('1200')
                ->visible(fn ($get) => $get('type') === 'photo'),
            Forms\Components\TextInput::make('video_url')
                ->label('URL vidéo (YouTube, Vimeo)')
                ->url()
                ->visible(fn ($get) => $get('type') === 'video'),
            Forms\Components\TextInput::make('caption')->label('Légende')->maxLength(255),
            Forms\Components\TextInput::make('sort_order')->label('Ordre')->numeric()->default(0),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')->label('Aperçu')->circular()->size(40),
                Tables\Columns\TextColumn::make('type')->label('Type')->badge()
                    ->color(fn ($state) => $state === 'photo' ? 'primary' : 'warning'),
                Tables\Columns\TextColumn::make('caption')->label('Légende')->limit(40),
                Tables\Columns\TextColumn::make('sort_order')->label('Ordre')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
