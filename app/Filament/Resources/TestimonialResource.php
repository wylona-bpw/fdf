<?php
namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationGroup = 'Contenu';
    protected static ?string $navigationLabel = 'Témoignages';
    protected static ?string $modelLabel = 'témoignage';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\TextInput::make('name')->label('Nom complet')->required(),
                Forms\Components\TextInput::make('role')->label('Rôle / Ville')->placeholder('Ex : Bénévole • Paris'),
            ]),
            Forms\Components\Textarea::make('content')->label('Témoignage')->required()->rows(4),
            Forms\Components\FileUpload::make('photo')->label('Photo')->image()->avatar()
                ->directory('testimonials')->disk('public'),
            Forms\Components\Grid::make(2)->schema([
                Forms\Components\Toggle::make('is_published')->label('Publié')->default(false),
                Forms\Components\TextInput::make('sort_order')->label('Ordre')->numeric()->default(0),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')->circular()->size(40),
                Tables\Columns\TextColumn::make('name')->label('Nom')->searchable(),
                Tables\Columns\TextColumn::make('role')->label('Rôle'),
                Tables\Columns\TextColumn::make('content')->label('Extrait')->limit(60),
                Tables\Columns\IconColumn::make('is_published')->label('Publié')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ManageTestimonials::route('/')];
    }
}
