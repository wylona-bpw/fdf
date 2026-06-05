<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::published()
            ->latest()
            ->with('category', 'author')
            ->paginate(9);

        $categories = Category::active()->ordered()->withCount([
            'articles' => fn ($q) => $q->published(),
        ])->get();

        return view('pages.articles.index', compact('articles', 'categories'));
    }

    public function show(string $slug)
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();
        $article->increment('views_count');

        $related = Article::published()
            ->where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest()
            ->take(3)
            ->get();

        return view('pages.articles.show', compact('article', 'related'));
    }
}
