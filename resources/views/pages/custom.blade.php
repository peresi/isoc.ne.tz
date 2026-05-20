@extends('layouts.site')

@section('title', $page->title)

@section('content')
<section class="mx-auto max-w-4xl px-4 py-16 sm:px-6 lg:px-8">
    <article class="rounded-2xl border border-slate-200 bg-white p-8">
        <h1 class="text-4xl font-bold text-slate-900">{{ $page->title }}</h1>
        <div class="prose prose-slate mt-6 max-w-none text-slate-700">
            {!! nl2br(e($page->content ?? '')) !!}
        </div>
    </article>
</section>
@endsection
