<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Communauté';
    protected static ?string $navigationLabel = 'Messages';
    protected static ?string $modelLabel = 'message';
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return (string) Contact::unread()->count() ?: null;
    }
    public static function getNavigationBadgeColor(): ?string { return 'danger'; }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Message reçu')->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\TextInput::make('name')->label('Nom')->disabled(),
                    Forms\Components\TextInput::make('email')->disabled(),
                    Forms\Components\TextInput::make('phone')->label('Téléphone')->disabled(),
                    Forms\Components\TextInput::make('subject')->label('Sujet')->disabled(),
                ]),
                Forms\Components\Textarea::make('message')->disabled()->rows(5),
            ]),
            Forms\Components\Section::make('Traitement')->schema([
                Forms\Components\Select::make('status')->label('Statut')
                    ->options(['unread' => 'Non lu', 'read' => 'Lu', 'replied' => 'Répondu'])->required(),
                Forms\Components\Textarea::make('admin_notes')->label('Notes internes')->rows(3),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nom')->searchable(),
                Tables\Columns\TextColumn::make('subject')->label('Sujet')->limit(40)->searchable(),
                Tables\Columns\TextColumn::make('status')->label('Statut')->badge()
                    ->color(fn ($state) => match($state) { 'unread' => 'danger', 'read' => 'gray', 'replied' => 'success' })
                    ->formatStateUsing(fn ($state) => match($state) { 'unread' => 'Non lu', 'read' => 'Lu', 'replied' => 'Répondu' }),
                Tables\Columns\TextColumn::make('created_at')->label('Reçu le')->date('d/m/Y H:i')->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(['unread' => 'Non lu', 'read' => 'Lu', 'replied' => 'Répondu']),
            ])
            ->actions([Tables\Actions\EditAction::make()->label('Traiter')])
            ->recordUrl(fn ($record) => static::getUrl('edit', ['record' => $record]))
            ->recordClasses(fn ($record) => $record->status === 'unread' ? 'bg-warning-50' : '');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'edit'  => Pages\EditContact::route('/{record}/edit'),
        ];
    }
    public static function canCreate(): bool { return false; }
}
