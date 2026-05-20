@extends('layouts.site')

@section('title', 'Contact Us - Tanzania IGF')

@section('content')
<section class="mx-auto max-w-5xl px-4 py-16 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-slate-900">{{ $cmsPage?->title ?: 'Contact Us' }}</h1>
    <p class="mt-3 text-slate-600">{{ $cmsPage?->content ?: 'Reach out for partnerships, speaking invitations, media, or community collaboration.' }}</p>

    <div class="mt-10 grid gap-8 lg:grid-cols-2">
        <div class="rounded-2xl border border-slate-200 bg-white p-6">
            <h2 class="text-xl font-semibold text-slate-900">Contact Information</h2>
            <div class="mt-4 space-y-3 text-sm text-slate-600">
                <p><span class="font-semibold text-slate-800">Email:</span> info@tigf.or.tz</p>
                <p><span class="font-semibold text-slate-800">Phone:</span> 0748282888</p>
                <p><span class="font-semibold text-slate-800">Address:</span> Dar es Salaam, Tanzania</p>
            </div>
        </div>

        <form method="POST" action="{{ route('contact.store') }}" class="space-y-4 rounded-2xl border border-slate-200 bg-white p-6">
            @csrf

            <div>
                <label for="name" class="mb-1 block text-sm font-medium text-slate-700">Full Name</label>
                <input id="name" name="name" value="{{ old('name') }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" required>
                @error('name')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" required>
                @error('email')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="subject" class="mb-1 block text-sm font-medium text-slate-700">Subject</label>
                <input id="subject" name="subject" value="{{ old('subject') }}" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" required>
                @error('subject')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="message" class="mb-1 block text-sm font-medium text-slate-700">Message</label>
                <textarea id="message" name="message" rows="6" class="w-full rounded-md border-slate-300 focus:border-blue-500 focus:ring-blue-500" required>{{ old('message') }}</textarea>
                @error('message')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            <button class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Send Message</button>
        </form>
    </div>
</section>
@endsection
