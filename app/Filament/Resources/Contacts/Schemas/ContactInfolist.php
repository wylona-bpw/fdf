<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Message')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')->label('Nom'),
                        TextEntry::make('email')->label('E-mail')->copyable(),
                        TextEntry::make('phone')->label('Téléphone')->copyable(),
                        TextEntry::make('subject')->label('Sujet'),
                        TextEntry::make('message')->label('Message')->columnSpanFull(),
                    ]),
                Section::make('Suivi')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('status')
                            ->label('Statut')
                            ->badge()
                            ->formatStateUsing(fn (string $state) => match ($state) {
                                'unread'  => 'Non lu',
                                'read'    => 'Lu',
                                'replied' => 'Répondu',
                                default   => $state,
                            }),
                        TextEntry::make('created_at')->label('Reçu le')->dateTime('d/m/Y H:i'),
                        TextEntry::make('admin_notes')->label('Notes internes')->columnSpanFull(),
                    ]),
            ]);
    }
}
