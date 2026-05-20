@extends('layouts.site')

@section('title', 'Admin - Edit Page')

@section('content')
<section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900">Edit Page: {{ $page->title }}</h1>
    <p class="mt-2 text-slate-600">Update content, visibility, and navigation settings.</p>

    <form method="POST" action="{{ route('admin.pages.update', $page) }}" class="mt-8 space-y-5 rounded-2xl border border-slate-200 bg-white p-6">
        @csrf
        @method('PATCH')

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="title">Title</label>
            <input id="title" name="title" value="{{ old('title', $page->title) }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" required>
            @error('title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="slug">Slug</label>
            <input id="slug" name="slug" value="{{ old('slug', $page->slug) }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" {{ $page->is_system ? 'readonly' : '' }}>
            @if($page->is_system)
                <p class="mt-1 text-xs text-slate-500">System page slugs are locked.</p>
            @endif
            @error('slug')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        @if($page->is_system)
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700" for="route_name">Route Name</label>
                <input id="route_name" name="route_name" value="{{ old('route_name', $page->route_name) }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" readonly>
            </div>
        @endif

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="nav_label">Navigation Label</label>
            <input id="nav_label" name="nav_label" value="{{ old('nav_label', $page->nav_label) }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500">
            @error('nav_label')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="content">Content</label>
            <textarea id="content" name="content" rows="10" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500">{{ old('content', $page->content) }}</textarea>
            @error('content')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="navigation_order">Navigation Order</label>
            <input id="navigation_order" type="number" min="0" name="navigation_order" value="{{ old('navigation_order', $page->navigation_order) }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div class="flex gap-5">
            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="is_published" value="1" class="rounded border-slate-300 text-blue-700" {{ old('is_published', $page->is_published) ? 'checked' : '' }}>
                Published
            </label>
            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="in_navigation" value="1" class="rounded border-slate-300 text-blue-700" {{ old('in_navigation', $page->in_navigation) ? 'checked' : '' }}>
                Show in navigation
            </label>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.pages.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">Back</a>
            <button class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Save Changes</button>
        </div>
    </form>
</section>
@endsection
