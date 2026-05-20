@extends('layouts.site')

@section('title', 'Publish News - TIGF')

@section('content')
<section class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold text-slate-900">Publish News Update</h1>
    <p class="mt-2 text-slate-600">Create a new update to appear on the public news page.</p>

    <form method="POST" action="{{ route('news.store') }}" class="mt-8 space-y-5 rounded-xl border border-slate-200 bg-white p-6">
        @csrf

        <div>
            <label for="title" class="mb-1 block text-sm font-medium text-slate-700">Title</label>
            <input id="title" name="title" value="{{ old('title') }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" required>
            @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="image_url" class="mb-1 block text-sm font-medium text-slate-700">Image URL (optional)</label>
            <input id="image_url" name="image_url" type="url" value="{{ old('image_url') }}" placeholder="https://example.com/news-image.jpg" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500">
            @error('image_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="excerpt" class="mb-1 block text-sm font-medium text-slate-700">Short Excerpt</label>
            <textarea id="excerpt" name="excerpt" rows="3" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" required>{{ old('excerpt') }}</textarea>
            @error('excerpt')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <div>
            <label for="content" class="mb-1 block text-sm font-medium text-slate-700">Full Content</label>
            <textarea id="content" name="content" rows="10" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" required>{{ old('content') }}</textarea>
            @error('content')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
        </div>

        <button class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Publish</button>
    </form>
</section>
@endsection
