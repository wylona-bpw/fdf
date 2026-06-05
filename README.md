# FDF — Mouvement des Femmes de Foi

> Site web associatif développé sur mesure avec Laravel.

## Stack technique

| Composant   | Technologie                         |
|-------------|-------------------------------------|
| Backend     | PHP 8.3+ / Laravel (stable)         |
| Base        | MySQL                               |
| Frontend    | Blade + Tailwind CSS 3 + Alpine.js  |
| Admin       | Filament 3                          |
| Newsletter  | Brevo (SMTP/API)                    |
| Dons        | HelloAsso (embed/redirect)          |
| Hébergement | LWS cPanel L                        |

---

## 1. Installation locale

```bash
# Créer le projet Laravel
composer create-project laravel/laravel fdf
cd fdf

# Installer Filament
composer require filament/filament
php artisan filament:install --panels

# Installer les dépendances frontend
npm install tailwindcss @tailwindcss/forms alpinejs
npm install -D vite laravel-vite-plugin

# Intervention Image (compression/resize des photos galerie)
composer require intervention/image

# Copier les fichiers de ce scaffold dans le projet :
#   database/migrations/     → fdf/database/migrations/
#   app/Models/              → fdf/app/Models/
#   app/Http/Controllers/    → fdf/app/Http/Controllers/
#   app/Helpers/helpers.php  → fdf/app/Helpers/helpers.php
#   routes/web.php           → remplacer fdf/routes/web.php
#   database/seeders/        → fdf/database/seeders/
```

### Configurer `.env`

```env
APP_NAME="Mouvement des Femmes de Foi"
APP_URL=http://fdf.local

DB_DATABASE=fdf
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=contact@femmesdefoi.org
MAIL_FROM_NAME="Mouvement des Femmes de Foi"
```

### Autoload du helper

Dans `composer.json`, ajouter :

```json
"autoload": {
    "files": [
        "app/Helpers/helpers.php"
    ]
}
```

Puis `composer dump-autoload`.

### Lancer les migrations et seeders

```bash
php artisan migrate
php artisan db:seed --class=SettingsSeeder
php artisan db:seed --class=PageSeeder
php artisan storage:link
```

### Créer le premier admin Filament

```bash
php artisan make:filament-user
```

### Scaffolder les ressources Filament

```bash
php artisan make:filament-resource Article --generate
php artisan make:filament-resource Category --generate
php artisan make:filament-resource Album --generate
php artisan make:filament-resource GalleryItem --generate
php artisan make:filament-resource Volunteer --generate
php artisan make:filament-resource Contact --generate
php artisan make:filament-resource Page --generate
php artisan make:filament-resource NewsletterSubscriber --generate
php artisan make:filament-resource Testimonial --generate
php artisan make:filament-resource Setting --generate
```

> L'option `--generate` crée automatiquement le formulaire et la table
> à partir des colonnes de la migration. Adapter ensuite (WYSIWYG pour body,
> FileUpload pour images, Select pour enums, etc.).

---

## 2. Architecture des fichiers (scaffold)

```
database/migrations/
├── 000001_create_categories_table
├── 000002_create_articles_table
├── 000003_create_albums_table
├── 000004_create_gallery_items_table
├── 000005_create_volunteers_table
├── 000006_create_contacts_table
├── 000007_create_pages_table
├── 000008_create_settings_table
├── 000009_create_newsletter_subscribers_table
├── 000010_create_testimonials_table
└── 000011_add_fields_to_users_table

app/Models/
├── Article.php          (blog / actualités)
├── Category.php         (catégories d'articles)
├── Album.php            (albums galerie)
├── GalleryItem.php      (photos/vidéos dans un album)
├── Volunteer.php        (inscriptions bénévoles)
├── Contact.php          (messages du formulaire)
├── Page.php             (pages éditables : asso, actions, dons, légal)
├── Setting.php          (paramètres clé-valeur avec cache)
├── NewsletterSubscriber.php
└── Testimonial.php

app/Http/Controllers/
├── HomeController.php       → GET /
├── ArticleController.php    → GET /actualites, /actualites/{slug}
├── GalleryController.php    → GET /galerie, /galerie/{slug}
├── VolunteerController.php  → GET|POST /devenir-benevole
├── ContactController.php    → GET|POST /contact
├── PageController.php       → GET /association, /nos-actions, /faire-un-don, /page/{slug}
└── NewsletterController.php → POST /newsletter, GET /newsletter/unsubscribe/{token}
```

---

## 3. Palette de couleurs Tailwind (fichier `tailwind.config.fdf.js`)

Extraite du logo FDF. Ajouter dans `tailwind.config.js` → `theme.extend.colors`.

---

## 4. Schéma base de données — relations clés

```
users ──< articles (user_id)
categories ──< articles (category_id)
albums ──< gallery_items (album_id)
```

- `articles` : blog/actualités, avec catégorie, auteur, cover, SEO, compteur de vues.
- `albums` → `gallery_items` : galerie photo/vidéo avec support YouTube/Vimeo.
- `volunteers` / `contacts` : soumissions de formulaires avec statut et notes admin.
- `pages` : pages statiques éditables avec templates Blade interchangeables.
- `settings` : paramètres site (nom, email, réseaux sociaux, HelloAsso URL, logo…) 
  avec cache automatique. Accessible partout via `setting('key')`.
- `newsletter_subscribers` : inscriptions newsletter avec token de désinscription.

---

## 5. Déploiement sur LWS cPanel L

### Prérequis cPanel

1. Souscrire à **LWS cPanel L** (4,99 €/mois promo).
2. Enregistrer le domaine (`.org` recommandé, offert avec l'hébergement).
3. Activer **PHP 8.3** dans cPanel → « Sélectionner une version PHP ».
4. Créer une **base de données MySQL** + un utilisateur via cPanel → MySQL Databases.
5. Activer le **certificat SSL** (cPanel → SSL/TLS ou AutoSSL).

### Déployer le code

```bash
# Se connecter en SSH
ssh user@femmesdefoi.org

# Cloner le repo dans le home (PAS dans public_html directement)
cd ~
git clone https://votre-repo.git fdf

# Installer les dépendances PHP
cd fdf
composer install --no-dev --optimize-autoloader

# Configurer l'environnement
cp .env.example .env
nano .env  # renseigner DB, MAIL, APP_URL=https://femmesdefoi.org

php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=SettingsSeeder
php artisan db:seed --class=PageSeeder
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Créer l'admin
php artisan make:filament-user
```

### Pointer le document root vers `public/`

Dans cPanel → **Domaines** ou via `.htaccess` à la racine de `public_html` :

**Option A (recommandée)** — Symlink :
```bash
# Depuis public_html, pointer vers le dossier public de Laravel
cd ~/public_html
rm -rf *  # vider public_html (attention !)
ln -s ~/fdf/public/* .
# OU configurer le Document Root dans cPanel si possible
```

**Option B** — `.htaccess` redirect dans `public_html` :
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ fdf/public/$1 [L]
</IfModule>
```

**Option C (la plus propre)** — Déplacer le contenu de `public/` dans `public_html`
et ajuster les paths dans `index.php` :
```php
// public_html/index.php — modifier les paths :
require __DIR__.'/../fdf/vendor/autoload.php';
$app = require_once __DIR__.'/../fdf/bootstrap/app.php';
```

### CRON pour le scheduler Laravel

Dans cPanel → **Cron Jobs**, ajouter (toutes les minutes) :

```
* * * * * cd ~/fdf && php artisan schedule:run >> /dev/null 2>&1
```

### Permissions

```bash
chmod -R 775 ~/fdf/storage ~/fdf/bootstrap/cache
```

### Mises à jour futures

```bash
cd ~/fdf
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 6. Checklist avant mise en ligne

- [ ] `.env` : `APP_ENV=production`, `APP_DEBUG=false`
- [ ] `APP_URL` = domaine réel avec https
- [ ] SMTP Brevo configuré et testé
- [ ] HelloAsso URL renseignée dans les Settings
- [ ] Logo + favicon uploadés via Filament
- [ ] Pages (association, actions, dons, mentions, confidentialité) rédigées
- [ ] Certificat SSL actif
- [ ] CRON configuré
- [ ] Sauvegardes journalières activées (cPanel)
- [ ] `robots.txt` et `sitemap.xml` en place
- [ ] Test mobile (responsive) validé
- [ ] Bandeau cookies / RGPD fonctionnel
- [ ] Formulaires (contact, bénévole, newsletter) testés
