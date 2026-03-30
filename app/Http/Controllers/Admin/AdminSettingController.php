<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Auth;

class AdminSettingController extends Controller
{
    public function logo()
    {
        $setting = Setting::where('id',1)->first();
        return view('admin.setting.logo', compact('setting'));
    }

    public function logo_update(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $setting = Setting::where('id',1)->first();
        $final_name = 'logo_'.time().'.'.$request->logo->extension();
        $request->logo->move(public_path('uploads'), $final_name);
        $setting->logo = $final_name;
        $setting->save();

        return redirect()->back()->with('success', 'Logo is updated successfully.');
    }

    public function favicon()
    {
        $setting = Setting::where('id',1)->first();
        return view('admin.setting.favicon', compact('setting'));
    }

    public function favicon_update(Request $request)
    {
        $request->validate([
            'favicon' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $setting = Setting::where('id',1)->first();
        $final_name = 'favicon_'.time().'.'.$request->favicon->extension();
        $request->favicon->move(public_path('uploads'), $final_name);
        $setting->favicon = $final_name;
        $setting->save();

        return redirect()->back()->with('success', 'Favicon is updated successfully.');
    }

    public function top_bar()
    {
        $setting = Setting::where('id',1)->first();
        return view('admin.setting.top_bar', compact('setting'));
    }

    public function top_bar_update(Request $request)
    {
        $setting = Setting::where('id',1)->first();
        $setting->top_bar_phone = $request->top_bar_phone;
        $setting->top_bar_email = $request->top_bar_email;
        $setting->save();

        return redirect()->back()->with('success', 'Top Bar information is updated successfully.');
    }

    public function footer()
    {
        $setting = Setting::where('id',1)->first();
        return view('admin.setting.footer', compact('setting'));
    }

    public function footer_update(Request $request)
    {
        $setting = Setting::where('id',1)->first();
        $setting->footer_facebook = $request->footer_facebook;
        $setting->footer_twitter = $request->footer_twitter;
        $setting->footer_linkedin = $request->footer_linkedin;
        $setting->footer_instagram = $request->footer_instagram;
        $setting->footer_address = $request->footer_address;
        $setting->footer_phone = $request->footer_phone;
        $setting->footer_email = $request->footer_email;
        $setting->footer_working_hours = $request->footer_working_hours;
        $setting->footer_copyright = $request->footer_copyright;
        $setting->save();

        return redirect()->back()->with('success', 'Footer information is updated successfully.');
    }
}
