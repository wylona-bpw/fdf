<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Cache;

class ManageSettings extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;

    protected static \UnitEnum|string|null $navigationGroup = 'Réglages';

    protected static ?string $navigationLabel = 'Réglages du site';

    protected static ?string $title = 'Réglages du site';

    protected string $view = 'filament.pages.manage-settings';

    /** @var array<string, mixed> */
    public ?array $data = [];

    protected static array $groupLabels = [
        'general'  => 'Général',
        'legal'    => 'Identité légale',
        'contact'  => 'Contact',
        'social'   => 'Réseaux sociaux',
        'donation' => 'Dons',
        'stats'    => "Chiffres d'impact",
        'brand'    => 'Images',
    ];

    public function mount(): void
    {
        $this->form->fill(Setting::query()->pluck('value', 'key')->toArray());
    }

    public function form(Schema $schema): Schema
    {
        $tabs = Setting::query()
            ->orderBy('group')
            ->orderBy('id')
            ->get()
            ->groupBy('group')
            ->map(function ($settings, $group) {
                return Tab::make(static::$groupLabels[$group] ?? ucfirst($group))
                    ->schema(
                        $settings->map(fn (Setting $setting) => static::fieldFor($setting))->all()
                    );
            })
            ->values()
            ->all();

        return $schema
            ->components([
                Tabs::make('Réglages')->tabs($tabs)->persistTabInQueryString(),
            ])
            ->statePath('data');
    }

    protected static function fieldFor(Setting $setting)
    {
        $label = $setting->label ?: $setting->key;

        return match ($setting->type) {
            'textarea' => Textarea::make($setting->key)->label($label)->rows(3)->columnSpanFull(),
            'email'    => TextInput::make($setting->key)->label($label)->email(),
            'image'    => FileUpload::make($setting->key)->label($label)->image()->disk('public')->directory('branding'),
            default    => TextInput::make($setting->key)->label($label),
        };
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            Setting::query()->where('key', $key)->update(['value' => $value]);
        }

        Cache::forget('site_settings');

        Notification::make()
            ->title('Réglages enregistrés')
            ->success()
            ->send();
    }
}
