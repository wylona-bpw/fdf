<?php
namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::published()->ordered()->paginate(9);
        $page = Page::published()->where('slug', 'temoignages')->first();

        return view('pages.testimonials.index', compact('testimonials', 'page'));
    }

    public function show(Testimonial $testimonial)
    {
        abort_unless($testimonial->is_published, 404);

        $related = Testimonial::published()
            ->where('id', '!=', $testimonial->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('pages.testimonials.show', compact('testimonial', 'related'));
    }
}
