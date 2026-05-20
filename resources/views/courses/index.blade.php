@extends('layouts.site')

@section('title', 'Our Work - Tanzania IGF')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-slate-900">{{ $cmsPage?->title ?: 'Our Work' }}</h1>
    <p class="mt-2 text-slate-600">{{ $cmsPage?->content ?: 'Register and learn internet governance through structured courses.' }}</p>

    <div class="mt-10 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($courses as $course)
            <a href="{{ route('courses.show', $course) }}" class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                @if($course->image_url)
                    <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="h-44 w-full object-cover">
                @endif
                <div class="p-6">
                    <div class="mb-2 flex items-center justify-between">
                        <p class="text-xs font-semibold uppercase tracking-wide text-blue-700">{{ $course->level }}</p>
                        <p class="text-xs text-slate-500">{{ $course->duration }}</p>
                    </div>
                    <h2 class="text-lg font-bold text-slate-900">{{ $course->title }}</h2>
                    <p class="mt-2 text-sm text-slate-600">{{ $course->summary }}</p>
                    <p class="mt-4 text-xs font-medium text-slate-500">{{ $course->lessons_count }} lessons</p>
                </div>
            </a>
        @empty
            <p class="text-slate-600">No courses available.</p>
        @endforelse
    </div>
</section>
@endsection
