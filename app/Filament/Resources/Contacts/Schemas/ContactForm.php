<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Message')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')->label('Nom')->required(),
                        TextInput::make('email')->label('E-mail')->email()->required(),
                        TextInput::make('phone')->label('Téléphone'),
                        TextInput::make('subject')->label('Sujet'),
                        Textarea::make('message')->label('Message')->required()->rows(4)->columnSpanFull(),
                    ]),

                Section::make('Suivi')
                    ->columns(2)
                    ->schema([
                        Select::make('status')
                            ->label('Statut')
                            ->options([
                                'unread'  => 'Non lu',
                                'read'    => 'Lu',
                                'replied' => 'Répondu',
                            ])
                            ->required()
                            ->default('unread'),
                        Textarea::make('admin_notes')
                            ->label('Notes internes')
                            ->rows(2),
                    ]),
            ]);
    }
}
