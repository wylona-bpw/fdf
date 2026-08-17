<?php

namespace App\Filament\Resources\NewsletterSubscribers\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class NewsletterSubscriberInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextEntry::make('email')->label('E-mail')->copyable(),
                TextEntry::make('name')->label('Nom'),
                TextEntry::make('subscribed_at')->label('Inscrit(e) le')->dateTime('d/m/Y H:i'),
                TextEntry::make('unsubscribed_at')->label('Désinscrit(e) le')->dateTime('d/m/Y H:i')->placeholder('—'),
            ]);
    }
}
