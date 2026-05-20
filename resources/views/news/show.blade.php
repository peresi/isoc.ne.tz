@extends('layouts.site')

@section('title', $item->title . ' - TIGF News')

@section('content')
<section class="mx-auto grid max-w-7xl gap-8 px-4 py-16 sm:px-6 lg:grid-cols-3 lg:px-8">
    <article class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white p-8">
        <p class="text-sm text-slate-500">Published {{ $item->published_at?->format('d M Y') }}</p>
        <h1 class="mt-3 text-3xl font-bold text-slate-900">{{ $item->title }}</h1>
        @if($item->image_url)
            <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="mt-5 h-72 w-full rounded-xl object-cover">
        @endif
        <div class="prose prose-slate mt-6 max-w-none">
            <p>{{ $item->content }}</p>
        </div>
    </article>

    <aside class="space-y-4">
        <h2 class="text-lg font-semibold text-slate-900">Latest Updates</h2>
        @forelse($latestNews as $latest)
            <a href="{{ route('news.show', $latest) }}" class="block rounded-xl border border-slate-200 bg-white p-4 hover:border-blue-200">
                <p class="text-xs text-slate-500">{{ $latest->published_at?->format('d M Y') }}</p>
                <p class="mt-1 font-semibold text-slate-900">{{ $latest->title }}</p>
            </a>
        @empty
            <p class="text-sm text-slate-500">No additional updates.</p>
        @endforelse
    </aside>
</section>
@endsection
