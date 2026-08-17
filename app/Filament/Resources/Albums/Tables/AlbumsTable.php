<?php

namespace App\Filament\Resources\Albums\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class AlbumsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('cover_image')
                    ->label('')
                    ->disk('public')
                    ->square()
                    ->width(56)
                    ->height(56),
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable()
                    ->wrap(),
                TextColumn::make('location')
                    ->label('Lieu')
                    ->searchable(),
                TextColumn::make('event_date')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('items_count')
                    ->label('Photos/vidéos')
                    ->counts('items')
                    ->badge(),
                IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean(),
            ])
            ->defaultSort('event_date', 'desc')
            ->filters([
                TernaryFilter::make('is_published')->label('Publié'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
