<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    // show form
    public function index()
    {
        // sab settings ko key => value ke form me bhej do
        $settings = Setting::where('group', 'general')
            ->pluck('value', 'key')
            ->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    // save / update
    public function update(Request $request)
    {
        $rules = [
            'site_name' => 'nullable|string|max:150',
            'site_tagline' => 'nullable|string|max:255',
            'site_email' => 'nullable|email|max:150',
            'site_phone' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:png,ico,svg|max:1024',
            'address' => 'nullable|string|max:500',
            'footer_text' => 'nullable|string|max:500',
            'meta_title' => 'nullable|string|max:200',
            'meta_description' => 'nullable|string|max:1000',
            'items_per_page' => 'nullable|integer|min:1|max:100',
            'timezone' => 'nullable|string|max:100',
            'maintenance_mode' => 'nullable|boolean',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'google_analytics' => 'nullable|string',
        ];

        $data = $request->validate($rules);

        /* ---------- FILE UPLOADS ---------- */

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            $data['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        // checkbox fix
        $data['maintenance_mode'] = $request->has('maintenance_mode') ? 1 : 0;

        /* ---------- SAVE AS KEY / VALUE ---------- */

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                [
                    'value' => $value,
                    'group' => 'general',
                ]
            );
        }

        return back()->with('success', 'Settings saved successfully');
    }
}
