@extends('layouts.site')

@section('title', 'Admin - Create Page')

@section('content')
<section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900">Create New Page</h1>
    <p class="mt-2 text-slate-600">Add a custom page and optionally show it in the top navigation.</p>

    <form method="POST" action="{{ route('admin.pages.store') }}" class="mt-8 space-y-5 rounded-2xl border border-slate-200 bg-white p-6">
        @csrf

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="title">Title</label>
            <input id="title" name="title" value="{{ old('title') }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" required>
            @error('title')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="slug">Slug (optional)</label>
            <input id="slug" name="slug" value="{{ old('slug') }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" placeholder="example-page">
            @error('slug')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="nav_label">Navigation Label</label>
            <input id="nav_label" name="nav_label" value="{{ old('nav_label') }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" placeholder="Menu label">
            @error('nav_label')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="content">Content</label>
            <textarea id="content" name="content" rows="10" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500">{{ old('content') }}</textarea>
            @error('content')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700" for="navigation_order">Navigation Order</label>
            <input id="navigation_order" type="number" min="0" name="navigation_order" value="{{ old('navigation_order', 99) }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div class="flex gap-5">
            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="is_published" value="1" class="rounded border-slate-300 text-blue-700" {{ old('is_published', '1') ? 'checked' : '' }}>
                Published
            </label>
            <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                <input type="checkbox" name="in_navigation" value="1" class="rounded border-slate-300 text-blue-700" {{ old('in_navigation') ? 'checked' : '' }}>
                Show in navigation
            </label>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.pages.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">Cancel</a>
            <button class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Create Page</button>
        </div>
    </form>
</section>
@endsection
