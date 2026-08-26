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
            ['key' => 'site_description',  'value' => "Association humanitaire à but non lucratif (loi 1901) qui accompagne les enfants orphelins, les personnes en situation de handicap, les personnes âgées, les veuves et toute personne vulnérable, en France et à l'international.", 'group' => 'general', 'type' => 'textarea', 'label' => 'Description'],
            ['key' => 'site_tagline',      'value' => 'Avec la foi, tout est possible', 'group' => 'general', 'type' => 'text',     'label' => 'Slogan'],

            // Identité légale
            ['key' => 'legal_name',        'value' => 'Mouvement des Femmes de Foi', 'group' => 'legal', 'type' => 'text', 'label' => 'Nom légal complet'],
            ['key' => 'rna_number',        'value' => 'W784011796', 'group' => 'legal', 'type' => 'text', 'label' => "Numéro RNA (répertoire national des associations)"],

            // Contact
            ['key' => 'email',             'value' => 'contact@amfdf.org',   'group' => 'contact', 'type' => 'email', 'label' => 'E-mail principal'],
            ['key' => 'phone',             'value' => '07 46 20 23 53',   'group' => 'contact', 'type' => 'text',  'label' => 'Téléphone'],
            ['key' => 'address',           'value' => "31 boulevard d'Alembert, 78280 Guyancourt, France", 'group' => 'contact', 'type' => 'textarea', 'label' => 'Adresse'],

            // Réseaux sociaux
            ['key' => 'facebook_url',      'value' => '', 'group' => 'social', 'type' => 'text', 'label' => 'Facebook'],
            ['key' => 'instagram_url',     'value' => '', 'group' => 'social', 'type' => 'text', 'label' => 'Instagram'],
            ['key' => 'whatsapp_number',   'value' => '33746202353', 'group' => 'social', 'type' => 'text', 'label' => 'WhatsApp (format international, sans +)'],

            // Dons
            ['key' => 'donation_url',      'value' => '', 'group' => 'donation', 'type' => 'text',     'label' => 'Lien HelloAsso / dons'],
            ['key' => 'donation_text',     'value' => "Votre générosité nous permet d'agir concrètement auprès des plus vulnérables, au Cameroun comme en France. Chaque don sert directement une mission de terrain.", 'group' => 'donation', 'type' => 'textarea', 'label' => 'Texte page dons'],

            // Don par virement bancaire
            ['key' => 'bank_holder',       'value' => 'Mouvement des Femmes de Foi', 'group' => 'donation', 'type' => 'text', 'label' => 'Titulaire du compte'],
            ['key' => 'bank_name',         'value' => 'Crédit Mutuel', 'group' => 'donation', 'type' => 'text', 'label' => 'Banque'],
            ['key' => 'bank_iban',         'value' => 'FR76 1027 8063 6800 0216 2980 101', 'group' => 'donation', 'type' => 'text', 'label' => 'IBAN'],
            ['key' => 'bank_bic',          'value' => 'CMCIFR2A', 'group' => 'donation', 'type' => 'text', 'label' => 'BIC'],

            // Chiffres d'impact (bandeau home) — mis à jour après chaque mission
            ['key' => 'stat_people_helped', 'value' => '50', 'group' => 'stats', 'type' => 'text', 'label' => 'Personnes aidées'],
            ['key' => 'stat_volunteers',    'value' => '20', 'group' => 'stats', 'type' => 'text', 'label' => 'Bénévoles actifs'],
            ['key' => 'stat_actions',       'value' => '3',  'group' => 'stats', 'type' => 'text', 'label' => 'Actions menées'],
            ['key' => 'stat_countries',     'value' => '2',  'group' => 'stats', 'type' => 'text', 'label' => 'Pays touchés'],

            // Images
            ['key' => 'logo',              'value' => '', 'group' => 'brand', 'type' => 'image', 'label' => 'Logo'],
            ['key' => 'favicon',           'value' => '', 'group' => 'brand', 'type' => 'image', 'label' => 'Favicon'],
        ];

        foreach ($settings as $s) {
            Setting::updateOrCreate(['key' => $s['key']], $s);
        }

        // Le cache des settings ne s'auto-expire jamais (rememberForever) :
        // on doit le vider explicitement pour que le nouveau contenu apparaisse.
        \Illuminate\Support\Facades\Cache::forget('site_settings');
    }
}
