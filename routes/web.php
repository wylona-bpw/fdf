<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\NewsletterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FDF — Routes publiques
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Association (pages statiques éditables)
|--------------------------------------------------------------------------
*/
Route::get('/association',   [PageController::class, 'show'])->name('association')->defaults('slug', 'association');
Route::get('/nos-actions',   [PageController::class, 'show'])->name('actions')->defaults('slug', 'nos-actions');
Route::get('/faire-un-don',  [PageController::class, 'show'])->name('donate')->defaults('slug', 'faire-un-don');

// 🆕 Page Transparence — utilisée par le home (section "Transparence totale")
Route::get('/transparence',  [PageController::class, 'show'])->name('transparency')->defaults('slug', 'transparence');

// 🆕 Détail d'une action — chaque carte du home peut linker ici
//     Utilise PageController : le slug = "action-{quelque-chose}" (à créer dans Filament Pages)
Route::get('/nos-actions/{slug}', [PageController::class, 'show'])->name('actions.show');

/*
|--------------------------------------------------------------------------
| Actualités (blog)
|--------------------------------------------------------------------------
*/
Route::get('/actualites',         [ArticleController::class, 'index'])->name('articles.index');
Route::get('/actualites/{slug}',  [ArticleController::class, 'show'])->name('articles.show');

/*
|--------------------------------------------------------------------------
| Galerie
|--------------------------------------------------------------------------
*/
Route::get('/galerie',         [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/galerie/{slug}',  [GalleryController::class, 'show'])->name('gallery.show');

/*
|--------------------------------------------------------------------------
| 🆕 Témoignages — utilise PageController par défaut, à remplacer par
|     un TestimonialController dédié quand le modèle sera prêt (déjà
|     présent dans Filament — voir resources/Testimonials).
|--------------------------------------------------------------------------
*/
Route::get('/temoignages',         [PageController::class, 'show'])->name('testimonials.index')->defaults('slug', 'temoignages');
Route::get('/temoignages/{slug}',  [PageController::class, 'show'])->name('testimonials.show');

/*
|--------------------------------------------------------------------------
| Bénévolat
|--------------------------------------------------------------------------
*/
Route::get('/devenir-benevole',   [VolunteerController::class, 'create'])->name('volunteer.create');
Route::post('/devenir-benevole',  [VolunteerController::class, 'store'])->name('volunteer.store');

/*
|--------------------------------------------------------------------------
| Contact
|--------------------------------------------------------------------------
*/
Route::get('/contact',   [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact',  [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Newsletter
|--------------------------------------------------------------------------
*/
Route::post('/newsletter',                    [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

/*
|--------------------------------------------------------------------------
| Pages légales
|--------------------------------------------------------------------------
*/
Route::get('/mentions-legales',             [PageController::class, 'show'])->name('legal')->defaults('slug', 'mentions-legales');
Route::get('/politique-de-confidentialite', [PageController::class, 'show'])->name('privacy')->defaults('slug', 'politique-de-confidentialite');

/*
|--------------------------------------------------------------------------
| Fallback pages dynamiques
|--------------------------------------------------------------------------
*/
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');
