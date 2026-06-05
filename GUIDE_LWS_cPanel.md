# Guide de configuration LWS cPanel & déploiement — Site FDF

> Procédure complète, de la souscription jusqu'au site en ligne, sur **LWS cPanel M**.
> Tout se pilote depuis l'espace client LWS (`panel.lws.fr`) et l'interface cPanel.

---

## 0. À savoir avant de commencer (important)

Sur les formules **cPanel M et L**, l'accès **SSH externe** (depuis ton terminal Ubuntu ou PuTTY)
**n'est PAS disponible** — il est réservé à la formule **cPanel XL**.

**Mais ce n'est pas bloquant.** Les formules M et L disposent du **Terminal web** :
un vrai shell Bash accessible directement dans cPanel (icône « Terminal »), depuis lequel
tu lances `git`, `composer` et `php artisan`. C'est ton outil de travail principal sur le serveur.

| Tâche | cPanel M / L | cPanel XL |
|---|---|---|
| Terminal web (dans le navigateur) | ✅ | ✅ |
| SSH externe (terminal local, PuTTY, rsync, scp) | ❌ | ✅ |
| composer / git / artisan | ✅ (via Terminal web) | ✅ |

→ **On part sur cPanel M.** Si un jour tu veux le confort du SSH local + déploiements scriptés,
tu upgraderas vers XL depuis l'espace client (sans migration de données).

---

## 1. Souscrire à cPanel M

1. Va sur `https://www.lws.fr/hebergement-cpanel.php`
2. Choisis **cPanel M** (2,99 €/mois la 1ʳᵉ année).
3. Pendant la commande : enregistre le **nom de domaine offert** (recommandé : un `.org`,
   ex. `femmesdefoi.org`). Si le domaine est déjà pris ailleurs, tu pourras le rattacher après.
4. Finalise et paie. Tu reçois un e-mail avec tes accès **espace client LWS** et,
   séparément, tes accès **cPanel**.

---

## 2. Accéder à l'espace LWS et à cPanel

1. Connecte-toi à `https://panel.lws.fr` (espace client LWS).
2. Tu vois la liste de tes hébergements & domaines.
3. Derrière ta formule cPanel, clique sur **Gérer**.
4. Clique sur **cPanel** (ou « Accéder à cPanel ») pour ouvrir l'interface cPanel.

> Garde sous la main : l'**identifiant cPanel** (souvent type `femmesXXXX`) et son mot de passe.
> C'est aussi ton nom d'utilisateur Linux (`~` = `/home/femmesXXXX`).

---

## 3. Pointer le domaine + activer le HTTPS (SSL)

### 3.1 Le domaine
- **Domaine pris chez LWS** : il est déjà rattaché automatiquement à l'hébergement. Rien à faire.
- **Domaine pris ailleurs** : dans l'espace client LWS → gestion du domaine → **Zone DNS**,
  fais pointer l'enregistrement **A** vers l'IP de ton hébergement (visible dans cPanel,
  colonne de droite « Informations générales »). Compte 1 à 4 h de propagation.

### 3.2 Le certificat SSL
1. Dans cPanel → section **Sécurité** → **SSL/TLS Status** (ou **AutoSSL**).
2. Sélectionne ton domaine et clique **Run AutoSSL** (Let's Encrypt gratuit).
3. Vérifie que le cadenas est actif en visitant `https://tondomaine.org`.

---

## 4. Régler la version PHP (8.3) + extensions

1. Dans cPanel → section **Logiciels** → **Sélectionner une version PHP**
   (ou **MultiPHP Manager**).
2. Choisis **PHP 8.3** pour ton domaine et **Applique / Set as current**.
3. Onglet **Extensions** : assure-toi que ces extensions Laravel sont **cochées** :
   `openssl`, `pdo`, `pdo_mysql`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`,
   `bcmath`, `fileinfo`, `curl`, `gd` (ou `imagick` pour Intervention Image), `zip`.
4. (Optionnel) Onglet **Options** : passe `memory_limit` à 256M et `max_execution_time` à 120
   si besoin pour les imports.

---

## 5. Créer la base de données MySQL

1. Dans cPanel → section **Bases de données** → **Bases de données MySQL**.
2. **Créer une base** : nom `fdf` → elle devient `femmesXXXX_fdf` (préfixe ajouté auto).
3. **Créer un utilisateur** : nom `fdfuser` → devient `femmesXXXX_fdfuser`.
   Génère un **mot de passe fort** et note-le.
4. **Ajouter l'utilisateur à la base** : sélectionne l'utilisateur + la base → **Tous les privilèges**.
5. Note précieusement les **3 valeurs** (tu les mettras dans `.env`) :
   ```
   DB_DATABASE = femmesXXXX_fdf
   DB_USERNAME = femmesXXXX_fdfuser
   DB_PASSWORD = ********
   DB_HOST     = localhost
   ```

> phpMyAdmin est disponible dans cPanel → **Bases de données** → **phpMyAdmin** (utile pour vérifier/importer).

---

## 6. Le Terminal web cPanel (ton outil de travail serveur)

1. Dans cPanel → section **Avancé** (ou **Logiciels**) → icône **Terminal**.
2. La console s'ouvre dans le navigateur — aucun mot de passe à ressaisir.
3. **Vérifie la version PHP en ligne de commande** :
   ```bash
   php -v
   ```
   Si ce n'est PAS 8.3, repère le bon binaire et crée un alias :
   ```bash
   ls /opt/cpanel/ea-php*/root/usr/bin/php
   echo "alias php='/opt/cpanel/ea-php83/root/usr/bin/php'" >> ~/.bashrc
   source ~/.bashrc
   php -v   # doit afficher PHP 8.3.x
   ```
4. **Vérifie Composer et Git** :
   ```bash
   composer --version
   git --version
   ```
   Si `composer` est introuvable, installe-le dans ton home :
   ```bash
   cd ~
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   php composer-setup.php --install-dir=$HOME/bin --filename=composer
   echo 'export PATH="$HOME/bin:$PATH"' >> ~/.bashrc
   source ~/.bashrc
   composer --version
   ```

---

## 7. Déposer le code sur le serveur

### Méthode A — Git (recommandée)
Pré-requis : ton projet est sur GitHub/GitLab (dépôt privé conseillé).
```bash
cd ~                       # /home/femmesXXXX
git clone https://github.com/ton-compte/fdf.git fdf
cd fdf
composer install --no-dev --optimize-autoloader
```

### Méthode B — Upload manuel (sans dépôt git)
1. En local : `composer install --no-dev` puis zippe **tout le projet** (vendor inclus).
2. cPanel → **Gestionnaire de fichiers** → dans `/home/femmesXXXX`, **Téléverser** le zip.
3. Clic droit → **Extraire**. Renomme le dossier en `fdf`.

> On installe le projet dans `~/fdf` (le **home**), PAS directement dans `public_html`,
> pour que le code de l'application ne soit jamais accessible publiquement.

---

## 8. Configurer la structure des dossiers (le point délicat)

Laravel sert le site depuis son dossier `public/`, alors que cPanel sert le web depuis
`~/public_html`. Deux méthodes selon ce que ton cPanel autorise.

### Méthode 1 — Changer le « Document Root » (la plus propre, à tester d'abord)
1. cPanel → section **Domaines** → **Domaines** (interface récente).
2. Sur ton domaine, clique **Gérer** → champ **Document Root**.
3. Mets : `fdf/public` → **Enregistrer**.
4. Terminé : Laravel est servi directement, rien d'autre à déplacer.

> Si le champ Document Root est **verrouillé** pour le domaine principal, passe à la Méthode 2.

### Méthode 2 — Copier `public/` + ajuster `index.php` (marche partout)
Dans le **Terminal web** :
```bash
# 1. Copier le contenu de public/ vers public_html
cp -r ~/fdf/public/. ~/public_html/

# 2. Lier les assets et le stockage par symlink (évite de recopier après chaque build)
rm -rf ~/public_html/build ~/public_html/storage
ln -s ~/fdf/public/build       ~/public_html/build
ln -s ~/fdf/storage/app/public ~/public_html/storage
```
Puis édite `~/public_html/index.php` (Gestionnaire de fichiers → clic droit → Modifier)
et corrige les **deux chemins** pour pointer vers `../fdf` :
```php
require __DIR__.'/../fdf/vendor/autoload.php';

$app = require_once __DIR__.'/../fdf/bootstrap/app.php';
```
Le `.htaccess` (copié depuis `public/`) est déjà en place dans `public_html`.

---

## 9. Configurer Laravel (.env, clé, migrations, caches)

Dans le **Terminal web**, depuis `~/fdf` :
```bash
cd ~/fdf
cp .env.example .env
```
Édite `.env` (via Gestionnaire de fichiers ou `nano .env`) :
```env
APP_NAME="Mouvement des Femmes de Foi"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://femmesdefoi.org

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=femmesXXXX_fdf
DB_USERNAME=femmesXXXX_fdfuser
DB_PASSWORD=ton_mot_de_passe

MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=ton_login_brevo
MAIL_PASSWORD=ta_cle_smtp_brevo
MAIL_FROM_ADDRESS=contact@femmesdefoi.org
MAIL_FROM_NAME="Mouvement des Femmes de Foi"
```
Puis :
```bash
php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=SettingsSeeder
php artisan db:seed --class=PageSeeder

# Lien de stockage : si Méthode 1, utilise la commande ;
# si Méthode 2, le symlink est déjà fait à l'étape 8, ignore cette ligne.
php artisan storage:link

# Caches de production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Premier compte administrateur Filament
php artisan make:filament-user
```
Permissions (au cas où) :
```bash
chmod -R 775 ~/fdf/storage ~/fdf/bootstrap/cache
```

Vérifie : `https://femmesdefoi.org` (site) et `https://femmesdefoi.org/admin` (back-office Filament).

---

## 10. Programmer le CRON (planificateur Laravel)

Pour la file d'attente newsletter, les nettoyages, etc.

1. cPanel → section **Avancé** → **Tâches Cron** (Cron Jobs).
2. Ajoute une tâche **toutes les minutes** :
   ```
   * * * * * /opt/cpanel/ea-php83/root/usr/bin/php /home/femmesXXXX/fdf/artisan schedule:run >> /dev/null 2>&1
   ```
   (adapte le chemin PHP et `femmesXXXX` à ton compte).

---

## 11. Ton workflow de travail au quotidien

**En local (ton poste Ubuntu)** — développement normal :
```bash
php artisan serve        # http://localhost:8000
npm run dev              # assets en direct
# tu codes, tu testes, tu commits
git add . && git commit -m "..." && git push origin main
```

**Sur le serveur (Terminal web cPanel)** — pour publier une mise à jour :
```bash
cd ~/fdf
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:cache && php artisan route:cache && php artisan view:cache
```
> Les assets front (`public/build`) doivent être **compilés en local** (`npm run build`)
> et commités, car il n'y a pas de Node.js exploitable côté mutualisé. Le symlink `build`
> (Méthode 2) les rend visibles automatiquement après `git pull`.

---

## 12. Plan B si le Terminal web est restreint

Certains hébergements mutualisés brident le shell (pas de `composer`, commandes limitées).
Si c'est le cas sur ton cPanel M :

1. Lance `composer install --no-dev` **en local**, et téléverse le dossier **`vendor/`** complet
   via le Gestionnaire de fichiers (ou FTP).
2. Pour les commandes artisan indispensables :
   - `php artisan migrate` → si bloqué, **exporte ta base locale** (phpMyAdmin local → SQL)
     et **importe-la** dans phpMyAdmin cPanel.
   - `php artisan key:generate` → génère la clé en local et **copie `APP_KEY`** dans le `.env` du serveur.
   - `config:cache` / `route:cache` → optionnels ; tu peux t'en passer au début.
3. `storage:link` → remplace par le **symlink manuel** de l'étape 8, ou crée le lien
   via le Gestionnaire de fichiers.

> En pratique, le Terminal web cPanel de LWS permet généralement composer/git/artisan.
> Ce plan B n'est qu'une sécurité.

---

## 13. Checklist de mise en ligne & dépannage

### Checklist
- [ ] `APP_ENV=production`, `APP_DEBUG=false` dans `.env`
- [ ] SSL actif (cadenas vert)
- [ ] Base de données créée + utilisateur rattaché (tous privilèges)
- [ ] PHP 8.3 actif (web **et** CLI)
- [ ] Document root = `fdf/public` **ou** méthode 2 appliquée
- [ ] `storage:link` (ou symlink manuel) OK → les images s'affichent
- [ ] CRON configuré
- [ ] SMTP Brevo testé (formulaire contact reçu)
- [ ] HelloAsso renseigné dans les réglages (back-office)
- [ ] Caches générés (`config/route/view:cache`)
- [ ] Sauvegardes journalières actives (incluses cPanel M)

### Pannes courantes
| Symptôme | Cause probable | Solution |
|---|---|---|
| **Erreur 500** page blanche | clé manquante / cache obsolète | `php artisan key:generate` puis `php artisan config:clear` |
| **403 / page « It works »** | mauvais document root | appliquer étape 8 |
| **Images cassées** | symlink storage absent | refaire `ln -s ~/fdf/storage/app/public ~/public_html/storage` |
| **CSS/JS absents** | assets non compilés | `npm run build` en local + commit + `git pull` |
| **« could not find driver »** | extension `pdo_mysql` désactivée | la cocher dans Sélectionner une version PHP |
| **Composer échoue (mémoire)** | limite CLI | `php -d memory_limit=-1 composer install --no-dev` |
| **PHP CLI = 8.1** au lieu de 8.3 | alias non posé | refaire l'alias `~/.bashrc` (étape 6) |

---

### Récap des accès à conserver
- Espace client LWS : `panel.lws.fr`
- cPanel : via espace client → Gérer → cPanel
- Identifiant cPanel / Linux : `femmesXXXX`
- Base : `femmesXXXX_fdf` / user `femmesXXXX_fdfuser`
- Admin du site : `https://femmesdefoi.org/admin`
