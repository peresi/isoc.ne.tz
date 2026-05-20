<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    public function editBranding()
    {
        return view('admin.settings.branding', [
            'logoPath' => SiteSetting::getValue('site_logo_path'),
        ]);
    }

    public function updateBranding(Request $request)
    {
        $validated = $request->validate([
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],
        ]);

        $currentLogo = SiteSetting::getValue('site_logo_path');

        if (($validated['remove_logo'] ?? false) && $currentLogo) {
            Storage::disk('public')->delete($currentLogo);
            SiteSetting::setValue('site_logo_path', null);
        }

        if ($request->hasFile('logo')) {
            if ($currentLogo) {
                Storage::disk('public')->delete($currentLogo);
            }

            $path = $request->file('logo')->store('branding', 'public');
            SiteSetting::setValue('site_logo_path', $path);
        }

        return redirect()->route('admin.settings.branding.edit')->with('status', 'Branding updated successfully.');
    }
}
