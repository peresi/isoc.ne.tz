@extends('layouts.site')

@section('title', $course->title . ' - E-Learning')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="grid gap-8 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-2xl border border-slate-200 bg-white p-8">
            <p class="text-xs font-semibold uppercase tracking-wide text-blue-700">{{ $course->level }} • {{ $course->duration }}</p>
            <h1 class="mt-2 text-3xl font-bold text-slate-900">{{ $course->title }}</h1>
            <p class="mt-4 text-slate-600">{{ $course->description }}</p>

            @guest
                <div class="mt-6 rounded-lg border border-blue-200 bg-blue-50 p-4 text-sm text-blue-900">
                    Please <a class="font-semibold underline" href="{{ route('register') }}">register</a> or <a class="font-semibold underline" href="{{ route('login') }}">login</a> to enroll and start learning.
                </div>
            @endguest

            @auth
                @if($enrollment)
                    <div class="mt-6 rounded-lg border border-green-200 bg-green-50 p-4">
                        <p class="text-sm font-medium text-green-900">You are enrolled in this course.</p>
                        <div class="mt-3 h-2 overflow-hidden rounded-full bg-green-100">
                            <div class="h-2 bg-green-600" style="width: {{ $progress }}%"></div>
                        </div>
                        <p class="mt-2 text-xs text-green-800">Progress: {{ $progress }}%</p>
                    </div>
                @else
                    <form method="POST" action="{{ route('courses.enroll', $course) }}" class="mt-6">
                        @csrf
                        <button class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Enroll Now</button>
                    </form>
                @endif
            @endauth
        </div>

        <aside class="rounded-2xl border border-slate-200 bg-white p-6">
            <h2 class="text-lg font-semibold text-slate-900">Course Content</h2>
            <ul class="mt-4 space-y-3">
                @foreach($course->lessons as $lesson)
                    <li class="rounded-md border border-slate-200 p-3">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <p class="text-sm font-semibold text-slate-900">{{ $lesson->position }}. {{ $lesson->title }}</p>
                                <p class="text-xs text-slate-500">{{ $lesson->duration_minutes }} min</p>
                            </div>
                            @auth
                                @if($enrollment)
                                    <a href="{{ route('courses.lesson', [$course, $lesson]) }}" class="text-xs font-semibold text-blue-700 hover:text-blue-800">Open</a>
                                @else
                                    <span class="text-xs font-medium text-slate-400">Locked</span>
                                @endif
                            @else
                                <span class="text-xs font-medium text-slate-400">Locked</span>
                            @endauth
                        </div>
                        @if(in_array($lesson->id, $completedLessonIds, true))
                            <p class="mt-2 text-xs font-semibold text-green-700">Completed</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
</section>
@endsection
