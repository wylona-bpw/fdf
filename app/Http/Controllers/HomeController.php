<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Album;
use App\Models\Campaign;
use App\Models\Event;
use App\Models\Setting;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'articles'       => Article::published()->latest()->take(3)->get(),
            'albums'         => Album::published()->ordered()->take(4)->with('items')->get(),
            'testimonials'   => Testimonial::published()->ordered()->take(3)->get(),
            'activeCampaign' => Campaign::active()
                ->where(fn ($q) => $q->whereNull('ends_at')->orWhereDate('ends_at', '>=', now()))
                ->latest('starts_at')
                ->first(),
            'upcomingEvents' => Event::published()->upcoming()->take(3)->get(),
        ]);
    }
}
