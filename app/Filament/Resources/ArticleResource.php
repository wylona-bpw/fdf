<?php
namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Contenu';
    protected static ?string $navigationLabel = 'Actualités';
    protected static ?string $modelLabel = 'article';
    protected static ?string $pluralModelLabel = 'articles';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()->schema([
                Forms\Components\Section::make('Contenu')->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Titre')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, $set) => $set('slug', Str::slug($state))),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    Forms\Components\Textarea::make('excerpt')
                        ->label('Extrait')
                        ->rows(3)
                        ->maxLength(500)
                        ->helperText('Résumé affiché dans les listes (max 500 car.)'),

                    Forms\Components\RichEditor::make('body')
                        ->label('Corps de l\'article')
                        ->required()
                        ->columnSpanFull()
                        ->fileAttachmentsDisk('public')
                        ->fileAttachmentsDirectory('articles'),
                ]),

                Forms\Components\Section::make('SEO')->schema([
                    Forms\Components\TextInput::make('meta_title')->label('Titre SEO')->maxLength(70),
                    Forms\Components\Textarea::make('meta_description')->label('Description SEO')->rows(2)->maxLength(160),
                ])->collapsed(),
            ])->columnSpan(['lg' => 2]),

            Forms\Components\Group::make()->schema([
                Forms\Components\Section::make('Publication')->schema([
                    Forms\Components\Select::make('category_id')
                        ->label('Catégorie')
                        ->relationship('category', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            Forms\Components\TextInput::make('name')->label('Nom')->required(),
                        ]),

                    Forms\Components\Toggle::make('is_published')
                        ->label('Publié')
                        ->default(false),

                    Forms\Components\DateTimePicker::make('published_at')
                        ->label('Date de publication')
                        ->default(now()),
                ]),

                Forms\Components\Section::make('Image')->schema([
                    Forms\Components\FileUpload::make('cover_image')
                        ->label('Image de couverture')
                        ->image()
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('16:9')
                        ->imageResizeTargetWidth('1200')
                        ->imageResizeTargetHeight('675')
                        ->directory('articles/covers')
                        ->disk('public'),
                ]),
            ])->columnSpan(['lg' => 1]),
        ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('cover_image')->label('')->circular()->size(40),
                Tables\Columns\TextColumn::make('title')->label('Titre')->searchable()->sortable()->limit(50),
                Tables\Columns\TextColumn::make('category.name')->label('Catégorie')->badge()->color('primary'),
                Tables\Columns\IconColumn::make('is_published')->label('Publié')->boolean(),
                Tables\Columns\TextColumn::make('published_at')->label('Date')->date('d/m/Y')->sortable(),
                Tables\Columns\TextColumn::make('views_count')->label('Vues')->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Catégorie')
                    ->relationship('category', 'name'),
                Tables\Filters\TernaryFilter::make('is_published')->label('Publié'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit'   => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
