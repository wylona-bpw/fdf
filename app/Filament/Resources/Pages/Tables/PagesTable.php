<?php

namespace App\Filament\Resources\Pages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Titre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->color('gray'),
                TextColumn::make('template')
                    ->label('Gabarit')
                    ->badge(),
                IconColumn::make('is_published')
                    ->label('Publiée')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->label('Ordre')
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->label('Modifiée')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->filters([
                SelectFilter::make('template')
                    ->options([
                        'default'      => 'Standard',
                        'association'  => "L'association",
                        'actions'      => 'Nos actions',
                        'donate'       => 'Faire un don',
                        'transparency' => 'Transparence',
                    ]),
                TernaryFilter::make('is_published')->label('Publiée'),
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
