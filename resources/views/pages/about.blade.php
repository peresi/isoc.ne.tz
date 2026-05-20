@extends('layouts.site')

@section('title', 'About Us - Internet Society Tanzania Chapter')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-slate-900">{{ $cmsPage?->title ?: 'About Internet Society Tanzania Chapter' }}</h1>
    <p class="mt-5 max-w-4xl text-lg text-slate-600">{{ $cmsPage?->content ?: 'The Internet Society Tanzania Chapter is part of a global community working to ensure the Internet is open, globally connected, secure, and trustworthy for everyone.' }}</p>

    <div class="mt-12 grid gap-6 md:grid-cols-3">
        <div class="rounded-xl border border-slate-200 bg-white p-6">
            <h2 class="text-xl font-semibold text-slate-900">Our Mission</h2>
            <p class="mt-3 text-sm text-slate-600">Grow and defend an Internet that creates opportunity, trust, and inclusion across Tanzania.</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-6">
            <h2 class="text-xl font-semibold text-slate-900">Our Vision</h2>
            <p class="mt-3 text-sm text-slate-600">An Internet for everyone: accessible, resilient, safe, and community-driven.</p>
        </div>
        <div class="rounded-xl border border-slate-200 bg-white p-6">
            <h2 class="text-xl font-semibold text-slate-900">Our Approach</h2>
            <p class="mt-3 text-sm text-slate-600">Collaborative local action through chapters, training, policy engagement, and partnerships.</p>
        </div>
    </div>

    <div class="mt-12 rounded-2xl bg-blue-900 p-8 text-blue-100">
        <h2 class="text-2xl font-bold text-white">Key Focus Areas</h2>
        <ul class="mt-4 grid gap-3 md:grid-cols-2">
            <li>• Meaningful and affordable connectivity</li>
            <li>• Safer Internet initiatives and online trust</li>
            <li>• Digital rights, privacy, and responsible governance</li>
            <li>• Community capacity building and technical training</li>
            <li>• Youth participation and leadership</li>
            <li>• Local voices in regional and global Internet debates</li>
        </ul>
    </div>
</section>
@endsection
