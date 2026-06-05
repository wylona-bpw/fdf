#!/usr/bin/env bash
# ============================================
# fdf-push.sh — Committer, pousser et déployer
# Usage :  bash fdf-push.sh "ton message de commit"
#          bash fdf-push.sh  (message par défaut "update")
# ============================================
set -euo pipefail

GREEN='\033[0;32m'; BLUE='\033[0;34m'; RED='\033[0;31m'; NC='\033[0m'
step() { echo -e "\n${BLUE}▶ $1${NC}"; }
ok()   { echo -e "  ${GREEN}✓${NC} $1"; }
die()  { echo -e "\n${RED}✗ $1${NC}\n"; exit 1; }

MSG="${1:-update}"

step "Compilation des assets (npm run build)"
npm run build || die "npm run build a échoué"
ok "Assets compilés"

step "Commit & push → GitHub"
git add .
if git diff --cached --quiet; then
    ok "Rien à committer"
else
    git commit -m "$MSG"
    ok "Commit : $MSG"
fi
git push origin main
ok "Poussé sur origin/main"

step "Déploiement sur amfdf.org"
ssh fdf "cd ~/fdf && bash deploy.sh"

echo -e "\n${GREEN}✓ En ligne sur https://amfdf.org${NC}\n"
