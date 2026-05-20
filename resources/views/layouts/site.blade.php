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
        <nav class="mx-auto flex max-w-7xl items-center justify-between px-4 py-4 sm:px-6 lg:px-8 text-white">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-white leading-none" style="min-height: 44px;">
                @if(!empty($siteLogoUrl))
                    <img src="{{ $siteLogoUrl }}" alt="Internet Society Tanzania logo" class="h-10 w-auto object-contain">
                @else
                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-md bg-blue-700 text-sm font-bold text-white">TZ</span>
                    <div class="leading-tight">
                        <span class="block text-base text-blue-900">Internet Society</span>
                        <span class="block text-xs text-blue-700">Tanzania Chapter</span>
                    </div>
                @endif
            </a>

            <div class="hidden items-center gap-6 text-sm font-medium md:flex">
                @forelse($resolvedPrimaryNavLinks as $link)
                    <a href="{{ $link['url'] }}" class="hover:text-blue-300 {{ $link['active'] ? 'text-white' : 'text-slate-200' }}">{{ $link['label'] }}</a>
                @empty
                    <a href="{{ route('home') }}" class="hover:text-blue-300 {{ request()->routeIs('home') ? 'text-white' : 'text-slate-200' }}">Home</a>
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
                        class="inline-flex items-center gap-1 hover:text-blue-700 {{ $ourWorkActive ? 'text-blue-700' : 'text-slate-600' }}"
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
                        class="absolute left-0 mt-3 w-80 rounded-md border border-slate-200 bg-white py-2 shadow-sm"
                        role="menu"
                    >
                        @foreach($ourWorkLinks as $item)
                            <a
                                href="{{ $item['url'] }}"
                                @if(!empty($item['external'])) target="_blank" rel="noopener noreferrer" @endif
                                class="block px-4 py-2 text-sm hover:bg-slate-100 hover:text-blue-700 {{ $item['active'] ? 'text-blue-700' : 'text-slate-700' }}"
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
                        class="inline-flex items-center gap-1 hover:text-blue-700 {{ $getInvolvedActive ? 'text-blue-700' : 'text-slate-600' }}"
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
                        class="absolute left-0 mt-3 w-72 rounded-md border border-slate-200 bg-white py-2 shadow-sm"
                        role="menu"
                    >
                        @foreach($getInvolvedLinks as $item)
                            <a
                                href="{{ $item['url'] }}"
                                @if(!empty($item['external'])) target="_blank" rel="noopener noreferrer" @endif
                                class="block px-4 py-2 text-sm hover:bg-slate-100 hover:text-blue-700 {{ $item['active'] ? 'text-blue-700' : 'text-slate-700' }}"
                                role="menuitem"
                            >
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ $contactNavLink['url'] }}" class="hover:text-blue-700 {{ $contactNavLink['active'] ? 'text-blue-700' : 'text-slate-600' }}">{{ $contactNavLink['label'] }}</a>
            </div>

            <div class="flex items-center gap-2">
                @auth
                    <a href="{{ route('dashboard') }}" class="rounded-md border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Dashboard</a>
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="rounded-md border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="rounded-md bg-blue-700 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-800">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="rounded-md border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">Login</a>
                    <a href="{{ route('register') }}" class="rounded-md bg-blue-700 px-3 py-2 text-sm font-semibold text-white hover:bg-blue-800">Become a Member</a>
                @endauth
            </div>
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

    <footer class="border-t border-slate-200 bg-white">
        <div class="mx-auto grid max-w-7xl gap-8 px-4 py-10 text-sm text-slate-600 sm:px-6 lg:px-8 md:grid-cols-3">
            <div>
                <p class="text-base font-semibold text-slate-900">Internet Society Tanzania Chapter</p>
                <p class="mt-2">Building an open, globally connected, and trusted Internet in Tanzania.</p>
            </div>
            <div>
                <p class="text-base font-semibold text-slate-900">Additional Links</p>
                <div class="mt-2 space-y-1">
                    @forelse($resolvedNavLinks as $link)
                        <a class="block hover:text-blue-700" href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                    @empty
                        <a class="block hover:text-blue-700" href="{{ route('about') }}">About Us</a>
                        <a class="block hover:text-blue-700" href="{{ route('courses.index') }}">Our Work</a>
                        <a class="block hover:text-blue-700" href="{{ route('news.index') }}">News & Insights</a>
                        <a class="block hover:text-blue-700" href="{{ route('contact.index') }}">Get Involved</a>
                    @endforelse
                </div>
            </div>
            <div>
                <p class="text-base font-semibold text-slate-900">Stay connected</p>
                <p class="mt-2">Get updates on digital inclusion, Internet governance, and community activities.</p>
                <a href="{{ route('contact.index') }}" class="mt-3 inline-block rounded-md bg-blue-700 px-4 py-2 font-semibold text-white hover:bg-blue-800">Subscribe / Contact</a>
            </div>
        </div>
        <div class="border-t border-slate-200 py-4 text-center text-xs text-slate-500">
            © {{ date('Y') }} Internet Society Tanzania Chapter. All rights reserved.
        </div>
    </footer>
</body>
</html>
