<?php

use App\Http\Controllers\Admin\CmsPageController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/e-learning', [CourseController::class, 'index'])->name('courses.index');
Route::get('/e-learning/{course:slug}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/pages/{page:slug}', [PageController::class, 'showCustom'])->name('cms-pages.show');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [CourseController::class, 'dashboard'])->name('dashboard');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news-manage/create', [NewsController::class, 'create'])->name('news.create');

    Route::post('/e-learning/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::get('/e-learning/{course:slug}/lessons/{lesson}', [CourseController::class, 'lesson'])->name('courses.lesson');
    Route::post('/e-learning/{course:slug}/lessons/{lesson}/complete', [CourseController::class, 'completeLesson'])->name('courses.lesson.complete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::redirect('/', '/admin/pages')->name('dashboard');

    Route::get('/pages', [CmsPageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [CmsPageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [CmsPageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{page}/edit', [CmsPageController::class, 'edit'])->name('pages.edit');
    Route::patch('/pages/{page}', [CmsPageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{page}', [CmsPageController::class, 'destroy'])->name('pages.destroy');

    Route::get('/settings/branding', [SiteSettingController::class, 'editBranding'])->name('settings.branding.edit');
    Route::post('/settings/branding', [SiteSettingController::class, 'updateBranding'])->name('settings.branding.update');
});

require __DIR__.'/auth.php';
