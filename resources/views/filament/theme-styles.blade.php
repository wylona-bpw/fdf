{{-- ============================================================
     THÈME AMFDF — Filament Admin
     Injecté via PanelsRenderHook::HEAD_END
     Cible : Filament 3+ (sélecteurs .fi-*) avec fallbacks universels
     ============================================================ --}}

{{-- Polices --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

<style>
/* ============================================================
   VARIABLES — palette FDF
   ============================================================ */
:root {
    --fdf-blue:       #16348C;
    --fdf-blue-dk:    #0C1F54;
    --fdf-blue-ddk:   #081538;
    --fdf-blue-lt:    #2E55B0;
    --fdf-gold:       #D9A521;
    --fdf-gold-lt:    #F0CD72;
    --fdf-gold-dk:    #B0851A;
    --fdf-cream:      #FAF7F0;
    --fdf-ink:        #1F2937;
    --fdf-ink-soft:   #4B5563;
    --fdf-line:       #E5E7EB;
    --fdf-bg:         #F8F7F4;

    --fdf-font-display: 'Playfair Display', Georgia, 'Times New Roman', serif;
    --fdf-font-sans:    'DM Sans', system-ui, -apple-system, sans-serif;

    --fdf-shadow-sm: 0 1px 2px rgba(8, 21, 56, 0.04), 0 1px 1px rgba(8, 21, 56, 0.03);
    --fdf-shadow-md: 0 4px 12px rgba(8, 21, 56, 0.06), 0 2px 4px rgba(8, 21, 56, 0.04);
    --fdf-shadow-lg: 0 12px 32px rgba(8, 21, 56, 0.10), 0 4px 8px rgba(8, 21, 56, 0.05);
}

/* ============================================================
   BASE — typo globale
   ============================================================ */
html, body, .fi-body {
    font-family: var(--fdf-font-sans);
    font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    background: var(--fdf-bg);
}

/* Titres en Playfair Display partout */
.fi-header-heading,
.fi-section-header-heading,
.fi-modal-heading,
.fi-page-heading,
h1.fi-header-heading,
h2.fi-header-heading,
.fi-form-section .fi-section-header-heading {
    font-family: var(--fdf-font-display) !important;
    font-weight: 600 !important;
    letter-spacing: -0.01em !important;
    color: var(--fdf-blue-dk) !important;
}

.fi-header-heading {
    font-size: 1.875rem !important;
    line-height: 1.2 !important;
}

/* ============================================================
   LOGIN — layout simple via padding-left du body
   ============================================================ */

/* Reset complet sur la page d'authentification */
html.fdf-is-login,
html.fdf-is-login body,
.fi-simple-layout,
.fi-simple-layout body,
body:has(.fi-simple-main) {
    background: #ffffff !important;
    margin: 0 !important;
}

/* La carte du formulaire — épurée */
.fi-simple-main {
    width: 100% !important;
    max-width: 480px !important;
    background: transparent !important;
    box-shadow: none !important;
    border: none !important;
    padding: 0 !important;
    margin: 0 auto !important;
}

/* Wrappers internes : pas de contrainte */
.fi-simple-main-ctn,
.fi-simple-main > div,
.fi-simple-main section,
.fi-simple-main form {
    background: transparent !important;
    box-shadow: none !important;
    border: none !important;
    width: 100% !important;
    max-width: none !important;
    padding: 0 !important;
}

.fi-simple-main .fi-fo-component-ctn,
.fi-simple-main .fi-form > div {
    margin-bottom: 1.25rem !important;
}

/* Cache le logo Filament par défaut */
.fi-simple-page .fi-logo,
.fi-simple-header {
    display: none !important;
}

/* ----- Page login en mode mobile (et défaut) ----- */
.fi-simple-page {
    background: #ffffff !important;
    min-height: 100vh !important;
    width: 100% !important;
    max-width: none !important;
    margin: 0 !important;
    padding: 2rem !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    box-sizing: border-box !important;
}

/* ----- Desktop : split via padding-left sur le body ----- */
@media (min-width: 1024px) {

    /* Push tout le contenu Filament vers la moitié droite */
    html.fdf-is-login body,
    html.fdf-is-login body.fi-body {
        padding-left: 50vw !important;
        margin: 0 !important;
        box-sizing: border-box !important;
        min-height: 100vh !important;
    }

    /* Le brand panel reste en position fixed sur la gauche (hors-flow) */
    html.fdf-is-login .fdf-login-side {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 50vw !important;
        height: 100vh !important;
        z-index: 1;
    }

    /* Tous les wrappers Filament : largeur libre, pas de max-width restrictif */
    html.fdf-is-login .fi-simple-layout,
    html.fdf-is-login .fi-body,
    html.fdf-is-login main,
    html.fdf-is-login .fi-main {
        max-width: none !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /* La page de login : centre le formulaire dans la moitié droite */
    html.fdf-is-login .fi-simple-page {
        padding: 3rem 4rem !important;
        min-height: 100vh !important;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        box-sizing: border-box !important;
    }

    html.fdf-is-login .fi-simple-main {
        max-width: 480px !important;
        width: 100% !important;
    }
}

/* Cache le logo Filament par défaut sur la page de login (on a notre header) */
.fi-simple-page .fi-logo,
.fi-simple-header {
    display: none !important;
}

/* Header au-dessus du form */
.fdf-login-header {
    margin-bottom: 2.5rem;
    text-align: left;
}

.fdf-login-header__kicker {
    font-family: var(--fdf-font-sans);
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--fdf-gold-dk);
    margin: 0 0 0.5rem;
}

.fdf-login-header__title {
    font-family: var(--fdf-font-display);
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.1;
    color: var(--fdf-blue-dk);
    margin: 0 0 0.75rem;
    letter-spacing: -0.02em;
}

.fdf-login-header__subtitle {
    font-size: 0.95rem;
    color: var(--fdf-ink-soft);
    margin: 0;
    line-height: 1.6;
}

/* ============================================================
   LOGIN SIDE — panneau brand gauche
   ============================================================ */
.fdf-login-side {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 50vw;
    height: 100vh;
    background: linear-gradient(135deg, var(--fdf-blue-ddk) 0%, var(--fdf-blue-dk) 45%, var(--fdf-blue) 100%);
    color: #ffffff;
    overflow: hidden;
    z-index: 1;
}

@media (min-width: 1024px) {
    .fdf-login-side {
        display: block;
    }
}

.fdf-login-side__pattern {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
}

.fdf-login-side__overlay {
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at top right, rgba(217, 165, 33, 0.08), transparent 60%);
    pointer-events: none;
}

.fdf-login-side__inner {
    position: relative;
    z-index: 2;
    height: 100%;
    padding: 4rem 4rem 3rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.fdf-login-side__logo {
    flex-shrink: 0;
}

.fdf-login-side__title h1 {
    font-family: var(--fdf-font-display);
    font-size: 3.25rem;
    font-weight: 700;
    line-height: 1.05;
    margin: 0 0 1rem;
    letter-spacing: -0.02em;
}

.fdf-login-side__title h1 span {
    color: var(--fdf-gold-lt);
    font-style: italic;
}

.fdf-login-side__tagline {
    font-family: var(--fdf-font-sans);
    font-size: 0.875rem;
    letter-spacing: 0.25em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.55);
    margin: 0;
    font-weight: 500;
}

/* Verset central */
.fdf-login-side__verse {
    position: relative;
    border-left: 3px solid var(--fdf-gold);
    padding: 0.5rem 0 0.5rem 1.75rem;
    max-width: 26rem;
}

.fdf-login-side__quote-mark {
    position: absolute;
    top: -1.5rem;
    left: 1rem;
    font-family: var(--fdf-font-display);
    font-size: 5rem;
    color: var(--fdf-gold);
    opacity: 0.4;
    line-height: 1;
}

.fdf-login-side__verse-text {
    font-family: var(--fdf-font-display);
    font-size: 1.5rem;
    font-style: italic;
    font-weight: 500;
    line-height: 1.45;
    color: rgba(255, 255, 255, 0.92);
    margin: 0 0 0.75rem;
}

.fdf-login-side__verse-ref {
    font-family: var(--fdf-font-sans);
    font-size: 0.875rem;
    font-weight: 500;
    letter-spacing: 0.1em;
    color: var(--fdf-gold-lt);
    margin: 0;
}

.fdf-login-side__footer {
    border-top: 1px solid rgba(217, 165, 33, 0.2);
    padding-top: 1.5rem;
}

.fdf-login-side__footer p {
    margin: 0 0 0.5rem;
    font-style: italic;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.95rem;
}

.fdf-login-side__copyright {
    font-style: normal !important;
    font-size: 0.75rem !important;
    color: rgba(255, 255, 255, 0.4) !important;
    letter-spacing: 0.05em;
}

/* ============================================================
   FORMULAIRES — login + intérieur du panel
   ============================================================ */

/* Labels */
.fi-fo-field-wrp-label,
label.fi-fo-field-wrp-label,
.fi-form label {
    font-family: var(--fdf-font-sans) !important;
    font-weight: 500 !important;
    font-size: 0.875rem !important;
    color: var(--fdf-ink) !important;
    margin-bottom: 0.5rem !important;
}

/* Inputs — bordures plus subtiles, focus bleu FDF */
.fi-input,
input.fi-input,
textarea.fi-input,
.fi-select-input,
.fi-input-wrp,
.fi-fo-input-wrp {
    border-color: var(--fdf-line) !important;
    border-radius: 0.625rem !important;
    transition: all 0.2s ease !important;
    background: #ffffff !important;
}

.fi-input-wrp:focus-within,
.fi-fo-input-wrp:focus-within {
    border-color: var(--fdf-blue) !important;
    box-shadow: 0 0 0 3px rgba(22, 52, 140, 0.1) !important;
}

.fi-input:focus,
input.fi-input:focus,
textarea.fi-input:focus {
    border-color: var(--fdf-blue) !important;
    box-shadow: 0 0 0 3px rgba(22, 52, 140, 0.1) !important;
    outline: none !important;
}

/* Inputs sur la page de login plus grands */
.fi-simple-main .fi-input,
.fi-simple-main input.fi-input {
    padding: 0.875rem 1rem !important;
    font-size: 1rem !important;
}

/* ============================================================
   BOUTONS — primaire = or, refined hover
   ============================================================ */
.fi-btn {
    font-family: var(--fdf-font-sans) !important;
    font-weight: 600 !important;
    letter-spacing: 0.01em !important;
    border-radius: 0.625rem !important;
    transition: all 0.2s ease !important;
    box-shadow: var(--fdf-shadow-sm) !important;
}

.fi-btn-size-md {
    padding: 0.625rem 1.25rem !important;
}

.fi-btn-size-lg {
    padding: 0.875rem 1.5rem !important;
    font-size: 0.95rem !important;
}

/* Bouton primaire (par défaut bleu FDF) */
.fi-btn-color-primary,
.fi-btn[wire\\:loading\\.attr=disabled] {
    background-color: var(--fdf-blue) !important;
    color: #ffffff !important;
    border-color: var(--fdf-blue) !important;
}

.fi-btn-color-primary:hover {
    background-color: var(--fdf-blue-dk) !important;
    box-shadow: var(--fdf-shadow-md) !important;
    transform: translateY(-1px);
}

/* CTA principal sur le login = or FDF */
.fi-simple-main button[type="submit"],
.fi-simple-main .fi-btn[type="submit"] {
    background: linear-gradient(135deg, var(--fdf-gold) 0%, var(--fdf-gold-dk) 100%) !important;
    color: var(--fdf-blue-dk) !important;
    border: none !important;
    width: 100% !important;
    padding: 1rem 1.5rem !important;
    font-size: 0.95rem !important;
    font-weight: 700 !important;
    letter-spacing: 0.03em !important;
    text-transform: uppercase !important;
    box-shadow: 0 4px 14px rgba(217, 165, 33, 0.3) !important;
}

.fi-simple-main button[type="submit"]:hover {
    background: linear-gradient(135deg, var(--fdf-gold-lt) 0%, var(--fdf-gold) 100%) !important;
    box-shadow: 0 6px 20px rgba(217, 165, 33, 0.4) !important;
    transform: translateY(-1px);
}

/* ============================================================
   SIDEBAR — bleu profond raffiné avec accents or
   ============================================================ */
.fi-sidebar,
aside.fi-sidebar,
.fi-sidebar-nav {
    background: linear-gradient(180deg, #1A3A8F 0%, #15307A 50%, #102566 100%) !important;
    border-right: 1px solid rgba(217, 165, 33, 0.12) !important;
    box-shadow: 4px 0 24px rgba(8, 21, 56, 0.12);
}

/* Header du sidebar (logo) */
.fi-sidebar-header,
.fi-sidebar-nav .fi-logo {
    background: transparent !important;
    border-bottom: 1px solid rgba(217, 165, 33, 0.18) !important;
    padding: 1.25rem 1.5rem !important;
    color: #ffffff !important;
}

/* Logo : couleur foncée par défaut (topbar blanche) */
.fdf-brand-logo {
    color: var(--fdf-blue-dk);
    display: flex;
    align-items: center;
    height: 100%;
}

/* Logo : couleur blanche quand placé dans la sidebar */
.fi-sidebar .fdf-brand-logo,
.fi-sidebar-header .fdf-brand-logo {
    color: #ffffff;
}

/* Groupes de navigation */
.fi-sidebar-group-label,
.fi-sidebar-group-button-label {
    color: rgba(240, 205, 114, 0.95) !important;
    font-family: var(--fdf-font-sans) !important;
    font-size: 0.7rem !important;
    font-weight: 600 !important;
    letter-spacing: 0.15em !important;
    text-transform: uppercase !important;
    padding: 1rem 1.25rem 0.5rem !important;
}

.fi-sidebar-group-button {
    color: rgba(240, 205, 114, 0.9) !important;
}

/* Items de navigation — état par défaut (cascade TOTALE sur descendants) */
.fi-sidebar-item-button,
.fi-sidebar-item a,
.fi-sidebar-item-button *,
.fi-sidebar-item a *,
.fi-sidebar-item-label,
.fi-sidebar-item span,
.fi-sidebar nav a,
.fi-sidebar nav a span,
.fi-sidebar nav a *,
.fi-sidebar-nav a,
.fi-sidebar-nav a * {
    color: rgba(255, 255, 255, 0.92) !important;
}

.fi-sidebar-item-button,
.fi-sidebar-item a {
    padding: 0.625rem 1rem !important;
    margin: 0.125rem 0.75rem !important;
    border-radius: 0.5rem !important;
    font-size: 0.875rem !important;
    font-weight: 500 !important;
    transition: all 0.15s ease !important;
    position: relative;
    background: transparent !important;
    text-decoration: none !important;
}

.fi-sidebar-item-button:hover,
.fi-sidebar-item-button:hover *,
.fi-sidebar-item a:hover,
.fi-sidebar-item a:hover * {
    background: rgba(255, 255, 255, 0.08) !important;
    color: #ffffff !important;
}

/* Item ACTIF — override agressif sur tous les descendants */
.fi-sidebar-item.fi-active,
.fi-sidebar-item-active,
.fi-sidebar-item.fi-active .fi-sidebar-item-button,
.fi-sidebar-item-active .fi-sidebar-item-button,
.fi-sidebar-item-button[aria-current="page"],
.fi-sidebar a[aria-current="page"],
.fi-sidebar-item-button.fi-active,
.fi-sidebar-item.fi-active .fi-sidebar-item-button *,
.fi-sidebar-item-active .fi-sidebar-item-button *,
.fi-sidebar-item-button[aria-current="page"] *,
.fi-sidebar a[aria-current="page"] * {
    background-color: transparent !important;
    color: #F0CD72 !important;
    font-weight: 600 !important;
}

/* Le fond doré transparent (sur l'élément directement, pas les enfants) */
.fi-sidebar-item.fi-active .fi-sidebar-item-button,
.fi-sidebar-item-active .fi-sidebar-item-button,
.fi-sidebar-item-button[aria-current="page"],
.fi-sidebar a[aria-current="page"] {
    background: linear-gradient(90deg, rgba(217, 165, 33, 0.25) 0%, rgba(217, 165, 33, 0.06) 100%) !important;
}

/* Barre dorée verticale à gauche de l'item actif */
.fi-sidebar-item.fi-active .fi-sidebar-item-button::before,
.fi-sidebar-item-active .fi-sidebar-item-button::before,
.fi-sidebar-item-button[aria-current="page"]::before {
    content: '';
    position: absolute;
    left: -0.75rem;
    top: 50%;
    transform: translateY(-50%);
    width: 3px;
    height: 60%;
    background: var(--fdf-gold);
    border-radius: 0 3px 3px 0;
}

/* Icônes des items */
.fi-sidebar-item-icon,
.fi-sidebar-item .fi-icon,
.fi-sidebar-item svg {
    color: inherit !important;
    opacity: 0.9;
}

.fi-sidebar-item.fi-active .fi-sidebar-item-icon,
.fi-sidebar-item-active .fi-sidebar-item-icon {
    color: var(--fdf-gold) !important;
    opacity: 1;
}

/* Bouton collapse de la sidebar (chevron) */
.fi-sidebar-collapse-button,
.fi-sidebar-collapse-button svg {
    color: rgba(255, 255, 255, 0.7) !important;
}

.fi-sidebar-collapse-button:hover {
    color: var(--fdf-gold-lt) !important;
}

/* ============================================================
   TOPBAR
   ============================================================ */
.fi-topbar,
header.fi-topbar {
    background: #ffffff !important;
    border-bottom: 1px solid var(--fdf-line) !important;
    box-shadow: var(--fdf-shadow-sm) !important;
}

.fi-topbar-item button {
    color: var(--fdf-ink-soft) !important;
}

/* ============================================================
   PAGES — header avec Playfair
   ============================================================ */
.fi-header {
    border-bottom: 1px solid var(--fdf-line);
    padding-bottom: 1.5rem;
    margin-bottom: 2rem;
}

.fi-page,
.fi-main {
    padding: 2rem !important;
}

/* Breadcrumbs */
.fi-breadcrumbs {
    margin-bottom: 1rem;
}

.fi-breadcrumbs a,
.fi-breadcrumbs span {
    font-size: 0.8rem !important;
    color: var(--fdf-ink-soft) !important;
    letter-spacing: 0.02em;
}

.fi-breadcrumbs a:hover {
    color: var(--fdf-blue) !important;
}

/* ============================================================
   SECTIONS / CARDS — ombres raffinées
   ============================================================ */
.fi-section,
.fi-fo-section,
section.fi-section {
    background: #ffffff !important;
    border: 1px solid var(--fdf-line) !important;
    border-radius: 0.875rem !important;
    box-shadow: var(--fdf-shadow-sm) !important;
    overflow: hidden;
}

.fi-section-header {
    padding: 1.25rem 1.5rem !important;
    border-bottom: 1px solid var(--fdf-line) !important;
    background: linear-gradient(180deg, #fcfcfa 0%, #ffffff 100%) !important;
}

.fi-section-header-heading {
    font-size: 1.125rem !important;
}

.fi-section-content {
    padding: 1.5rem !important;
}

/* ============================================================
   TABLES — header coloré, hover subtil
   ============================================================ */
.fi-ta {
    background: #ffffff !important;
    border: 1px solid var(--fdf-line) !important;
    border-radius: 0.875rem !important;
    overflow: hidden !important;
    box-shadow: var(--fdf-shadow-sm) !important;
}

.fi-ta-header {
    background: linear-gradient(180deg, #fcfcfa 0%, #f9f8f4 100%) !important;
    border-bottom: 1px solid var(--fdf-line) !important;
    padding: 1.25rem 1.5rem !important;
}

.fi-ta-header-heading {
    font-family: var(--fdf-font-display) !important;
    font-weight: 600 !important;
    color: var(--fdf-blue-dk) !important;
}

/* Header de colonnes */
.fi-ta-header-cell,
th.fi-ta-header-cell {
    background: #fafafa !important;
    color: var(--fdf-ink-soft) !important;
    font-family: var(--fdf-font-sans) !important;
    font-size: 0.75rem !important;
    font-weight: 600 !important;
    letter-spacing: 0.05em !important;
    text-transform: uppercase !important;
    border-bottom: 1px solid var(--fdf-line) !important;
    padding: 0.875rem 1.25rem !important;
}

/* Lignes */
.fi-ta-row {
    transition: background 0.15s ease;
}

.fi-ta-row:hover {
    background: rgba(217, 165, 33, 0.03) !important;
}

.fi-ta-cell {
    padding: 1rem 1.25rem !important;
    border-bottom: 1px solid #f3f2ee !important;
    color: var(--fdf-ink) !important;
}

/* Pagination */
.fi-pagination {
    background: #fafafa !important;
    border-top: 1px solid var(--fdf-line) !important;
    padding: 1rem 1.25rem !important;
}

/* ============================================================
   BADGES — colorés et raffinés
   ============================================================ */
.fi-badge {
    font-family: var(--fdf-font-sans) !important;
    font-weight: 600 !important;
    font-size: 0.7rem !important;
    letter-spacing: 0.04em !important;
    border-radius: 0.5rem !important;
    padding: 0.25rem 0.625rem !important;
}

/* ============================================================
   MODALES
   ============================================================ */
.fi-modal-window {
    border-radius: 1rem !important;
    box-shadow: var(--fdf-shadow-lg) !important;
    border: 1px solid var(--fdf-line) !important;
}

.fi-modal-header {
    padding: 1.5rem 1.75rem !important;
    border-bottom: 1px solid var(--fdf-line) !important;
}

.fi-modal-heading {
    font-size: 1.25rem !important;
}

/* ============================================================
   ÉTATS VIDES — personnalité
   ============================================================ */
.fi-ta-empty-state,
.fi-empty-state {
    padding: 4rem 2rem !important;
}

.fi-ta-empty-state-icon,
.fi-empty-state-icon {
    color: var(--fdf-gold) !important;
    opacity: 0.6;
    width: 4rem !important;
    height: 4rem !important;
}

.fi-ta-empty-state-heading,
.fi-empty-state-heading {
    font-family: var(--fdf-font-display) !important;
    font-size: 1.25rem !important;
    color: var(--fdf-blue-dk) !important;
    margin-top: 1rem !important;
}

/* ============================================================
   NOTIFICATIONS / TOASTS
   ============================================================ */
.fi-no-notification {
    border-radius: 0.75rem !important;
    box-shadow: var(--fdf-shadow-lg) !important;
    border: 1px solid var(--fdf-line) !important;
}

/* ============================================================
   WIDGETS DASHBOARD — stat cards
   ============================================================ */
.fi-wi-stats-overview-stat {
    background: #ffffff !important;
    border: 1px solid var(--fdf-line) !important;
    border-radius: 0.875rem !important;
    padding: 1.5rem !important;
    box-shadow: var(--fdf-shadow-sm) !important;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.fi-wi-stats-overview-stat:hover {
    transform: translateY(-2px);
    box-shadow: var(--fdf-shadow-md) !important;
}

.fi-wi-stats-overview-stat-label {
    font-family: var(--fdf-font-sans) !important;
    font-size: 0.8rem !important;
    font-weight: 500 !important;
    color: var(--fdf-ink-soft) !important;
    letter-spacing: 0.02em !important;
}

.fi-wi-stats-overview-stat-value {
    font-family: var(--fdf-font-display) !important;
    font-size: 2.5rem !important;
    font-weight: 700 !important;
    color: var(--fdf-blue-dk) !important;
    line-height: 1 !important;
    margin-top: 0.5rem !important;
}

/* ============================================================
   ACCOUNT WIDGET (bienvenue dashboard)
   ============================================================ */
.fi-wi-account {
    background: linear-gradient(135deg, var(--fdf-blue-dk) 0%, var(--fdf-blue) 100%) !important;
    color: #ffffff !important;
    border: none !important;
    box-shadow: var(--fdf-shadow-md) !important;
    overflow: hidden;
    position: relative;
}

.fi-wi-account::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(217, 165, 33, 0.15) 0%, transparent 70%);
    pointer-events: none;
}

.fi-wi-account .fi-section-content {
    color: #ffffff !important;
}

.fi-wi-account h2,
.fi-wi-account .fi-section-header-heading {
    color: #ffffff !important;
}

/* ============================================================
   SCROLLBAR — discrète
   ============================================================ */
::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

::-webkit-scrollbar-track {
    background: transparent;
}

::-webkit-scrollbar-thumb {
    background: rgba(8, 21, 56, 0.15);
    border-radius: 5px;
    border: 2px solid transparent;
    background-clip: padding-box;
}

::-webkit-scrollbar-thumb:hover {
    background: rgba(8, 21, 56, 0.3);
    background-clip: padding-box;
    border: 2px solid transparent;
}

/* Scrollbar de la sidebar : version dorée */
.fi-sidebar ::-webkit-scrollbar-thumb {
    background: rgba(217, 165, 33, 0.25);
    background-clip: padding-box;
    border: 2px solid transparent;
}

/* ============================================================
   RESPONSIVE — mobile
   ============================================================ */
@media (max-width: 1023px) {
    .fdf-login-header__title {
        font-size: 2rem;
    }

    .fi-simple-page {
        padding: 1.5rem !important;
    }
}

/* ============================================================
   ANIMATIONS — fade-in subtil
   ============================================================ */
@keyframes fdfFadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
}

.fi-simple-main,
.fi-section,
.fi-wi-stats-overview-stat {
    animation: fdfFadeIn 0.4s ease-out;
}
</style>
