@extends('layouts.site')

@section('title', 'Internet Society Tanzania Chapter')

@section('content')
<section class="bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-800 text-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-20 sm:px-6 lg:grid-cols-2 lg:px-8">
        <div>
            <p class="mb-3 text-sm font-semibold uppercase tracking-widest text-blue-200">Internet Society Tanzania Chapter</p>
            <h1 class="text-4xl font-bold leading-tight sm:text-5xl">{{ $cmsPage?->title ?: 'We believe the Internet changes lives.' }}</h1>
            <p class="mt-5 max-w-xl text-blue-100">{{ $cmsPage?->content ?: 'We work to connect more people, strengthen online trust and safety, and advance an open Internet that benefits everyone in Tanzania.' }}</p>
            <div class="mt-8 flex gap-3">
                <a href="{{ route('courses.index') }}" class="rounded-md bg-white px-5 py-3 font-semibold text-blue-900 hover:bg-blue-100">Learn About Our Work</a>
                <a href="{{ route('about') }}" class="rounded-md border border-white/40 px-5 py-3 font-semibold hover:bg-white/10">About Us</a>
            </div>
        </div>
        <div class="rounded-2xl border border-white/20 bg-white/10 p-8 backdrop-blur">
            <h2 class="text-xl font-semibold">Action focus for 2026</h2>
            <ul class="mt-4 space-y-3 text-blue-100">
                <li>• Expand meaningful access and resilient connectivity.</li>
                <li>• Strengthen online safety for youth and communities.</li>
                <li>• Build practical Internet skills and local capacity.</li>
                <li>• Advocate policy that keeps the Internet open and trusted.</li>
            </ul>
        </div>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="mb-12 rounded-2xl border border-slate-200 bg-white p-8">
        <h2 class="text-2xl font-bold text-slate-900">Working together to grow and defend the Internet in Tanzania</h2>
        <p class="mt-3 max-w-4xl text-slate-600">Our chapter brings together technical experts, policymakers, academia, civil society, and youth to turn global Internet principles into local impact.</p>
    </div>

    <div class="mb-8 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-slate-900">Featured E-Learning Courses</h2>
        <a href="{{ route('courses.index') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-800">See all programs</a>
    </div>
    <div class="grid gap-6 md:grid-cols-3">
        @forelse($featuredCourses as $course)
            <a href="{{ route('courses.show', $course) }}" class="group rounded-xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <p class="text-xs font-semibold uppercase tracking-wide text-blue-700">{{ $course->level }}</p>
                <h3 class="mt-2 text-lg font-bold text-slate-900 group-hover:text-blue-700">{{ $course->title }}</h3>
                <p class="mt-2 text-sm text-slate-600">{{ $course->summary }}</p>
                <p class="mt-4 text-xs font-medium text-slate-500">{{ $course->lessons_count }} lessons • {{ $course->duration }}</p>
            </a>
        @empty
            <p class="text-slate-600">Courses will appear here once published.</p>
        @endforelse
    </div>
</section>

<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-slate-900">Latest News</h2>
            <a href="{{ route('news.index') }}" class="text-sm font-semibold text-blue-700 hover:text-blue-800">Read all insights</a>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            @forelse($latestNews as $item)
                <a href="{{ route('news.show', $item) }}" class="rounded-xl border border-slate-200 p-6 transition hover:border-blue-200 hover:shadow-sm">
                    <p class="text-xs text-slate-500">{{ $item->published_at?->format('d M Y') }}</p>
                    <h3 class="mt-2 text-lg font-bold text-slate-900">{{ $item->title }}</h3>
                    <p class="mt-3 text-sm text-slate-600">{{ $item->excerpt }}</p>
                </a>
            @empty
                <p class="text-slate-600">No updates available yet.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="rounded-2xl bg-blue-900 p-8 text-blue-100">
        <h2 class="text-3xl font-bold text-white">Stay connected.</h2>
        <p class="mt-3 max-w-3xl">Get news, updates, and ways to collaborate with the Internet Society Tanzania Chapter.</p>
        <a href="{{ route('contact.index') }}" class="mt-6 inline-block rounded-md bg-white px-5 py-3 font-semibold text-blue-900 hover:bg-blue-100">Subscribe / Contact Us</a>
    </div>
</section>
@endsection
