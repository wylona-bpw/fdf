<?php
namespace App\Filament\Widgets;

use App\Models\Volunteer;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class RecentVolunteers extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Dernières candidatures bénévoles';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Volunteer::query()->latest()->limit(5))
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->label('Nom')->searchable(['first_name', 'last_name']),
                Tables\Columns\TextColumn::make('email')->size('sm'),
                Tables\Columns\TextColumn::make('city')->label('Ville')->size('sm'),
                Tables\Columns\TextColumn::make('status')->label('Statut')
                    ->badge()
                    ->color(fn (string $state) => match($state) {
                        'pending' => 'warning', 'accepted' => 'success', 'rejected' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('created_at')->label('Reçu')->since()->size('sm'),
            ])
            ->paginated(false);
    }
}
