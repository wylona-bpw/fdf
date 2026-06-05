<?php
namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Paramètres';
    protected static ?string $navigationLabel = 'Réglages du site';
    protected static ?string $title = 'Réglages du site';
    protected static string $view = 'filament.pages.manage-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Réglages')->tabs([

                Forms\Components\Tabs\Tab::make('Général')->icon('heroicon-o-globe-alt')->schema([
                    Forms\Components\TextInput::make('site_name')->label('Nom du site'),
                    Forms\Components\Textarea::make('site_description')->label('Description')->rows(2),
                    Forms\Components\TextInput::make('site_tagline')->label('Slogan'),
                ]),

                Forms\Components\Tabs\Tab::make('Contact')->icon('heroicon-o-phone')->schema([
                    Forms\Components\TextInput::make('email')->label('E-mail principal')->email(),
                    Forms\Components\TextInput::make('phone')->label('Téléphone'),
                    Forms\Components\Textarea::make('address')->label('Adresse')->rows(2),
                ]),

                Forms\Components\Tabs\Tab::make('Réseaux sociaux')->icon('heroicon-o-share')->schema([
                    Forms\Components\TextInput::make('facebook_url')->label('Facebook')->url()->prefix('https://'),
                    Forms\Components\TextInput::make('instagram_url')->label('Instagram')->url()->prefix('https://'),
                    Forms\Components\TextInput::make('whatsapp_number')->label('WhatsApp')->placeholder('+33612345678'),
                ]),

                Forms\Components\Tabs\Tab::make('Dons')->icon('heroicon-o-gift')->schema([
                    Forms\Components\TextInput::make('donation_url')->label('Lien HelloAsso / dons')->url(),
                    Forms\Components\Textarea::make('donation_text')->label('Texte page dons')->rows(3),
                ]),

                Forms\Components\Tabs\Tab::make('Images')->icon('heroicon-o-photo')->schema([
                    Forms\Components\FileUpload::make('logo')->label('Logo')->image()
                        ->directory('brand')->disk('public'),
                    Forms\Components\FileUpload::make('favicon')->label('Favicon')->image()
                        ->directory('brand')->disk('public'),
                    Forms\Components\FileUpload::make('hero_image')->label('Image Hero (accueil)')
                        ->image()->directory('brand')->disk('public')
                        ->helperText('Photo de terrain pour le hero de la page d\'accueil.'),
                ]),

            ])->columnSpanFull(),
        ])->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        foreach ($data as $key => $value) {
            Setting::put($key, $value);
        }
        Notification::make()->title('Réglages enregistrés')->success()->send();
    }

    protected function getFormActions(): array
    {
        return [
            Forms\Components\Actions\Action::make('save')
                ->label('Enregistrer les réglages')
                ->submit('save'),
        ];
    }
}
