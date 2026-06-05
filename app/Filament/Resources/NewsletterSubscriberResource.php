<?php
namespace App\Filament\Resources;

use App\Filament\Resources\NewsletterSubscriberResource\Pages;
use App\Models\NewsletterSubscriber;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsletterSubscriberResource extends Resource
{
    protected static ?string $model = NewsletterSubscriber::class;
    protected static ?string $navigationIcon = 'heroicon-o-at-symbol';
    protected static ?string $navigationGroup = 'Communauté';
    protected static ?string $navigationLabel = 'Newsletter';
    protected static ?string $modelLabel = 'abonné';
    protected static ?int $navigationSort = 3;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')->searchable()->copyable(),
                Tables\Columns\TextColumn::make('name')->label('Nom'),
                Tables\Columns\TextColumn::make('subscribed_at')->label('Inscrit le')->date('d/m/Y')->sortable(),
                Tables\Columns\IconColumn::make('unsubscribed_at')->label('Actif')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->getStateUsing(fn ($record) => $record->unsubscribed_at === null),
            ])
            ->defaultSort('subscribed_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('active')->label('Actifs')
                    ->queries(
                        true: fn ($q) => $q->whereNull('unsubscribed_at'),
                        false: fn ($q) => $q->whereNotNull('unsubscribed_at'),
                    ),
            ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListNewsletterSubscribers::route('/')];
    }
    public static function canCreate(): bool { return false; }
}
