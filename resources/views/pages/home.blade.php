@extends('layouts.site')

@section('title', 'Internet Society Tanzania Chapter')

@section('content')
@php
    $heroSlides = [
        [
            'image' => 'https://www.internetsociety.org/wp-content/uploads/2025/11/Haiti-CN-Training.jpg',
            'alt' => 'Participants at a community networks training from the Internet Society Haiti Chapter',
            'kicker' => 'Community-Led Connectivity',
            'title' => 'The Internet is strongest when people can shape it.',
            'highlight' => 'shape it.',
            'body' => 'We bring communities, technologists, policymakers, educators, and young people together to keep the Internet open, secure, useful, and accessible across Tanzania.',
        ],
        [
            'image' => 'https://www.internetsociety.org/wp-content/uploads/2026/03/girls-panorama.jpg',
            'alt' => 'Students sitting with a laptop as part of Internet Society digital inclusion work',
            'kicker' => 'Digital Skills',
            'title' => 'Building confidence, safety, and opportunity online.',
            'highlight' => 'online.',
            'body' => 'Training and learning programs help more people understand Internet technology, governance, and online safety.',
        ],
        [
            'image' => 'https://www.internetsociety.org/wp-content/uploads/2025/12/Panama-community.jpg',
            'alt' => 'A community gathering featured by the Internet Society',
            'kicker' => 'Internet for Everyone',
            'title' => 'Local action can create global Internet impact.',
            'highlight' => 'impact.',
            'body' => 'Members, partners, and local leaders collaborate on practical Internet development priorities for Tanzania.',
        ],
    ];
@endphp

<section
    class="relative min-h-[580px] overflow-hidden bg-slate-950"
    x-data="{ active: 0, slides: @js($heroSlides) }"
    x-init="setInterval(() => { active = (active + 1) % slides.length }, 6500)"
>
    <template x-for="(slide, index) in slides" :key="slide.image">
        <img
            x-show="active === index"
            x-transition.opacity.duration.700ms
            :src="slide.image"
            :alt="slide.alt"
            class="absolute inset-0 h-full w-full object-cover"
        >
    </template>

    <div class="absolute inset-0 bg-slate-950/60"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-slate-950/85 via-slate-950/55 to-slate-950/25"></div>

    <div class="relative mx-auto flex min-h-[580px] max-w-7xl items-center px-4 py-20 sm:px-6 lg:px-8">
        <div class="max-w-3xl text-white">
            <p class="text-sm font-bold uppercase tracking-wider text-amber-300" x-text="slides[active].kicker"></p>
            <h1 class="mt-5 text-4xl font-extrabold leading-tight text-white sm:text-5xl lg:text-6xl">
                <span x-text="slides[active].title.replace(slides[active].highlight, '')"></span>
                <span class="text-amber-300" x-text="slides[active].highlight"></span>
            </h1>
            <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-100" x-text="slides[active].body"></p>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                <a href="{{ route('courses.index') }}" class="inline-flex items-center justify-center rounded-md bg-amber-400 px-6 py-3 text-sm font-bold text-slate-950 hover:bg-amber-300">Explore Our Work</a>
                <a href="{{ route('about') }}" class="inline-flex items-center justify-center rounded-md border border-white/50 px-6 py-3 text-sm font-bold text-white hover:bg-white/10">About the Chapter</a>
            </div>
        </div>
    </div>

    <div class="absolute bottom-7 left-1/2 flex -translate-x-1/2 gap-2">
        <template x-for="(slide, index) in slides" :key="slide.kicker">
            <button
                type="button"
                class="h-3 rounded-full transition-all"
                :class="active === index ? 'w-10 bg-amber-400' : 'w-3 bg-white/55 hover:bg-white'"
                :aria-label="`Show slide ${index + 1}`"
                @click="active = index"
            ></button>
        </template>
    </div>
</section>

<section class="border-y border-slate-200 bg-slate-50">
    <div class="mx-auto grid max-w-7xl gap-8 px-4 py-14 sm:px-6 lg:grid-cols-[0.8fr_1.2fr] lg:px-8">
        <div>
            <p class="site-kicker">What We Do</p>
            <h2 class="mt-3 text-3xl font-extrabold text-slate-950">Working together to grow and defend the Internet in Tanzania.</h2>
        </div>
        <div class="grid gap-5 md:grid-cols-2">
            <div class="editorial-card p-6">
                <h3 class="text-xl font-bold text-slate-950">Build capacity</h3>
                <p class="mt-3 readable-copy">Training and learning programs help people understand Internet technology, governance, and online safety.</p>
            </div>
            <div class="editorial-card p-6">
                <h3 class="text-xl font-bold text-slate-950">Shape policy</h3>
                <p class="mt-3 readable-copy">We support informed dialogue so policy choices protect an open, secure, and trusted Internet.</p>
            </div>
            <div class="editorial-card p-6">
                <h3 class="text-xl font-bold text-slate-950">Strengthen communities</h3>
                <p class="mt-3 readable-copy">Members, partners, and local leaders collaborate on practical Internet development priorities.</p>
            </div>
            <div class="editorial-card p-6">
                <h3 class="text-xl font-bold text-slate-950">Promote access</h3>
                <p class="mt-3 readable-copy">We advocate for meaningful connectivity that is affordable, resilient, and useful in daily life.</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="site-kicker">Updates</p>
                <h2 class="mt-2 text-3xl font-extrabold text-slate-950">Latest News</h2>
            </div>
            <a href="{{ route('news.index') }}" class="text-sm font-bold text-cyan-700 hover:text-cyan-900">Read all insights</a>
        </div>
        <div class="grid gap-6 md:grid-cols-3">
            @forelse($latestNews as $item)
                <a href="{{ route('news.show', $item) }}" class="editorial-card p-6">
                    <p class="text-xs font-bold uppercase tracking-wide text-slate-500">{{ $item->published_at?->format('d M Y') }}</p>
                    <h3 class="mt-3 text-xl font-bold text-slate-950">{{ $item->title }}</h3>
                    <p class="mt-3 readable-copy">{{ $item->excerpt }}</p>
                </a>
            @empty
                <p class="text-slate-600">No updates available yet.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid gap-6 bg-slate-950 p-8 text-white md:grid-cols-[1fr_auto] md:items-center">
        <div>
            <p class="text-sm font-bold uppercase tracking-wider text-amber-300">Stay connected</p>
            <h2 class="mt-3 text-3xl font-extrabold text-white">Help build Tanzania’s Internet future.</h2>
            <p class="mt-3 max-w-3xl text-base leading-7 text-slate-200">Get news, updates, and ways to collaborate with the Internet Society Tanzania Chapter.</p>
        </div>
        <a href="{{ route('contact.index') }}" class="inline-flex items-center justify-center rounded-md bg-amber-400 px-5 py-3 text-sm font-bold text-slate-950 hover:bg-amber-300">Subscribe / Contact Us</a>
    </div>
</section>
@endsection
