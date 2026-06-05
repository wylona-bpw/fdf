<?php
namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    public function show(string $slug)
    {
        $page = Page::published()->where('slug', $slug)->firstOrFail();

        // Choix du template Blade selon le champ `template`
        $view = match ($page->template) {
            'association' => 'pages.association',
            'actions'     => 'pages.actions',
            'donate'      => 'pages.donate',
            default       => 'pages.default',
        };

        return view($view, compact('page'));
    }
}
