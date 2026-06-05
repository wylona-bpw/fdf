<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Général
            ['key' => 'site_name',        'value' => 'Mouvement des Femmes de Foi', 'group' => 'general', 'type' => 'text',     'label' => 'Nom du site'],
            ['key' => 'site_description',  'value' => 'Association humanitaire à but non lucratif', 'group' => 'general', 'type' => 'textarea', 'label' => 'Description'],
            ['key' => 'site_tagline',      'value' => 'Avec la foi, tout est possible', 'group' => 'general', 'type' => 'text',     'label' => 'Slogan'],

            // Contact
            ['key' => 'email',             'value' => '',   'group' => 'contact', 'type' => 'email', 'label' => 'E-mail principal'],
            ['key' => 'phone',             'value' => '',   'group' => 'contact', 'type' => 'text',  'label' => 'Téléphone'],
            ['key' => 'address',           'value' => 'France / International', 'group' => 'contact', 'type' => 'textarea', 'label' => 'Adresse'],

            // Réseaux sociaux
            ['key' => 'facebook_url',      'value' => '', 'group' => 'social', 'type' => 'text', 'label' => 'Facebook'],
            ['key' => 'instagram_url',     'value' => '', 'group' => 'social', 'type' => 'text', 'label' => 'Instagram'],
            ['key' => 'whatsapp_number',   'value' => '', 'group' => 'social', 'type' => 'text', 'label' => 'WhatsApp'],

            // Dons
            ['key' => 'donation_url',      'value' => '', 'group' => 'donation', 'type' => 'text',     'label' => 'Lien HelloAsso / dons'],
            ['key' => 'donation_text',     'value' => 'Chaque don compte et change des vies.', 'group' => 'donation', 'type' => 'textarea', 'label' => 'Texte page dons'],

            // Images
            ['key' => 'logo',              'value' => '', 'group' => 'brand', 'type' => 'image', 'label' => 'Logo'],
            ['key' => 'favicon',           'value' => '', 'group' => 'brand', 'type' => 'image', 'label' => 'Favicon'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }
    }
}
