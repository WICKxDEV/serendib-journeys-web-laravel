<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Helpers\SettingsHelper;

class SettingController extends Controller
{
    /**
     * Display the settings management page
     */
    public function index()
    {
        $groups = [
            'general' => 'General Settings',
            'home' => 'Homepage Content',
            'about' => 'About Page',
            'contact' => 'Contact Information',
            'social' => 'Social Media',
            'seo' => 'SEO Settings'
        ];

        $settings = [];
        foreach ($groups as $group => $label) {
            $settings[$group] = Setting::getByGroup($group);
        }

        return view('admin.settings.index', compact('settings', 'groups'));
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string'
        ]);

        foreach ($request->settings as $key => $value) {
            Setting::setValueByKey($key, $value ?? '');
        }

        SettingsHelper::clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }

    /**
     * Show specific group settings
     */
    public function show($group)
    {
        $settings = Setting::getByGroup($group);
        $groupLabel = ucfirst($group) . ' Settings';
        
        return view('admin.settings.show', compact('settings', 'group', 'groupLabel'));
    }

    /**
     * Create a new setting
     */
    public function create()
    {
        $groups = [
            'general' => 'General Settings',
            'home' => 'Homepage Content',
            'about' => 'About Page',
            'contact' => 'Contact Information',
            'social' => 'Social Media',
            'seo' => 'SEO Settings'
        ];

        $types = [
            'text' => 'Text Input',
            'textarea' => 'Text Area',
            'image' => 'Image Upload',
            'boolean' => 'Yes/No',
            'json' => 'JSON Data'
        ];

        return view('admin.settings.create', compact('groups', 'types'));
    }

    /**
     * Store a new setting
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|unique:settings,key',
            'value' => 'nullable|string',
            'type' => 'required|in:text,textarea,image,boolean,json',
            'group' => 'required|string',
            'label' => 'required|string',
            'description' => 'nullable|string'
        ]);

        Setting::create($request->all());

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting created successfully!');
    }

    /**
     * Edit a setting
     */
    public function edit(Setting $setting)
    {
        $groups = [
            'general' => 'General Settings',
            'home' => 'Homepage Content',
            'about' => 'About Page',
            'contact' => 'Contact Information',
            'social' => 'Social Media',
            'seo' => 'SEO Settings'
        ];

        $types = [
            'text' => 'Text Input',
            'textarea' => 'Text Area',
            'image' => 'Image Upload',
            'boolean' => 'Yes/No',
            'json' => 'JSON Data'
        ];

        return view('admin.settings.edit', compact('setting', 'groups', 'types'));
    }

    /**
     * Update a specific setting
     */
    public function updateSetting(Request $request, Setting $setting)
    {
        $request->validate([
            'value' => 'nullable|string',
            'type' => 'required|in:text,textarea,image,boolean,json',
            'group' => 'required|string',
            'label' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $setting->update($request->all());

        SettingsHelper::clearCache();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting updated successfully!');
    }

    /**
     * Delete a setting
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting deleted successfully!');
    }
}
