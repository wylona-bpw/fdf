<?php

namespace App\Filament\Resources\NewsletterSubscribers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NewsletterSubscribersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                TextColumn::make('name')
                    ->label('Nom')
                    ->searchable(),
                IconColumn::make('unsubscribed_at')
                    ->label('Actif')
                    ->boolean()
                    ->getStateUsing(fn ($record) => $record->unsubscribed_at === null),
                TextColumn::make('subscribed_at')
                    ->label('Inscrit(e) le')
                    ->dateTime('d/m/Y')
                    ->sortable(),
            ])
            ->defaultSort('subscribed_at', 'desc')
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
