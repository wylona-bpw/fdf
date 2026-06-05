<?php
namespace App\Filament\Resources;

use App\Filament\Resources\AlbumResource\Pages;
use App\Filament\Resources\AlbumResource\RelationManagers\ItemsRelationManager;
use App\Models\Album;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class AlbumResource extends Resource
{
    protected static ?string $model = Album::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Média';
    protected static ?string $navigationLabel = 'Albums';
    protected static ?string $modelLabel = 'album';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make()->schema([
                Forms\Components\TextInput::make('title')->label('Titre')->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true),
                Forms\Components\Textarea::make('description')->label('Description')->rows(2),
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\DatePicker::make('event_date')->label('Date de l\'action'),
                    Forms\Components\TextInput::make('location')->label('Lieu'),
                ]),
                Forms\Components\FileUpload::make('cover_image')
                    ->label('Photo de couverture')
                    ->image()->directory('albums/covers')->disk('public')
                    ->imageResizeTargetWidth('800')->imageResizeTargetHeight('600'),
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\Toggle::make('is_published')->label('Publié')->default(false),
                    Forms\Components\TextInput::make('sort_order')->label('Ordre')->numeric()->default(0),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')->label('')->circular()->size(40),
                Tables\Columns\TextColumn::make('title')->label('Titre')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('event_date')->label('Date')->date('d/m/Y')->sortable(),
                Tables\Columns\TextColumn::make('location')->label('Lieu'),
                Tables\Columns\TextColumn::make('items_count')->counts('items')->label('Photos'),
                Tables\Columns\IconColumn::make('is_published')->label('Publié')->boolean(),
            ])
            ->defaultSort('event_date', 'desc')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getRelations(): array
    {
        return [ItemsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListAlbums::route('/'),
            'create' => Pages\CreateAlbum::route('/create'),
            'edit'   => Pages\EditAlbum::route('/{record}/edit'),
        ];
    }
}
