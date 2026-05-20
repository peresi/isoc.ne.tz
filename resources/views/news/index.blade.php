@extends('layouts.site')

@section('title', 'News & Insights - Tanzania IGF')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-4xl font-bold text-slate-900">{{ $cmsPage?->title ?: 'News & Insights' }}</h1>
            <p class="mt-2 text-slate-600">{{ $cmsPage?->content ?: 'Follow recent announcements, events, and internet governance updates.' }}</p>
        </div>
        @auth
            <a href="{{ route('news.create') }}" class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Publish Update</a>
        @endauth
    </div>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($items as $item)
            <a href="{{ route('news.show', $item) }}" class="rounded-xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1 hover:shadow-md">
                <p class="text-xs font-medium text-slate-500">{{ $item->published_at?->format('d M Y') }}</p>
                <h2 class="mt-2 text-lg font-bold text-slate-900">{{ $item->title }}</h2>
                @if($item->image_url)
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="mt-3 h-44 w-full rounded-lg object-cover">
                @endif
                <p class="mt-3 text-sm text-slate-600">{{ $item->excerpt }}</p>
            </a>
        @empty
            <p class="text-slate-600">No news updates yet.</p>
        @endforelse
    </div>

    <div class="mt-8">{{ $items->links() }}</div>
</section>
@endsection
