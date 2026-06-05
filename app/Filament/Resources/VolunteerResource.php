<?php
namespace App\Filament\Resources;

use App\Filament\Resources\VolunteerResource\Pages;
use App\Models\Volunteer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class VolunteerResource extends Resource
{
    protected static ?string $model = Volunteer::class;
    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationGroup = 'Communauté';
    protected static ?string $navigationLabel = 'Bénévoles';
    protected static ?string $modelLabel = 'bénévole';
    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return (string) Volunteer::pending()->count() ?: null;
    }

    public static function getNavigationBadgeColor(): ?string { return 'warning'; }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informations')->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('first_name')->label('Prénom')->disabled(),
                    Forms\Components\TextInput::make('last_name')->label('Nom')->disabled(),
                    Forms\Components\TextInput::make('email')->disabled(),
                    Forms\Components\TextInput::make('phone')->label('Téléphone')->disabled(),
                    Forms\Components\TextInput::make('city')->label('Ville')->disabled(),
                    Forms\Components\TextInput::make('country')->label('Pays')->disabled(),
                ]),
                Forms\Components\Textarea::make('skills')->label('Compétences')->disabled(),
                Forms\Components\Textarea::make('message')->label('Message')->disabled(),
            ]),
            Forms\Components\Section::make('Traitement')->schema([
                Forms\Components\Select::make('status')->label('Statut')
                    ->options(['pending' => 'En attente', 'accepted' => 'Accepté', 'rejected' => 'Refusé'])
                    ->required(),
                Forms\Components\Textarea::make('admin_notes')->label('Notes internes')->rows(3)
                    ->helperText('Visible uniquement par les administrateurs.'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->label('Nom complet')->searchable(['first_name','last_name'])->sortable(['first_name']),
                Tables\Columns\TextColumn::make('email')->size('sm')->copyable(),
                Tables\Columns\TextColumn::make('city')->label('Ville'),
                Tables\Columns\TextColumn::make('country')->label('Pays'),
                Tables\Columns\TextColumn::make('status')->label('Statut')->badge()
                    ->color(fn ($state) => match($state) { 'pending' => 'warning', 'accepted' => 'success', 'rejected' => 'danger' })
                    ->formatStateUsing(fn ($state) => match($state) { 'pending' => 'En attente', 'accepted' => 'Accepté', 'rejected' => 'Refusé' }),
                Tables\Columns\TextColumn::make('created_at')->label('Inscrit le')->date('d/m/Y')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label('Statut')
                    ->options(['pending' => 'En attente', 'accepted' => 'Accepté', 'rejected' => 'Refusé']),
            ])
            ->actions([Tables\Actions\EditAction::make()->label('Traiter')])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVolunteers::route('/'),
            'edit'  => Pages\EditVolunteer::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool { return false; }
}
