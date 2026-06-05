<?php
namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';
    protected static ?string $navigationGroup = 'Contenu';
    protected static ?string $navigationLabel = 'Pages';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->label('Titre')->required(),
            Forms\Components\TextInput::make('slug')->required()->unique(ignoreRecord: true)->disabled(fn ($record) => $record !== null),
            Forms\Components\RichEditor::make('body')->label('Contenu')->columnSpanFull()
                ->fileAttachmentsDisk('public')->fileAttachmentsDirectory('pages'),
            Forms\Components\Grid::make(3)->schema([
                Forms\Components\Select::make('template')->label('Template')
                    ->options(['default' => 'Par défaut', 'association' => 'Association', 'actions' => 'Nos actions', 'donate' => 'Faire un don']),
                Forms\Components\Toggle::make('is_published')->label('Publiée')->default(true),
                Forms\Components\TextInput::make('sort_order')->label('Ordre')->numeric(),
            ]),
            Forms\Components\Section::make('SEO')->schema([
                Forms\Components\TextInput::make('meta_title')->label('Titre SEO')->maxLength(70),
                Forms\Components\Textarea::make('meta_description')->label('Description SEO')->rows(2)->maxLength(160),
            ])->collapsed(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Titre')->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('URL')->size('sm')->prefix('/'),
                Tables\Columns\TextColumn::make('template')->label('Template')->badge(),
                Tables\Columns\IconColumn::make('is_published')->label('Publiée')->boolean(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'edit'  => Pages\EditPage::route('/{record}/edit'),
        ];
    }
    public static function canCreate(): bool { return false; }
}
