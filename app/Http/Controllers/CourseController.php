<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index', [
            'cmsPage' => CmsPage::query()->where('slug', 'our-work')->first(),
            'courses' => Course::withCount('lessons')->latest()->get(),
        ]);
    }

    public function show(Course $course)
    {
        $course->load('lessons');

        $enrollment = Auth::check()
            ? Enrollment::where('user_id', Auth::id())->where('course_id', $course->id)->first()
            : null;

        $completedLessonIds = $enrollment?->completed_lessons ?? [];
        $progress = $course->lessons->count() > 0
            ? (int) round((count($completedLessonIds) / $course->lessons->count()) * 100)
            : 0;

        return view('courses.show', [
            'course' => $course,
            'enrollment' => $enrollment,
            'completedLessonIds' => $completedLessonIds,
            'progress' => $progress,
        ]);
    }

    public function enroll(Course $course)
    {
        Enrollment::firstOrCreate(
            ['user_id' => Auth::id(), 'course_id' => $course->id],
            ['enrolled_at' => now(), 'completed_lessons' => []]
        );

        return redirect()->route('courses.show', $course)->with('status', 'You are now enrolled in this course.');
    }

    public function lesson(Course $course, Lesson $lesson)
    {
        abort_unless($lesson->course_id === $course->id, 404);

        $enrollment = Enrollment::where('user_id', Auth::id())->where('course_id', $course->id)->first();
        abort_unless($enrollment, 403);

        $enrollment->update([
            'last_lesson_id' => $lesson->id,
        ]);

        $course->load('lessons');

        return view('courses.lesson', [
            'course' => $course,
            'lesson' => $lesson,
            'enrollment' => $enrollment,
            'completedLessonIds' => $enrollment->completed_lessons ?? [],
        ]);
    }

    public function completeLesson(Course $course, Lesson $lesson)
    {
        abort_unless($lesson->course_id === $course->id, 404);

        $enrollment = Enrollment::where('user_id', Auth::id())->where('course_id', $course->id)->first();
        abort_unless($enrollment, 403);

        $completed = $enrollment->completed_lessons ?? [];
        if (! in_array($lesson->id, $completed, true)) {
            $completed[] = $lesson->id;
        }

        $enrollment->update([
            'completed_lessons' => $completed,
            'last_lesson_id' => $lesson->id,
        ]);

        return redirect()->route('courses.lesson', [$course, $lesson])->with('status', 'Lesson marked as complete.');
    }

    public function dashboard()
    {
        $enrollments = Enrollment::with(['course.lessons', 'lastLesson'])
            ->where('user_id', Auth::id())
            ->latest('enrolled_at')
            ->get();

        return view('dashboard', [
            'enrollments' => $enrollments,
        ]);
    }
}
