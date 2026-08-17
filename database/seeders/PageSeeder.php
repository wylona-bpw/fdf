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
<h2>Qui sommes-nous ?</h2>
<p>Le Mouvement des Femmes de Foi (MFDF) est une association humanitaire à but non lucratif, régie par la loi du 1er juillet 1901. Notre mission est d'apporter soutien, espoir et assistance aux personnes les plus vulnérables, partout où le besoin se fait sentir.</p>

<h2>Notre vision</h2>
<p>« Avec la foi, tout est possible. » Nous sommes des femmes unies par des valeurs de solidarité, d'entraide, de compassion, d'humanité, de foi et d'espérance.</p>

<h2>Notre mission</h2>
<p>Nous soutenons les enfants orphelins, les personnes en situation de handicap, les personnes âgées, les veuves, les personnes isolées et toutes les personnes en situation de vulnérabilité.</p>

<h2>Nos actions</h2>
<p>Distribution de denrées alimentaires, de vêtements, de fournitures scolaires, et accompagnement moral et humain — en France et à l'international.</p>

<h2>Les femmes au sein du mouvement</h2>
<p>La femme est source de vie, d'amour et d'espérance. Par sa foi et son engagement, elle contribue à transformer des vies.</p>

<h2>Notre fondement spirituel</h2>
<p>« Jésus est le chemin, la vérité et la vie » (Jean 14:6).</p>

<h2>Rejoignez-nous</h2>
<p>Ensemble, redonnons espoir aux plus vulnérables.</p>
HTML,
            ],
            [
                'title' => 'Nos actions',
                'slug' => 'nos-actions',
                'template' => 'actions',
                'sort_order' => 2,
                'meta_description' => "Distribution alimentaire, fournitures scolaires, vêtements et accompagnement moral : découvrez les actions de terrain du Mouvement des Femmes de Foi au Cameroun et en France.",
                'body' => <<<'HTML'
<h2>Ce que nous faisons</h2>
<p>Le Mouvement des Femmes de Foi mène des actions concrètes de distribution de denrées alimentaires, de vêtements et de fournitures scolaires, ainsi que de l'accompagnement moral et humain — en France et à l'international.</p>

<h2>Notre première grande mission</h2>
<p>En août 2026, notre équipe s'est rendue à l'orphelinat La Miséricorde Divine, à Yaoundé-Ayéné (Cameroun), pour une distribution de denrées de première nécessité : riz, œufs, boissons et produits d'hygiène. 50 enfants ont été accompagnés lors de cette mission.</p>

<h2>Nos domaines d'intervention</h2>
<ul>
<li>Distribution alimentaire pour les familles et les personnes âgées</li>
<li>Fournitures scolaires pour les enfants orphelins</li>
<li>Vêtements pour toute personne vulnérable</li>
<li>Accompagnement moral pour les veuves et les personnes isolées</li>
<li>Soutien aux personnes en situation de handicap</li>
<li>Solidarité internationale, au Cameroun et en France</li>
</ul>
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
                'template' => 'default',
                'sort_order' => 4,
                'meta_description' => "Gestion et utilisation des dons du Mouvement des Femmes de Foi : notre engagement de transparence.",
                'body' => <<<'HTML'
<h2>Notre engagement</h2>
<p>Association loi 1901 à but non lucratif, le Mouvement des Femmes de Foi s'engage à une gestion rigoureuse et transparente des dons reçus. Chaque don sert directement à financer nos actions de terrain : distribution alimentaire, fournitures scolaires, vêtements et accompagnement moral.</p>

<h2>Notre première mission</h2>
<p>En août 2026, grâce à la générosité de nos donateurs et bénévoles, nous avons pu offrir des denrées de première nécessité à 50 enfants de l'orphelinat La Miséricorde Divine, à Yaoundé-Ayéné (Cameroun).</p>

<h2>Rapport d'activité</h2>
<p>Un bilan d'activité est établi chaque année et disponible sur simple demande, à l'adresse femmedefoi.mdfd@gmail.com.</p>
HTML,
            ],
            [
                'title' => 'Témoignages',
                'slug' => 'temoignages',
                'template' => 'default',
                'sort_order' => 5,
                'meta_description' => "Témoignages des bénévoles et bénéficiaires du Mouvement des Femmes de Foi.",
                'body' => <<<'HTML'
<p>Les témoignages de nos bénévoles et bénéficiaires seront publiés ici au fil de nos missions. Vous êtes bénévole ou bénéficiaire du Mouvement des Femmes de Foi et souhaitez partager votre expérience ? <a href="mailto:femmedefoi.mdfd@gmail.com">Écrivez-nous</a>.</p>
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
E-mail : femmedefoi.mdfd@gmail.com<br>
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
<p>Conformément au Règlement Général sur la Protection des Données (RGPD), vous disposez d'un droit d'accès, de rectification et de suppression de vos données. Pour exercer ce droit, contactez-nous à l'adresse femmedefoi.mdfd@gmail.com.</p>

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
