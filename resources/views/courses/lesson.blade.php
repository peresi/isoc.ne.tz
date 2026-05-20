@extends('layouts.site')

@section('title', $lesson->title . ' - ' . $course->title)

@section('content')
<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid gap-8 lg:grid-cols-3">
        <article class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white p-8">
            <p class="text-xs font-semibold uppercase tracking-wide text-blue-700">{{ $course->title }}</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-900">{{ $lesson->title }}</h1>
            <p class="mt-2 text-sm text-slate-500">Estimated time: {{ $lesson->duration_minutes }} minutes</p>

            @if($lesson->video_url)
                <div class="mt-6 aspect-video overflow-hidden rounded-xl border border-slate-200 bg-black">
                    <iframe src="{{ $lesson->video_url }}" class="h-full w-full" allowfullscreen></iframe>
                </div>
            @endif

            <div class="prose prose-slate mt-6 max-w-none">
                <p>{{ $lesson->content }}</p>
            </div>

            @if(!in_array($lesson->id, $completedLessonIds, true))
                <form method="POST" action="{{ route('courses.lesson.complete', [$course, $lesson]) }}" class="mt-8">
                    @csrf
                    <button class="rounded-md bg-green-600 px-4 py-2 text-sm font-semibold text-white hover:bg-green-700">Mark Lesson as Complete</button>
                </form>
            @else
                <p class="mt-8 inline-flex rounded-md bg-green-100 px-3 py-2 text-sm font-semibold text-green-800">Completed</p>
            @endif
        </article>

        <aside class="rounded-2xl border border-slate-200 bg-white p-6">
            <h2 class="text-lg font-semibold text-slate-900">Lessons</h2>
            <ul class="mt-4 space-y-2">
                @foreach($course->lessons as $item)
                    <li>
                        <a href="{{ route('courses.lesson', [$course, $item]) }}" class="block rounded-md border p-3 text-sm {{ $item->id === $lesson->id ? 'border-blue-300 bg-blue-50 text-blue-900' : 'border-slate-200 text-slate-700 hover:border-blue-200' }}">
                            {{ $item->position }}. {{ $item->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('courses.show', $course) }}" class="mt-4 inline-block text-sm font-semibold text-blue-700 hover:text-blue-800">Back to course</a>
        </aside>
    </div>
</section>
@endsection
