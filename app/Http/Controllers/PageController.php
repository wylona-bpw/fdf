<?php
namespace App\Http\Controllers;

use App\Models\Album;
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

        $data = compact('page');

        if ($page->template === 'actions') {
            $data['albums'] = Album::published()->ordered()->take(4)->get();
        }

        return view($view, $data);
    }
}
