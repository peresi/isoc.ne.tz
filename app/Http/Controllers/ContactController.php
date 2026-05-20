<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index', [
            'cmsPage' => CmsPage::query()->where('slug', 'contact-us')->first(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:180'],
            'subject' => ['required', 'string', 'max:180'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        ContactMessage::create($validated);

        return redirect()->route('contact.index')->with('status', 'Thank you for contacting TIGF. We will respond shortly.');
    }
}
