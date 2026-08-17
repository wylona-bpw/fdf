<?php

namespace App\Filament\Resources\Articles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ArticlesTable
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
                TextColumn::make('category.name')
                    ->label('Catégorie')
                    ->badge(),
                IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean(),
                TextColumn::make('published_at')
                    ->label('Publié le')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('views_count')
                    ->label('Vues')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                SelectFilter::make('category_id')
                    ->label('Catégorie')
                    ->relationship('category', 'name'),
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
