<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Lijst van al het nieuws (publiek)
    public function index()
    {
        $news = News::where('is_published', true)
                   ->where('publication_date', '<=', now())
                   ->orderBy('publication_date', 'desc')
                   ->paginate(6);
        
        return view('news.index', compact('news'));
    }

    // Toon specifiek nieuwsartikel (publiek)
    public function show($slug)
    {
        $article = News::where('slug', $slug)
                      ->where('is_published', true)
                      ->where('publication_date', '<=', now())
                      ->firstOrFail();
        
        return view('news.show', compact('article'));
    }

}
