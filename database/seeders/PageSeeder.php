<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => "L'association",
                'slug' => 'association',
                'template' => 'association',
                'sort_order' => 1,
                'meta_description' => "Le Mouvement des Femmes de Foi (MFDF) est une association humanitaire loi 1901 qui accompagne les personnes vulnérables au Cameroun et en France.",
                'body' => <<<'HTML'
<p>Le Mouvement des Femmes de Foi (MFDF) est une association humanitaire à but non lucratif, régie par la loi du 1er juillet 1901. Notre mission est d'apporter soutien, espoir et assistance aux personnes les plus vulnérables, partout où le besoin se fait sentir.</p>
HTML,
            ],
            [
                'title' => 'Nos actions',
                'slug' => 'nos-actions',
                'template' => 'actions',
                'sort_order' => 2,
                'meta_description' => "Distribution alimentaire, fournitures scolaires, vêtements et accompagnement moral : découvrez les actions de terrain du Mouvement des Femmes de Foi au Cameroun et en France.",
                'body' => <<<'HTML'
<p>Le Mouvement des Femmes de Foi mène des actions concrètes de distribution de denrées alimentaires, de vêtements et de fournitures scolaires, ainsi que de l'accompagnement moral et humain — en France et à l'international.</p>
HTML,
            ],
            [
                'title' => 'Faire un don',
                'slug' => 'faire-un-don',
                'template' => 'donate',
                'sort_order' => 3,
                'meta_description' => "Soutenez le Mouvement des Femmes de Foi : chaque don finance directement nos missions de terrain au Cameroun et en France.",
                'body' => null,
            ],
            [
                'title' => 'Transparence',
                'slug' => 'transparence',
                'template' => 'transparency',
                'sort_order' => 4,
                'meta_description' => "Gestion et utilisation des dons du Mouvement des Femmes de Foi : notre engagement de transparence.",
                'body' => <<<'HTML'
<p>Association loi 1901 à but non lucratif, le Mouvement des Femmes de Foi s'engage à une gestion rigoureuse et transparente des dons reçus. Chaque don sert directement à financer nos actions de terrain.</p>
HTML,
            ],
            [
                'title' => 'Témoignages',
                'slug' => 'temoignages',
                'template' => 'default',
                'sort_order' => 5,
                'meta_description' => "Témoignages des bénévoles et bénéficiaires du Mouvement des Femmes de Foi.",
                'body' => <<<'HTML'
<p>Les témoignages de nos bénévoles et bénéficiaires seront publiés ici au fil de nos missions. Vous êtes bénévole ou bénéficiaire du Mouvement des Femmes de Foi et souhaitez partager votre expérience ? <a href="mailto:contact@amfdf.org">Écrivez-nous</a>.</p>
HTML,
            ],
            [
                'title' => 'Mentions légales',
                'slug' => 'mentions-legales',
                'template' => 'default',
                'sort_order' => 10,
                'body' => <<<'HTML'
<h2>Éditeur du site</h2>
<p><strong>Mouvement des Femmes de Foi</strong> (MFDF)<br>
Association loi 1901<br>
Numéro RNA : W784011796<br>
Siège social : 31 boulevard d'Alembert, 78280 Guyancourt, France<br>
E-mail : contact@amfdf.org<br>
Téléphone : 07 46 20 23 53</p>

<h2>Hébergement</h2>
<p>Ce site est hébergé par LWS (Ligne Web Services) — lws.fr</p>

<h2>Propriété intellectuelle</h2>
<p>L'ensemble des contenus (textes, photographies, logo) présents sur ce site est la propriété du Mouvement des Femmes de Foi, sauf mention contraire. Toute reproduction sans autorisation préalable est interdite.</p>
HTML,
            ],
            [
                'title' => 'Politique de confidentialité',
                'slug' => 'politique-de-confidentialite',
                'template' => 'default',
                'sort_order' => 11,
                'body' => <<<'HTML'
<h2>Données collectées</h2>
<p>Dans le cadre de nos formulaires (contact, bénévolat, newsletter), nous collectons uniquement les données que vous nous transmettez volontairement : nom, e-mail, téléphone, message. Ces données sont utilisées uniquement pour répondre à votre demande ou vous tenir informé(e) de nos actions.</p>

<h2>Conservation et sécurité</h2>
<p>Vos données sont conservées le temps nécessaire au traitement de votre demande et ne sont ni vendues, ni cédées à des tiers.</p>

<h2>Vos droits</h2>
<p>Conformément au Règlement Général sur la Protection des Données (RGPD), vous disposez d'un droit d'accès, de rectification et de suppression de vos données. Pour exercer ce droit, contactez-nous à l'adresse contact@amfdf.org.</p>

<h2>Cookies</h2>
<p>Ce site peut utiliser des cookies techniques nécessaires à son bon fonctionnement. Aucun cookie publicitaire n'est déposé sans votre consentement.</p>
HTML,
            ],
        ];

        foreach ($pages as $p) {
            Page::updateOrCreate(['slug' => $p['slug']], array_merge($p, [
                'body'         => $p['body'] ?? '<p>Contenu à rédiger.</p>',
                'is_published' => true,
            ]));
        }
    }
}
