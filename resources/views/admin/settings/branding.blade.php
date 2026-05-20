@extends('layouts.site')

@section('title', 'Admin - Branding')

@section('content')
<section class="mx-auto max-w-4xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Branding & Logo</h1>
            <p class="mt-2 text-slate-600">Upload the logo displayed at the top-left of the navigation bar.</p>
        </div>
        <a href="{{ route('admin.pages.index') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">Back to Pages</a>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6">
        @if($logoPath)
            <div class="mb-6">
                <p class="text-sm font-semibold text-slate-700">Current Logo</p>
                <img src="{{ Storage::disk('public')->url($logoPath) }}" alt="Current logo" class="mt-3 h-16 w-auto object-contain">
            </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.branding.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700" for="logo">Logo Image</label>
                <input id="logo" type="file" name="logo" accept=".jpg,.jpeg,.png,.svg,.webp" class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm">
                @error('logo')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            @if($logoPath)
                <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                    <input type="checkbox" name="remove_logo" value="1" class="rounded border-slate-300 text-blue-700">
                    Remove current logo
                </label>
            @endif

            <div>
                <button class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Save Branding</button>
            </div>
        </form>
    </div>
</section>
@endsection
