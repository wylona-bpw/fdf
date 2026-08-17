<?php

namespace App\Filament\Resources\NewsletterSubscribers\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NewsletterSubscriberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('email')->label('E-mail')->email()->required(),
                TextInput::make('name')->label('Nom'),
                DateTimePicker::make('subscribed_at')->label('Inscrit(e) le')->native(false),
                DateTimePicker::make('unsubscribed_at')->label('Désinscrit(e) le')->native(false),
            ]);
    }
}
