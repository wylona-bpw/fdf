<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Article;
use App\Models\Testimonial;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $urls = collect([
            ['loc' => route('home'), 'priority' => '1.0'],
            ['loc' => route('association'), 'priority' => '0.8'],
            ['loc' => route('actions'), 'priority' => '0.8'],
            ['loc' => route('donate'), 'priority' => '0.9'],
            ['loc' => route('transparency'), 'priority' => '0.6'],
            ['loc' => route('testimonials.index'), 'priority' => '0.5'],
            ['loc' => route('articles.index'), 'priority' => '0.6'],
            ['loc' => route('gallery.index'), 'priority' => '0.7'],
            ['loc' => route('volunteer.create'), 'priority' => '0.7'],
            ['loc' => route('contact.create'), 'priority' => '0.5'],
            ['loc' => route('legal'), 'priority' => '0.2'],
            ['loc' => route('privacy'), 'priority' => '0.2'],
        ]);

        foreach (Album::published()->get() as $album) {
            $urls->push([
                'loc' => route('gallery.show', $album->slug),
                'lastmod' => $album->updated_at->toAtomString(),
                'priority' => '0.6',
            ]);
        }

        foreach (Article::published()->get() as $article) {
            $urls->push([
                'loc' => route('articles.show', $article->slug),
                'lastmod' => $article->updated_at->toAtomString(),
                'priority' => '0.5',
            ]);
        }

        foreach (Testimonial::published()->get() as $testimonial) {
            $urls->push([
                'loc' => route('testimonials.show', $testimonial),
                'lastmod' => $testimonial->updated_at->toAtomString(),
                'priority' => '0.3',
            ]);
        }

        // Les Pages avec un template dédié (association, nos-actions, faire-un-don,
        // transparence, temoignages, légal...) ont déjà leur route propre listée
        // ci-dessus : on ne les réinclut pas via /page/{slug} pour éviter les
        // doublons de contenu dans le sitemap.

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
