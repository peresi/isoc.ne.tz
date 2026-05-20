<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CmsPageController extends Controller
{
    public function index()
    {
        return view('admin.pages.index', [
            'pages' => CmsPage::query()->orderByDesc('is_system')->orderBy('navigation_order')->orderBy('title')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'alpha_dash', Rule::unique('cms_pages', 'slug')],
            'nav_label' => ['nullable', 'string', 'max:100'],
            'content' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'in_navigation' => ['nullable', 'boolean'],
            'navigation_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $slug = $validated['slug'] ?? Str::slug($validated['title']);
        if ($slug === '') {
            $slug = Str::random(8);
        }

        CmsPage::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'nav_label' => $validated['nav_label'] ?? $validated['title'],
            'content' => $validated['content'] ?? null,
            'is_system' => false,
            'is_published' => (bool) ($validated['is_published'] ?? false),
            'in_navigation' => (bool) ($validated['in_navigation'] ?? false),
            'navigation_order' => (int) ($validated['navigation_order'] ?? 99),
        ]);

        return redirect()->route('admin.pages.index')->with('status', 'Page created successfully.');
    }

    public function edit(CmsPage $page)
    {
        return view('admin.pages.edit', [
            'page' => $page,
        ]);
    }

    public function update(Request $request, CmsPage $page)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', Rule::unique('cms_pages', 'slug')->ignore($page->id)],
            'nav_label' => ['nullable', 'string', 'max:100'],
            'route_name' => ['nullable', 'string', 'max:100'],
            'content' => ['nullable', 'string'],
            'is_published' => ['nullable', 'boolean'],
            'in_navigation' => ['nullable', 'boolean'],
            'navigation_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $page->update([
            'title' => $validated['title'],
            'slug' => $page->is_system ? $page->slug : $validated['slug'],
            'nav_label' => $validated['nav_label'] ?? $validated['title'],
            'route_name' => $page->is_system ? ($validated['route_name'] ?? $page->route_name) : null,
            'content' => $validated['content'] ?? null,
            'is_published' => (bool) ($validated['is_published'] ?? false),
            'in_navigation' => (bool) ($validated['in_navigation'] ?? false),
            'navigation_order' => (int) ($validated['navigation_order'] ?? 99),
        ]);

        return redirect()->route('admin.pages.index')->with('status', 'Page updated successfully.');
    }

    public function destroy(CmsPage $page)
    {
        abort_if($page->is_system, 422, 'System pages cannot be deleted.');

        $page->delete();

        return redirect()->route('admin.pages.index')->with('status', 'Page deleted successfully.');
    }
}
