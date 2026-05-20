<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Tanzania Internet Governance Forum')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-900 antialiased">
    @php
        $resolvedNavLinks = collect($navigationPages ?? [])->map(function ($navPage) {
            if ($navPage->route_name && \Illuminate\Support\Facades\Route::has($navPage->route_name)) {
                return [
                    'label' => $navPage->nav_label ?: $navPage->title,
                    'url' => route($navPage->route_name),
                    'active' => request()->routeIs($navPage->route_name),
                ];
            }

            return [
                'label' => $navPage->nav_label ?: $navPage->title,
                'url' => route('cms-pages.show', $navPage),
                'active' => request()->routeIs('cms-pages.show') && request()->route('page')?->id === $navPage->id,
            ];
        });

        $getInvolvedLinks = [
            [
                'label' => 'Become an individual member',
                'url' => 'https://www.internetsociety.org/become-a-member/',
                'active' => false,
                'external' => true,
            ],
            [
                'label' => 'Become an organization member',
                'url' => 'https://www.internetsociety.org/about-internet-society/organization-members/',
                'active' => false,
                'external' => true,
            ],
            [
                'label' => 'Join a fellowship program',
                'url' => 'https://www.internetsociety.org/fellowships/',
                'active' => false,
                'external' => true,
            ],
            [
                'label' => 'Take a free online course',
                'url' => 'https://www.internetsociety.org/learning/',
                'active' => false,
                'external' => true,
            ],
            [
                'label' => 'Attend an event',
                'url' => route('cms-pages.show', ['page' => 'attend-an-event']),
                'active' => request()->routeIs('cms-pages.show') && request()->route('page')?->slug === 'attend-an-event',
            ],
        ];

        $getInvolvedActive = collect($getInvolvedLinks)->contains(fn ($item) => $item['active']);

        $ourWorkLinks = [
            [
                'label' => 'Our Work Overview',
                'url' => 'https://www.internetsociety.org/our-work/',
                'active' => false,
                'external' => true,
            ],
            [
                'label' => 'Connectivity',
                'url' => 'https://www.internetsociety.org/our-work/connectivity/',
                'active' => false,
                'external' => true,
            ],
            [
                'label' => 'How the Internet Works',
                'url' => 'https://www.internetsociety.org/our-work/how-the-internet-works/',
                'active' => false,
                'external' => true,
            ],
            [
                'label' => 'Internet Governance',
                'url' => 'https://www.internetsociety.org/our-work/internet-governance/',
                'active' => false,
                'external' => true,
            ],
            [
                'label' => 'Internet Policy',
                'url' => 'https://www.internetsociety.org/our-work/internet-policy/',
                'active' => false,
                'external' => true,
            ],
            [
                'label' => 'Privacy',
                'url' => 'https://www.internetsociety.org/our-work/privacy/',
                'active' => false,
                'external' => true,
            ],
            [
                'label' => 'Security',
                'url' => 'https://www.internetsociety.org/our-work/security/',
                'active' => false,
                'external' => true,
            ],
        ];

        $ourWorkActive = collect($ourWorkLinks)->contains(fn ($item) => $item['active']);

        $contactNavLink = $resolvedNavLinks->first(function ($link) {
            $label = strtolower(trim($link['label']));

            return in_array($label, ['contact us', 'contact'], true)
                || str_contains($link['url'], route('contact.index'));
        }) ?: [
            'label' => 'Contact Us',
            'url' => route('contact.index'),
            'active' => request()->routeIs('contact.*'),
        ];

        $resolvedPrimaryNavLinks = $resolvedNavLinks->reject(function ($link) {
            return in_array(strtolower($link['label']), ['our work', 'e-learning', 'programs'], true)
                || (str_starts_with($link['url'], route('courses.index')));
        })->reject(function ($link) {
            $label = strtolower(trim($link['label']));

            return in_array($label, ['contact us', 'contact'], true)
                || str_contains($link['url'], route('contact.index'));
        })->values();
    @endphp

    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <nav class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="flex items-center gap-3 font-bold leading-none text-slate-900" style="min-height: 44px;">
                @if(!empty($siteLogoUrl))
                    <img src="{{ $siteLogoUrl }}" alt="Internet Society Tanzania logo" class="h-10 w-auto object-contain">
                @else
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-md bg-cyan-700 text-sm font-bold text-white">TZ</span>
                    <div class="leading-tight">
                        <span class="block text-base text-slate-900">Internet Society</span>
                        <span class="block text-xs text-cyan-700">Tanzania Chapter</span>
                    </div>
                @endif
            </a>

            <div class="hidden items-center gap-6 text-sm font-medium md:flex">
                @forelse($resolvedPrimaryNavLinks as $link)
                    <a href="{{ $link['url'] }}" class="hover:text-cyan-700 {{ $link['active'] ? 'text-cyan-700' : 'text-slate-700' }}">{{ $link['label'] }}</a>
                @empty
                    <a href="{{ route('home') }}" class="hover:text-cyan-700 {{ request()->routeIs('home') ? 'text-cyan-700' : 'text-slate-700' }}">Home</a>
                @endforelse

                <div
                    x-data="{ open: false }"
                    class="relative"
                    @mouseenter="open = true"
                    @mouseleave="open = false"
                    @keydown.escape.window="open = false"
                >
                    <button
                        type="button"
                        class="inline-flex items-center gap-1 hover:text-cyan-700 {{ $ourWorkActive ? 'text-cyan-700' : 'text-slate-700' }}"
                        :aria-expanded="open.toString()"
                        aria-haspopup="true"
                        @click="open = !open"
                    >
                        <span>Our Work</span>
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.25a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div
                        x-cloak
                        x-show="open"
                        x-transition.origin.top.left
                        @click.outside="open = false"
                        class="absolute left-0 mt-3 w-80 rounded-md border border-slate-200 bg-white py-2 shadow-lg"
                        role="menu"
                    >
                        @foreach($ourWorkLinks as $item)
                            <a
                                href="{{ $item['url'] }}"
                                @if(!empty($item['external'])) target="_blank" rel="noopener noreferrer" @endif
                                class="block px-4 py-2 text-sm hover:bg-cyan-50 hover:text-cyan-800 {{ $item['active'] ? 'text-cyan-700' : 'text-slate-700' }}"
                                role="menuitem"
                            >
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div
                    x-data="{ open: false }"
                    class="relative"
                    @mouseenter="open = true"
                    @mouseleave="open = false"
                    @keydown.escape.window="open = false"
                >
                    <button
                        type="button"
                        class="inline-flex items-center gap-1 hover:text-cyan-700 {{ $getInvolvedActive ? 'text-cyan-700' : 'text-slate-700' }}"
                        :aria-expanded="open.toString()"
                        aria-haspopup="true"
                        @click="open = !open"
                    >
                        <span>Get Involved</span>
                        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 10.94l3.71-3.71a.75.75 0 1 1 1.06 1.06l-4.24 4.25a.75.75 0 0 1-1.06 0L5.21 8.29a.75.75 0 0 1 .02-1.08Z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div
                        x-cloak
                        x-show="open"
                        x-transition.origin.top.left
                        @click.outside="open = false"
                        class="absolute left-0 mt-3 w-72 rounded-md border border-slate-200 bg-white py-2 shadow-lg"
                        role="menu"
                    >
                        @foreach($getInvolvedLinks as $item)
                            <a
                                href="{{ $item['url'] }}"
                                @if(!empty($item['external'])) target="_blank" rel="noopener noreferrer" @endif
                                class="block px-4 py-2 text-sm hover:bg-cyan-50 hover:text-cyan-800 {{ $item['active'] ? 'text-cyan-700' : 'text-slate-700' }}"
                                role="menuitem"
                            >
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ $contactNavLink['url'] }}" class="hover:text-cyan-700 {{ $contactNavLink['active'] ? 'text-cyan-700' : 'text-slate-700' }}">{{ $contactNavLink['label'] }}</a>
            </div>

            @auth
                <div class="flex items-center gap-2">
                    <a href="{{ route('dashboard') }}" class="rounded-md border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Dashboard</a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="rounded-md border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-md bg-cyan-700 px-3 py-2 text-sm font-semibold text-white hover:bg-cyan-800">Logout</button>
                    </form>
                </div>
            @endauth
        </nav>
    </header>

    @if (session('status'))
        <div class="mx-auto mt-4 max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-md border border-green-300 bg-green-50 px-4 py-3 text-sm text-green-800">
                {{ session('status') }}
            </div>
        </div>
    @endif

    <main class="min-h-[70vh]">
        @yield('content')
    </main>

    <footer class="bg-slate-950 text-slate-300">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
            <div class="grid gap-10 lg:grid-cols-[1.4fr_3fr]">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-wide text-white">
                        <svg class="h-4 w-4 text-amber-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path d="M12 3l7 3v5c0 4.5-2.9 8.4-7 10-4.1-1.6-7-5.5-7-10V6l7-3Z" />
                            <path d="m9.5 12 1.7 1.7 3.6-4" />
                        </svg>
                        Trusted Internet Community
                    </div>

                    <a href="{{ route('home') }}" class="mt-8 flex items-center gap-3">
                        @if(!empty($siteLogoUrl))
                            <img src="{{ $siteLogoUrl }}" alt="Internet Society Tanzania logo" class="h-12 w-auto object-contain">
                        @else
                            <span class="inline-flex h-12 w-12 items-center justify-center rounded-md bg-cyan-700 text-sm font-bold text-white">TZ</span>
                        @endif
                        <span class="text-2xl font-extrabold text-white">Internet Society Tanzania</span>
                    </a>

                    <p class="mt-6 max-w-md text-base leading-8 text-slate-400">Building an open, globally connected, secure, and trustworthy Internet for people and communities across Tanzania.</p>

                    <div class="mt-8 flex gap-3">
                        <a href="#" aria-label="Facebook" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-slate-300 hover:bg-cyan-700 hover:text-white">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M14 8h3V4h-3c-3.1 0-5 1.9-5 5v2H6v4h3v5h4v-5h3l1-4h-4V9c0-.7.3-1 1-1Z"/></svg>
                        </a>
                        <a href="#" aria-label="X" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-slate-300 hover:bg-cyan-700 hover:text-white">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="m4 4 16 16"/><path d="M20 4 4 20"/></svg>
                        </a>
                        <a href="#" aria-label="LinkedIn" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-slate-300 hover:bg-cyan-700 hover:text-white">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.9 8.8H3.5V20h3.4V8.8ZM5.2 7.3a2 2 0 1 0 0-4 2 2 0 0 0 0 4ZM20.5 13.8c0-3.1-1.7-5.2-4.5-5.2-1.5 0-2.6.8-3.1 1.6V8.8H9.6V20H13v-5.9c0-1.6.8-2.5 2-2.5s2 .9 2 2.5V20h3.5v-6.2Z"/></svg>
                        </a>
                        <a href="#" aria-label="Instagram" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-white/10 text-slate-300 hover:bg-cyan-700 hover:text-white">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect width="16" height="16" x="4" y="4" rx="4"/><circle cx="12" cy="12" r="3.5"/><path d="M17.5 6.5h.01"/></svg>
                        </a>
                    </div>
                </div>

                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-white">Quick Links</p>
                        <div class="mt-5 space-y-4">
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="{{ route('home') }}"><span class="text-amber-400">›</span> Home</a>
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="{{ route('about') }}"><span class="text-amber-400">›</span> About Us</a>
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="{{ route('courses.index') }}"><span class="text-amber-400">›</span> Our Work</a>
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="{{ route('contact.index') }}"><span class="text-amber-400">›</span> Get Involved</a>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-white">Resources</p>
                        <div class="mt-5 space-y-4">
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="{{ route('news.index') }}"><span class="text-teal-400">›</span> News</a>
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="{{ route('courses.index') }}"><span class="text-teal-400">›</span> Courses</a>
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="https://www.internetsociety.org/learning/" target="_blank" rel="noopener noreferrer"><span class="text-teal-400">›</span> Learning</a>
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="https://www.internetsociety.org/our-work/" target="_blank" rel="noopener noreferrer"><span class="text-teal-400">›</span> Global Work</a>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-white">Support</p>
                        <div class="mt-5 space-y-4">
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="{{ route('contact.index') }}"><span class="text-amber-400">›</span> Contact Us</a>
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="{{ route('register') }}"><span class="text-amber-400">›</span> Register</a>
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="{{ route('login') }}"><span class="text-amber-400">›</span> Member Login</a>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-white">Legal</p>
                        <div class="mt-5 space-y-4">
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="#"><span class="text-amber-400">›</span> Privacy</a>
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="#"><span class="text-amber-400">›</span> Terms</a>
                            <a class="flex items-center gap-3 text-slate-400 hover:text-white" href="#"><span class="text-amber-400">›</span> Cookies</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-14 border-t border-white/10 pt-10">
                <div class="grid gap-10 lg:grid-cols-[1fr_2fr] lg:items-start">
                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-white">Contact</p>
                        <div class="mt-5 space-y-4 text-slate-400">
                            <p class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-amber-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a7 7 0 0 0-7 7c0 5.2 7 13 7 13s7-7.8 7-13a7 7 0 0 0-7-7Zm0 9.5A2.5 2.5 0 1 1 12 6a2.5 2.5 0 0 1 0 5.5Z"/></svg>
                                United Republic of Tanzania
                            </p>
                            <p class="flex items-center gap-3">
                                <svg class="h-5 w-5 text-amber-400" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Zm-.4 4.2-7.1 4.7a1 1 0 0 1-1.1 0L4.4 8.2 5.5 6.6l6.5 4.3 6.5-4.3 1.1 1.6Z"/></svg>
                                info@isoc.ne.tz
                            </p>
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-bold uppercase tracking-wider text-white">Stay Updated</p>
                        <p class="mt-4 text-slate-400">Subscribe for announcements, community opportunities, and Internet governance updates.</p>
                        <form action="{{ route('contact.index') }}" method="GET" class="mt-6 grid gap-3 sm:grid-cols-[1fr_auto]">
                            <label for="footer-email" class="sr-only">Email address</label>
                            <input id="footer-email" name="email" type="email" placeholder="Your email address" class="min-h-12 rounded-md border border-white/10 bg-white/10 px-4 text-white placeholder:text-slate-500 focus:border-cyan-400 focus:ring-cyan-400">
                            <button class="inline-flex min-h-12 items-center justify-center gap-2 rounded-md bg-blue-600 px-6 font-bold text-white hover:bg-blue-500">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21.8 3.2a1 1 0 0 0-1-.2l-18 7a1 1 0 0 0 .1 1.9l7.1 2.1 2.1 7.1a1 1 0 0 0 .9.7h.1a1 1 0 0 0 .9-.6l8-17a1 1 0 0 0-.2-1Zm-8.5 14.6-1.4-4.6 4.2-4.2-5.3 3.1-4.6-1.4 12.8-5-5.7 12.1Z"/></svg>
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center text-sm text-slate-500">
                © {{ date('Y') }} Internet Society Tanzania Chapter. All rights reserved. | <a href="{{ route('home') }}" class="hover:text-white">Home</a> | <a href="{{ route('login') }}" class="hover:text-white">Staff Portal</a>
            </div>
        </div>
    </footer>
</body>
</html>
