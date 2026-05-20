<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index', [
            'cmsPage' => CmsPage::query()->where('slug', 'news-insights')->first(),
            'items' => News::published()->latest('published_at')->paginate(6),
        ]);
    }

    public function show(News $news)
    {
        abort_unless($news->published_at !== null && $news->published_at->lte(now()), 404);

        return view('news.show', [
            'item' => $news,
            'latestNews' => News::published()->where('id', '!=', $news->id)->latest('published_at')->take(3)->get(),
        ]);
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'excerpt' => ['required', 'string', 'max:300'],
            'content' => ['required', 'string'],
        ]);

        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;

        while (News::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $news = News::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'image_url' => $validated['image_url'] ?? null,
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'published_at' => now(),
        ]);

        return redirect()->route('news.show', $news)->with('status', 'News update published successfully.');
    }
}
