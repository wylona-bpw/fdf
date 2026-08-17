<?php

namespace App\Filament\Resources\Testimonials\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class TestimonialsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('')
                    ->disk('public')
                    ->circular()
                    ->width(44)
                    ->height(44),
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('role')
                    ->label('Rôle')
                    ->badge(),
                TextColumn::make('content')
                    ->label('Témoignage')
                    ->limit(60),
                IconColumn::make('is_published')
                    ->label('Publié')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->sortable(),
            ])
            ->defaultSort('sort_order')
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
