<?php
namespace App\Http\Controllers;

use App\Models\Album;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::published()
            ->ordered()
            ->withCount('items')
            ->paginate(12);

        return view('pages.gallery.index', compact('albums'));
    }

    public function show(string $slug)
    {
        $album = Album::published()
            ->where('slug', $slug)
            ->with(['items' => fn ($q) => $q->orderBy('sort_order')])
            ->firstOrFail();

        return view('pages.gallery.show', compact('album'));
    }
}
