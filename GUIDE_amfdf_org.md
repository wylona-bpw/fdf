# Guide de mise en route — amfdf.org

> **Site du Mouvement des Femmes de Foi (FDF)**
> Hébergement : LWS cPanel M · Domaine : `amfdf.org`
> Stack : Laravel + Blade + Tailwind + Alpine.js + Filament + MySQL + Redis

---

## 0. Ton environnement réel

| Info | Valeur |
|---|---|
| Compte cPanel / utilisateur Linux | `c2809451c` |
| Domaine principal | `amfdf.org` |
| IP du serveur | `91.234.194.113` |
| Répertoire home | `/home/c2809451c` |
| Document root actuel | `/home/c2809451c/public_html` |
| cPanel | v134.0.35 (thème Jupiter) |
| Disque | 30 Go SSD |
| Bases MySQL | 5 |
| Bases PostgreSQL | 5 |
| E-mails | 5 |
| FTP | 1 |
| RAM max/compte | 4 Go |
| Processus max | 45 |

---

## 1. Activer le SSL (Let's Encrypt)

Le certificat est actuellement **auto-signé** — il faut installer un vrai certificat.

1. cPanel → **Sécurité** → **SSL/TLS Certificates** (ou **SSL/TLS Status** si disponible).
2. Cherche une option **Run AutoSSL** ou **Install Let's Encrypt** pour le domaine `amfdf.org`.
3. Lance-le. Let's Encrypt se provisionne en quelques minutes.
4. Vérifie en visitant `https://amfdf.org` — le cadenas doit être vert.

> Si après 3-4 h le certificat est encore auto-signé : le domaine est peut-être en cours de propagation DNS.
> Vérifie que `amfdf.org` résout bien vers `91.234.194.113` (commande `dig amfdf.org` depuis ton poste).
> En dernier recours, ouvre un ticket support LWS (le SSL est inclus et gratuit).

---

## 2. Configurer PHP 8.3 + extensions

1. cPanel → **Logiciel** → **Sélectionner une version de PHP**.
2. Choisis **PHP 8.3** dans le sélecteur et clique **Set as current**.
3. Onglet **Extensions** — coche au minimum :

```
bcmath, ctype, curl, fileinfo, gd, json,
mbstring, openssl, pdo, pdo_mysql, redis,
tokenizer, xml, zip
```

4. (Optionnel) Onglet **Options** :
   - `memory_limit` → `256M`
   - `max_execution_time` → `120`
   - `upload_max_filesize` → `20M` (pour les photos galerie)
   - `post_max_size` → `25M`

> Si l'extension `redis` n'apparaît pas dans la liste, pas de panique : on utilisera le client PHP pur
> `predis` (voir section .env). Si elle est là, coche-la — c'est mieux (plus rapide, natif).

---

## 3. Créer la base de données MySQL

1. cPanel → **Bases de données** → **Manage My Databases** (ou **MySQL Databases**).
2. **Créer une base** — nom : `fdf`

   → Elle devient : **`c2809451c_fdf`**

3. **Créer un utilisateur** — nom : `fdfuser`, mot de passe : *génère-en un fort et note-le*

   → Il devient : **`c2809451c_fdfuser`**

4. **Ajouter l'utilisateur à la base** → cocher **ALL PRIVILEGES** → **Make Changes**.

> Ces 3 valeurs iront dans ton `.env` (section 9).

---

## 4. Configurer l'accès SSH depuis ton poste Ubuntu

### 4.1 Vérifier / générer ta clé SSH locale

Sur ta machine Ubuntu (terminal local) :

```bash
# Vérifie si tu as déjà une clé
ls -la ~/.ssh/id_ed25519.pub

# Si le fichier n'existe pas, génère une clé :
ssh-keygen -t ed25519 -C "wilfried@amfdf.org"
# Appuie Entrée pour le chemin par défaut, puis choisis une passphrase (ou Entrée pour aucune).
```

Récupère le contenu de ta clé publique (tu vas le coller dans cPanel) :

```bash
cat ~/.ssh/id_ed25519.pub
# Copie la ligne entière (ssh-ed25519 AAAA... wilfried@amfdf.org)
```

### 4.2 Importer la clé dans cPanel

1. cPanel → **Sécurité** → **Accès SSH** → **Manage SSH Keys**.
2. Clique **Import Key**.
3. Champ **Name** : `ubuntu-workstation` (ou ce que tu veux).
4. Champ **Public Key** : colle la clé copiée (`ssh-ed25519 AAAA...`).
5. Laisse **Private Key** vide (elle reste sur ton poste, jamais sur le serveur).
6. Clique **Import**.
7. Retour à la liste des clés → sur ta clé publique, clique **Manage** → **Authorize**.

### 4.3 Configurer `~/.ssh/config` (connexion rapide)

Sur ton poste Ubuntu, crée ou édite `~/.ssh/config` :

```bash
nano ~/.ssh/config
```

Ajoute ce bloc :

```
# ============================================
# FDF — amfdf.org (LWS cPanel M)
# ============================================
Host fdf
    HostName 91.234.194.113
    User c2809451c
    Port 22
    IdentityFile ~/.ssh/id_ed25519
    ServerAliveInterval 60
    ServerAliveCountMax 3
```

Fixe les permissions (obligatoire, sinon SSH refuse) :

```bash
chmod 600 ~/.ssh/config
```

> **Si la connexion échoue sur le port 22** : vérifie le port réel dans cPanel → Accès SSH
> (certains hébergeurs LWS utilisent un port non standard, ex. 5022 ou 2222).
> Ajuste le `Port` dans le config en conséquence.

### 4.4 Tester la connexion SSH

```bash
ssh fdf
```

Tu devrais atterrir dans `/home/c2809451c` avec un prompt shell.

Vérifie l'environnement serveur :

```bash
# Version PHP en CLI (doit être 8.3.x)
php -v

# Si c'est une vieille version, crée un alias permanent :
echo "alias php='/opt/cpanel/ea-php83/root/usr/bin/php'" >> ~/.bashrc
source ~/.bashrc
php -v

# Composer
composer --version
# Si absent, installe-le :
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --install-dir=$HOME/bin --filename=composer
echo 'export PATH="$HOME/bin:$PATH"' >> ~/.bashrc
source ~/.bashrc
composer --version

# Git
git --version

# Redis (test de connexion)
redis-cli ping
# Réponse attendue : PONG (si Redis tourne sur le serveur)
```

> Si `redis-cli ping` échoue ou si la commande n'existe pas : Redis n'est peut-être pas activé
> au niveau serveur sur ton plan. Dans ce cas, on basculera le `.env` sur `CACHE_STORE=file`
> et `SESSION_DRIVER=file` (voir section 9).

### 4.5 Résumé après cette étape

Depuis ton poste Ubuntu, tu peux maintenant :

```bash
ssh fdf                            # connecter au serveur
ssh fdf "ls -la ~/fdf"             # exécuter une commande à distance
scp fichier.txt fdf:~/fdf/         # copier un fichier vers le serveur
rsync -avz ./public/build/ fdf:~/fdf/public/build/  # synchro d'un dossier
```

---

## 5. Préparer le dépôt Git et déployer le code

### 5.1 Créer le dépôt GitHub (privé)

Sur GitHub (ou GitLab), crée un dépôt privé nommé `fdf`.

### 5.2 Initialiser le projet en local

Sur ton poste Ubuntu :

```bash
# Créer le projet Laravel
composer create-project laravel/laravel fdf
cd fdf

# Installer Filament
composer require filament/filament
php artisan filament:install --panels

# Installer Intervention Image (compression photos)
composer require intervention/image

# Frontend
npm install tailwindcss @tailwindcss/forms alpinejs

# Copier le scaffold (migrations, modèles, controllers, routes, seeders, helpers)
# depuis le zip fdf-laravel-scaffold.zip que je t'ai fourni

# Helper global : ajouter dans composer.json → autoload → files :
# "files": ["app/Helpers/helpers.php"]
# puis :
composer dump-autoload

# IMPORTANT : autoriser le commit des assets compilés
# Retirer /public/build de .gitignore (sinon les assets ne seront pas sur le serveur)
sed -i '/\/public\/build/d' .gitignore

# Compiler les assets
npm run build

# Initialiser Git et pousser
git init
git add .
git commit -m "init: scaffold FDF"
git remote add origin https://github.com/ton-compte/fdf.git
git push -u origin main
```

### 5.3 Cloner sur le serveur

```bash
ssh fdf
cd ~
git clone https://github.com/ton-compte/fdf.git fdf
cd fdf
composer install --no-dev --optimize-autoloader
exit
```

---

## 6. Configurer Laravel sur le serveur

```bash
ssh fdf
cd ~/fdf

# Créer le .env (copie le contenu de la section 9 ci-dessous)
cp .env.example .env
nano .env  # ou vi, ou utilise le Gestionnaire de fichiers cPanel pour éditer

# Clé applicative
php artisan key:generate

# Migrations + seeders
php artisan migrate --force
php artisan db:seed --class=SettingsSeeder
php artisan db:seed --class=PageSeeder

# Lien de stockage (symlink public/storage → storage/app/public)
php artisan storage:link

# Caches de production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Créer le premier admin Filament
php artisan make:filament-user
# → entre ton nom, e-mail, mot de passe

# Permissions
chmod -R 775 storage bootstrap/cache

exit
```

---

## 7. Pointer le Document Root sur `fdf/public`

### Méthode 1 — Changer le Document Root (à tester d'abord)

1. cPanel → **Domaines** → **Domaines**.
2. Sur `amfdf.org`, clique **Gérer**.
3. Champ **Document Root** → remplace `public_html` par **`fdf/public`**.
4. Enregistre.
5. Visite `https://amfdf.org` — tu devrais voir la page Laravel.

### Méthode 2 — Si le Document Root est verrouillé

```bash
ssh fdf

# Copier index.php et .htaccess dans public_html
cp ~/fdf/public/index.php ~/public_html/index.php
cp ~/fdf/public/.htaccess ~/public_html/.htaccess
cp ~/fdf/public/robots.txt ~/public_html/robots.txt 2>/dev/null || true
cp ~/fdf/public/favicon.ico ~/public_html/favicon.ico 2>/dev/null || true

# Symlinks pour les assets et le storage
ln -sfn ~/fdf/public/build ~/public_html/build
ln -sfn ~/fdf/storage/app/public ~/public_html/storage

# Éditer index.php pour pointer vers ~/fdf
sed -i "s|__DIR__.'/../vendor|__DIR__.'/../fdf/vendor|" ~/public_html/index.php
sed -i "s|__DIR__.'/../bootstrap|__DIR__.'/../fdf/bootstrap|" ~/public_html/index.php

exit
```

---

## 8. Configurer le CRON (planificateur Laravel)

cPanel → **Avancé** → **Tâches Cron** → ajoute :

```
* * * * * /opt/cpanel/ea-php83/root/usr/bin/php /home/c2809451c/fdf/artisan schedule:run >> /dev/null 2>&1
```

> Si PHP 8.3 n'est pas à ce chemin, repère-le avec (en SSH) :
> `ls /opt/cpanel/ea-php*/root/usr/bin/php`

---

## 9. Fichier `.env` complet (copier-coller)

```env
APP_NAME="Mouvement des Femmes de Foi"
APP_ENV=production
APP_DEBUG=false
APP_TIMEZONE=Europe/Paris
APP_URL=https://amfdf.org

APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr

LOG_CHANNEL=daily
LOG_LEVEL=warning

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=c2809451c_fdf
DB_USERNAME=c2809451c_fdfuser
DB_PASSWORD=____MOT_DE_PASSE_DB____

SESSION_DRIVER=redis
SESSION_LIFETIME=120

CACHE_STORE=redis
QUEUE_CONNECTION=redis

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=____LOGIN_BREVO____
MAIL_PASSWORD=____CLE_SMTP_BREVO____
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contact@amfdf.org
MAIL_FROM_NAME="Mouvement des Femmes de Foi"

FILESYSTEM_DISK=local
```

> **Si Redis ne fonctionne pas** (connexion refusée), remplace les 3 lignes Redis par :
> ```
> SESSION_DRIVER=file
> CACHE_STORE=file
> QUEUE_CONNECTION=database
> ```
> puis `php artisan config:cache`.

---

## 10. Automatismes de travail quotidien

### 10.1 Alias bash sur ton poste Ubuntu

Ajoute dans `~/.bashrc` (ou `~/.zshrc`) :

```bash
# ============================================
# FDF — amfdf.org (raccourcis)
# ============================================
alias fdf-ssh='ssh fdf'
alias fdf-deploy='ssh fdf "cd ~/fdf && bash deploy.sh"'
alias fdf-deploy-nm='ssh fdf "cd ~/fdf && bash deploy.sh --no-migrate"'
alias fdf-logs='ssh fdf "tail -100f ~/fdf/storage/logs/laravel.log"'
alias fdf-down='ssh fdf "cd ~/fdf && php artisan down"'
alias fdf-up='ssh fdf "cd ~/fdf && php artisan up"'
alias fdf-tinker='ssh -t fdf "cd ~/fdf && php artisan tinker"'
alias fdf-clear='ssh fdf "cd ~/fdf && php artisan optimize:clear"'
alias fdf-migrate='ssh fdf "cd ~/fdf && php artisan migrate --force"'
```

Puis `source ~/.bashrc`. Tu peux maintenant :

```bash
fdf-ssh           # Se connecter au serveur
fdf-deploy        # Déployer en une commande (git pull + composer + migrate + caches)
fdf-deploy-nm     # Déployer sans migrations
fdf-logs          # Suivre les logs Laravel en temps réel
fdf-down          # Activer la maintenance
fdf-up            # Désactiver la maintenance
fdf-tinker        # Ouvrir Tinker interactif
fdf-clear         # Vider tous les caches
fdf-migrate       # Lancer les migrations
```

### 10.2 Script de déploiement local : `fdf-push.sh`

Crée ce fichier **à la racine de ton projet local** (`~/Dev/fdf/fdf-push.sh`) :

```bash
#!/usr/bin/env bash
# ============================================
# fdf-push.sh — Committer, pousser et déployer
# Usage :  bash fdf-push.sh "ton message de commit"
#          bash fdf-push.sh  (message par défaut "update")
# ============================================
set -euo pipefail

GREEN='\033[0;32m'; BLUE='\033[0;34m'; NC='\033[0m'
step() { echo -e "\n${BLUE}▶ $1${NC}"; }
ok()   { echo -e "${GREEN}✓ $1${NC}"; }

MSG="${1:-update}"

step "Compilation des assets (npm run build)"
npm run build
ok "Assets compilés"

step "Commit & push → GitHub"
git add .
git diff --cached --quiet && { echo "  Rien à committer."; } || {
    git commit -m "$MSG"
    ok "Commit : $MSG"
}
git push origin main
ok "Poussé sur origin/main"

step "Déploiement sur amfdf.org"
ssh fdf "cd ~/fdf && bash deploy.sh"

echo -e "\n${GREEN}✓ En ligne sur https://amfdf.org${NC}\n"
```

```bash
chmod +x fdf-push.sh
```

Utilisation :

```bash
# Depuis ton dossier projet local :
bash fdf-push.sh "ajout page actualités"
# → compile les assets, commit, push, déploie en une seule commande.
```

### 10.3 Raccourci global (optionnel)

Si tu veux appeler `fdf-push` de n'importe quel dossier, ajoute dans `~/.bashrc` :

```bash
alias fdf-push='cd ~/Dev/fdf && bash fdf-push.sh'
```

> Remplace `~/Dev/fdf` par le chemin réel de ton projet local.

---

## 11. Créer les adresses e-mail

cPanel → **E-mail** → **Comptes de messagerie** → créer :

| Adresse | Usage |
|---|---|
| `contact@amfdf.org` | Formulaire de contact + MAIL_FROM |
| `info@amfdf.org` | Communication générale |
| `admin@amfdf.org` | Administration / Filament |

> Tu as 5 adresses max sur cPanel M. Crée les plus utiles maintenant, les autres viendront avec l'upgrade.

---

## 12. Workflow quotidien résumé

```
┌─────────────────────┐       git push       ┌────────────────────┐
│  TON POSTE UBUNTU   │ ──────────────────▶   │     GITHUB         │
│  php artisan serve   │                      │   dépôt privé fdf  │
│  npm run dev         │                      └────────┬───────────┘
│  code, test, commit  │                               │
└─────────────────────┘                      ssh fdf   │ git pull
                                             "deploy"  │
                                                       ▼
                                             ┌────────────────────┐
                                             │  SERVEUR LWS       │
                                             │  amfdf.org          │
                                             │  /home/c2809451c/fdf│
                                             └────────────────────┘
```

1. **Développer en local** : `php artisan serve` + `npm run dev`
2. **Tester** : `http://localhost:8000`
3. **Déployer** : `bash fdf-push.sh "description des changements"`

C'est tout. Le script fait le reste (compile, commit, push, déploie via SSH).

---

## 13. Checklist de mise en ligne

- [ ] SSL actif (cadenas vert sur `https://amfdf.org`)
- [ ] PHP 8.3 avec extensions cochées (dont `redis`)
- [ ] Base `c2809451c_fdf` créée avec utilisateur + tous privilèges
- [ ] Clé SSH importée et autorisée dans cPanel
- [ ] `ssh fdf` fonctionne depuis ton poste
- [ ] Code cloné dans `/home/c2809451c/fdf`
- [ ] `.env` configuré (`APP_DEBUG=false`, DB, Redis, Brevo, `APP_URL=https://amfdf.org`)
- [ ] `php artisan key:generate` fait
- [ ] Migrations + seeders passés
- [ ] `storage:link` fait
- [ ] Caches générés (`config:cache`, `route:cache`, `view:cache`)
- [ ] Admin Filament créé (`make:filament-user`)
- [ ] Document Root = `fdf/public` (ou méthode 2 appliquée)
- [ ] CRON configuré (`schedule:run` toutes les minutes)
- [ ] `https://amfdf.org` affiche le site
- [ ] `https://amfdf.org/admin` affiche le panel Filament
- [ ] Formulaire contact testé (mail reçu via Brevo)
- [ ] `deploy.sh` fonctionne (`fdf-deploy` depuis ton poste)
- [ ] Sauvegardes auto activées (cPanel → Sauvegardes)

---

## 14. Dépannage

| Symptôme | Cause probable | Solution |
|---|---|---|
| `ssh fdf` → connexion refusée | Mauvais port | Vérifie le port dans cPanel → Accès SSH, ajuste `~/.ssh/config` |
| `ssh fdf` → permission denied | Clé non autorisée | cPanel → Accès SSH → Manage Keys → Authorize |
| Erreur 500 page blanche | Clé manquante ou cache obsolète | `fdf-ssh` puis `php artisan key:generate && php artisan config:clear` |
| 403 / page « It works » | Mauvais document root | Appliquer section 7 |
| Images cassées | Symlink storage absent | `ssh fdf "ln -sfn ~/fdf/storage/app/public ~/public_html/storage"` |
| CSS/JS absents | Assets non compilés | `npm run build` localement, commit, `fdf-deploy` |
| « could not find driver » | Extension `pdo_mysql` manquante | La cocher dans Sélectionner une version de PHP |
| Redis connection refused | Redis pas dispo sur le serveur | Basculer `.env` sur `file`/`database` (voir section 9) |
| Composer échoue (mémoire) | Limite CLI | `php -d memory_limit=-1 composer install --no-dev` |
| PHP CLI = 8.1 au lieu de 8.3 | Alias non posé | `echo "alias php='/opt/cpanel/ea-php83/root/usr/bin/php'" >> ~/.bashrc && source ~/.bashrc` |
| `fdf-deploy` → host key changed | IP serveur changée | `ssh-keygen -R 91.234.194.113` puis reconnecter |
| `npm run build` échoue | Node.js trop vieux | `nvm use 20` ou `nvm install 20` |
