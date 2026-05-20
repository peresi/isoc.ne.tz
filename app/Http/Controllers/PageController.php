<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use App\Models\Course;
use App\Models\News;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home', [
            'cmsPage' => CmsPage::query()->where('slug', 'home')->first(),
            'latestNews' => News::published()->latest('published_at')->take(3)->get(),
            'featuredCourses' => Course::withCount('lessons')->take(3)->get(),
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'cmsPage' => CmsPage::query()->where('slug', 'about-us')->first(),
        ]);
    }

    public function showCustom(CmsPage $page)
    {
        abort_if($page->is_system, 404);
        abort_unless($page->is_published, 404);

        return view('pages.custom', [
            'page' => $page,
        ]);
    }
}
