<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Auth;

class AdminPageController extends Controller
{
    public function page_privacy()
    {
        $page_data = Page::where('id',1)->first();
        return view('admin.page.privacy', compact('page_data'));
    }

    public function page_privacy_update(Request $request)
    {
        $request->validate([
            'privacy_content' => 'required',
        ]);

        $page = Page::where('id',1)->first();
        $page->privacy_content = $request->privacy_content;
        $page->save();

        return redirect()->back()->with('success', 'Privacy page content updated successfully.');
    }

    public function page_terms()
    {
        $page_data = Page::where('id',1)->first();
        return view('admin.page.terms', compact('page_data'));
    }

    public function page_terms_update(Request $request)
    {
        $request->validate([
            'terms_content' => 'required',
        ]);

        $page = Page::where('id',1)->first();
        $page->terms_content = $request->terms_content;
        $page->save();

        return redirect()->back()->with('success', 'Terms page content updated successfully.');
    }

    public function page_contact()
    {
        $page_data = Page::where('id',1)->first();
        return view('admin.page.contact', compact('page_data'));
    }

    public function page_contact_update(Request $request)
    {
        $page = Page::where('id',1)->first();
        $page->contact_address = $request->contact_address;
        $page->contact_phone = $request->contact_phone;
        $page->contact_email = $request->contact_email;
        $page->contact_working_hours = $request->contact_working_hours;
        $page->contact_map = $request->contact_map;
        $page->save();

        return redirect()->back()->with('success', 'Contact page content updated successfully.');
    }

}
