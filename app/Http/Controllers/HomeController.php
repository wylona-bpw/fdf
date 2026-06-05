<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Album;
use App\Models\Setting;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'articles'     => Article::published()->latest()->take(3)->get(),
            'albums'       => Album::published()->ordered()->take(4)->with('items')->get(),
            'testimonials' => Testimonial::published()->ordered()->take(3)->get(),
        ]);
    }
}
