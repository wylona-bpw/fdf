<?php

namespace App\Filament\Resources\Volunteers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VolunteerInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Candidature')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('first_name')->label('Prénom'),
                        TextEntry::make('last_name')->label('Nom'),
                        TextEntry::make('email')->label('E-mail')->copyable(),
                        TextEntry::make('phone')->label('Téléphone')->copyable(),
                        TextEntry::make('city')->label('Ville'),
                        TextEntry::make('country')->label('Pays'),
                        TextEntry::make('availability')->label('Disponibilité'),
                        TextEntry::make('skills')->label('Compétences'),
                        TextEntry::make('message')->label('Message')->columnSpanFull(),
                    ]),
                Section::make('Suivi')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('status')
                            ->label('Statut')
                            ->badge()
                            ->formatStateUsing(fn (string $state) => match ($state) {
                                'pending'  => 'En attente',
                                'accepted' => 'Acceptée',
                                'rejected' => 'Refusée',
                                default    => $state,
                            }),
                        TextEntry::make('created_at')->label('Reçue le')->dateTime('d/m/Y H:i'),
                        TextEntry::make('admin_notes')->label('Notes internes')->columnSpanFull(),
                    ]),
            ]);
    }
}
