@extends('layouts.site')

@section('title', 'Learner Dashboard - Tanzania IGF')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-slate-900">My Learning Dashboard</h1>
    <p class="mt-2 text-slate-600">Track your enrolled internet governance courses and progress.</p>

    <div class="mt-8 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($enrollments as $enrollment)
            @php
                $totalLessons = $enrollment->course->lessons->count();
                $completed = count($enrollment->completed_lessons ?? []);
                $progress = $totalLessons > 0 ? (int) round(($completed / $totalLessons) * 100) : 0;
            @endphp
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900">{{ $enrollment->course->title }}</h2>
                <p class="mt-1 text-xs text-slate-500">{{ $enrollment->course->level }} • {{ $enrollment->course->duration }}</p>
                <div class="mt-4 h-2 overflow-hidden rounded-full bg-slate-100">
                    <div class="h-2 bg-blue-700" style="width: {{ $progress }}%"></div>
                </div>
                <p class="mt-2 text-sm text-slate-600">{{ $progress }}% complete ({{ $completed }}/{{ $totalLessons }} lessons)</p>
                <a href="{{ route('courses.show', $enrollment->course) }}" class="mt-4 inline-block text-sm font-semibold text-blue-700 hover:text-blue-800">Continue course</a>
            </div>
        @empty
            <div class="rounded-2xl border border-slate-200 bg-white p-8 lg:col-span-2">
                <h2 class="text-lg font-semibold text-slate-900">No courses yet</h2>
                <p class="mt-2 text-slate-600">You have not enrolled in any course. Start your learning journey now.</p>
                <a href="{{ route('courses.index') }}" class="mt-4 inline-block rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Browse courses</a>
            </div>
        @endforelse
    </div>
</section>
@endsection
