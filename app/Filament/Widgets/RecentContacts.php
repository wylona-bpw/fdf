<?php
namespace App\Filament\Widgets;

use App\Models\Contact;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentContacts extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Derniers messages reçus';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Contact::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nom'),
                Tables\Columns\TextColumn::make('subject')->label('Sujet')->limit(40),
                Tables\Columns\TextColumn::make('status')->label('Statut')
                    ->badge()
                    ->color(fn (string $state) => match($state) {
                        'unread' => 'warning', 'read' => 'gray', 'replied' => 'success',
                    })
                    ->formatStateUsing(fn (string $state) => match($state) {
                        'unread' => 'Non lu', 'read' => 'Lu', 'replied' => 'Répondu',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Reçu')->since()->size('sm'),
            ])
            ->paginated(false);
    }
}
