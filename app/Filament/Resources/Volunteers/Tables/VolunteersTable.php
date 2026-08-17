<?php

namespace App\Filament\Resources\Volunteers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class VolunteersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')
                    ->label('Nom')
                    ->formatStateUsing(fn ($record) => "{$record->first_name} {$record->last_name}")
                    ->searchable(['first_name', 'last_name'])
                    ->sortable(),
                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->copyable(),
                TextColumn::make('city')
                    ->label('Ville')
                    ->formatStateUsing(fn ($record) => trim(($record->city ?? '') . ' ' . ($record->country ? "({$record->country})" : ''))),
                TextColumn::make('status')
                    ->label('Statut')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'accepted' => 'success',
                        'rejected' => 'danger',
                        default    => 'warning',
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'pending'  => 'En attente',
                        'accepted' => 'Acceptée',
                        'rejected' => 'Refusée',
                        default    => $state,
                    }),
                TextColumn::make('created_at')
                    ->label('Reçue le')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->label('Statut')
                    ->options([
                        'pending'  => 'En attente',
                        'accepted' => 'Acceptée',
                        'rejected' => 'Refusée',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
