@extends('layouts.site')

@section('title', 'Admin - Manage Pages')

@section('content')
<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Admin Dashboard: Manage Pages</h1>
            <p class="mt-2 text-slate-600">Manage Home, About Us, Our Work, News & Insights, Contact Us, and create new pages.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.settings.branding.edit') }}" class="rounded-md border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-100">Branding / Logo</a>
            <a href="{{ route('admin.pages.create') }}" class="rounded-md bg-blue-700 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-800">Add New Page</a>
        </div>
    </div>

    <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Title</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Slug</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Navigation</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Status</th>
                    <th class="px-4 py-3 text-left font-semibold text-slate-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($pages as $page)
                    <tr>
                        <td class="px-4 py-3 text-slate-900">
                            {{ $page->title }}
                            @if($page->is_system)
                                <span class="ml-2 rounded bg-blue-100 px-2 py-0.5 text-xs font-semibold text-blue-900">System</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $page->slug }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $page->in_navigation ? 'Shown' : 'Hidden' }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $page->is_published ? 'Published' : 'Draft' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.pages.edit', $page) }}" class="rounded border border-slate-300 px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-100">Edit</a>
                                @if(!$page->is_system)
                                    <form action="{{ route('admin.pages.destroy', $page) }}" method="POST" onsubmit="return confirm('Delete this page?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="rounded border border-red-300 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-50">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-600">No pages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>
@endsection
