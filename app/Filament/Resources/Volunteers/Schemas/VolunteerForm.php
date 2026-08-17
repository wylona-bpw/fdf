<?php

namespace App\Filament\Resources\Volunteers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VolunteerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Candidature')
                    ->columns(2)
                    ->schema([
                        TextInput::make('first_name')->label('Prénom')->required(),
                        TextInput::make('last_name')->label('Nom')->required(),
                        TextInput::make('email')->label('E-mail')->email()->required(),
                        TextInput::make('phone')->label('Téléphone'),
                        TextInput::make('city')->label('Ville'),
                        TextInput::make('country')->label('Pays'),
                        TextInput::make('availability')->label('Disponibilité'),
                        TextInput::make('skills')->label('Compétences'),
                        Textarea::make('message')->label('Message')->rows(3)->columnSpanFull(),
                    ]),

                Section::make('Suivi')
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'pending'  => 'En attente',
                                'accepted' => 'Acceptée',
                                'rejected' => 'Refusée',
                            ])
                            ->required()
                            ->default('pending'),
                        Textarea::make('admin_notes')
                            ->label('Notes internes')
                            ->rows(2),
                    ]),
            ]);
    }
}
