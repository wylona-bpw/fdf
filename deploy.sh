#!/usr/bin/env bash
#
# ===========================================================================
#  deploy.sh — Déploiement du site FDF (Mouvement des Femmes de Foi)
#  Cible : hébergement LWS cPanel (Terminal web)
#
#  Usage (dans le Terminal web cPanel) :
#     cd ~/fdf && bash deploy.sh
#
#  Options :
#     --no-migrate     Ne pas lancer les migrations
#     --maintenance    Activer le mode maintenance pendant le déploiement
#     -h | --help      Afficher l'aide
#
#  À committer dans le dépôt pour qu'il arrive sur le serveur via git pull.
# ===========================================================================

set -euo pipefail

# --------------------------- Configuration ---------------------------------
APP_DIR="${APP_DIR:-$HOME/fdf}"          # Dossier du projet Laravel
BRANCH="${BRANCH:-main}"                  # Branche git à déployer
PUBLIC_HTML="${PUBLIC_HTML:-$HOME/public_html}"
USE_MAINTENANCE=false                     # true = page maintenance pendant le déploiement
REBUILD_PUBLIC_SYMLINKS=true              # true = recréer build/ + storage/ dans public_html (Méthode 2 du guide)
RUN_MIGRATIONS=true

# --------------------------- Apparence -------------------------------------
if [ -t 1 ]; then
  GREEN='\033[0;32m'; YELLOW='\033[1;33m'; RED='\033[0;31m'; BLUE='\033[0;34m'; BOLD='\033[1m'; NC='\033[0m'
else
  GREEN=''; YELLOW=''; RED=''; BLUE=''; BOLD=''; NC=''
fi
step() { echo -e "\n${BLUE}${BOLD}▶ $1${NC}"; }
ok()   { echo -e "  ${GREEN}✓${NC} $1"; }
warn() { echo -e "  ${YELLOW}⚠${NC} $1"; }
die()  { echo -e "\n${RED}${BOLD}✗ $1${NC}\n"; exit 1; }

# --------------------------- Arguments -------------------------------------
for arg in "$@"; do
  case "$arg" in
    --no-migrate)  RUN_MIGRATIONS=false ;;
    --maintenance) USE_MAINTENANCE=true ;;
    -h|--help)
      awk 'NR==1{next} /^#/{sub(/^# ?/,""); print; next} {exit}' "$0"
      exit 0 ;;
    *) die "Option inconnue : $arg (voir --help)" ;;
  esac
done

# --------------------------- Détection PHP 8.x -----------------------------
detect_php() {
  local candidates=(
    /opt/cpanel/ea-php83/root/usr/bin/php
    /opt/cpanel/ea-php84/root/usr/bin/php
    /opt/cpanel/ea-php82/root/usr/bin/php
  )
  command -v php >/dev/null 2>&1 && candidates+=("$(command -v php)")
  local p ver maj min
  for p in "${candidates[@]}"; do
    [ -x "$p" ] || continue
    ver=$("$p" -r 'echo PHP_MAJOR_VERSION.".".PHP_MINOR_VERSION;' 2>/dev/null || echo "0.0")
    maj=${ver%%.*}; min=${ver#*.}
    if [ "$maj" -gt 8 ] || { [ "$maj" -eq 8 ] && [ "$min" -ge 2 ]; }; then
      echo "$p"; return 0
    fi
  done
  return 1
}

# --------------------------- Détection Composer ----------------------------
detect_composer() {
  command -v composer >/dev/null 2>&1 && { command -v composer; return 0; }
  local c
  for c in "$HOME/bin/composer" "$HOME/composer.phar" "$APP_DIR/composer.phar"; do
    [ -f "$c" ] && { echo "$c"; return 0; }
  done
  return 1
}

# ===========================================================================
#  DÉBUT
# ===========================================================================
echo -e "${BOLD}"
echo "  ╔══════════════════════════════════════════════╗"
echo "  ║   Déploiement — Mouvement des Femmes de Foi    ║"
echo "  ╚══════════════════════════════════════════════╝"
echo -e "${NC}"

# --- Pré-vérifications ---
step "Vérifications préalables"
[ -d "$APP_DIR" ]            || die "Dossier projet introuvable : $APP_DIR"
cd "$APP_DIR"
[ -d ".git" ]               || die "Ce n'est pas un dépôt git : $APP_DIR"
[ -f ".env" ]               || die "Fichier .env manquant. Crée-le avant le 1er déploiement."
[ -f "artisan" ]            || die "Fichier artisan introuvable : projet Laravel incomplet ?"
ok "Projet : $APP_DIR (branche cible : $BRANCH)"

PHP="$(detect_php)" || die "Aucun PHP 8.2+ trouvé. Vois l'étape 6 du guide (alias ea-php83)."
PHP_VER="$("$PHP" -r 'echo PHP_VERSION;')"
ok "PHP   : $PHP ($PHP_VER)"

COMPOSER="$(detect_composer)" || die "Composer introuvable. Vois l'étape 6 du guide pour l'installer."
ok "Composer : $COMPOSER"

# Helpers
art()          { "$PHP" "$APP_DIR/artisan" "$@"; }
composer_run() { "$PHP" "$COMPOSER" "$@"; }

# --- Mode maintenance (optionnel, avec remise en ligne garantie) ---
cleanup() {
  if [ "$USE_MAINTENANCE" = true ]; then
    art up >/dev/null 2>&1 || true
    ok "Site remis en ligne"
  fi
}
trap cleanup EXIT

if [ "$USE_MAINTENANCE" = true ]; then
  step "Activation du mode maintenance"
  art down --retry=15 >/dev/null 2>&1 || art down >/dev/null 2>&1 || warn "Impossible d'activer la maintenance (on continue)"
  ok "Mode maintenance actif"
fi

# --- Récupération du code ---
step "Récupération du code (git pull)"
CURRENT="$(git rev-parse --short HEAD 2>/dev/null || echo '?')"
git pull --ff-only origin "$BRANCH" || die "git pull a échoué (historique divergent ?). Résous manuellement."
NEW="$(git rev-parse --short HEAD 2>/dev/null || echo '?')"
if [ "$CURRENT" = "$NEW" ]; then ok "Déjà à jour ($NEW)"; else ok "Mis à jour : $CURRENT → $NEW"; fi

# --- Dépendances PHP ---
step "Installation des dépendances (composer)"
composer_run install --no-dev --optimize-autoloader --no-interaction --prefer-dist
ok "Dépendances installées"

# --- Nettoyage des caches avant migrations ---
step "Nettoyage des caches"
art optimize:clear >/dev/null
ok "Caches vidés"

# --- Migrations ---
if [ "$RUN_MIGRATIONS" = true ]; then
  step "Migrations de la base de données"
  art migrate --force
  ok "Migrations appliquées"
else
  warn "Migrations ignorées (--no-migrate)"
fi

# --- Liens publics (Méthode 2 : public_html → public/) ---
# NE JAMAIS lier index.php : il a des chemins ../fdf/... propres à ce serveur
# (public_html et fdf sont frères, pas imbriqués) — voir GUIDE_LWS_cPanel.md §8.
if [ "$REBUILD_PUBLIC_SYMLINKS" = true ] && [ -d "$PUBLIC_HTML" ]; then
  step "Mise à jour des liens dans public_html"
  if [ -d "$APP_DIR/public/build" ]; then
    ln -sfn "$APP_DIR/public/build" "$PUBLIC_HTML/build"
    ok "Lien build/ → public/build"
  else
    warn "public/build absent : pense à 'npm run build' en local puis commit."
  fi
  ln -sfn "$APP_DIR/storage/app/public" "$PUBLIC_HTML/storage"
  ok "Lien storage/ → storage/app/public"

  for asset in css fonts js images .htaccess favicon.ico apple-touch-icon.png robots.txt; do
    target="$PUBLIC_HTML/$asset"
    # Ne remplace que si ce n'est pas déjà un lien symbolique à jour, et jamais
    # un vrai dossier/fichier qu'on écraserait sans le vouloir silencieusement.
    if [ -e "$APP_DIR/public/$asset" ] && [ ! -L "$target" ]; then
      rm -rf "$target"
    fi
    if [ -e "$APP_DIR/public/$asset" ]; then
      ln -sfn "$APP_DIR/public/$asset" "$target"
    fi
  done
  ok "Liens css/fonts/js/images/.htaccess/favicon/robots.txt → public/"
fi

# Lien de stockage interne (inoffensif ; utile si Document Root = fdf/public)
art storage:link >/dev/null 2>&1 || true

# --- Reconstruction des caches de production ---
step "Reconstruction des caches de production"
art config:cache >/dev/null && ok "config"
art route:cache  >/dev/null 2>&1 && ok "routes" || warn "route:cache ignoré (closures dans les routes ?)"
art view:cache   >/dev/null && ok "vues"
art event:cache  >/dev/null 2>&1 || true

# --- Permissions ---
step "Permissions des dossiers inscriptibles"
chmod -R ug+rwX "$APP_DIR/storage" "$APP_DIR/bootstrap/cache" 2>/dev/null || warn "chmod partiel (sans gravité)"
ok "storage/ et bootstrap/cache/ OK"

# ===========================================================================
#  FIN
# ===========================================================================
echo -e "\n${GREEN}${BOLD}  ✓ Déploiement terminé avec succès${NC}"
echo -e "  ${BOLD}Commit déployé :${NC} $NEW"
echo -e "  ${BOLD}PHP :${NC} $PHP_VER"
echo -e "  ${BOLD}Site :${NC} $( "$PHP" -r 'echo getenv("APP_URL") ?: "(APP_URL non défini)";' 2>/dev/null )"
echo ""
