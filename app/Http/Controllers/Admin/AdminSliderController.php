<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Auth;

class AdminSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $slider = new Slider();

        $final_name = 'slider_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
        $slider->photo = $final_name;
        
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->button_text = $request->button_text;
        $slider->button_url = $request->button_url;
        $slider->save();

        return redirect()->route('admin_slider_index')->with('success', 'Slider created successfully.');
    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $slider = Slider::where('id', $id)->first();

        if($request->photo)
        {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $final_name = 'slider_'.time().'.'.$request->photo->extension();
            if($slider->photo != '') {
                unlink(public_path('uploads/'.$slider->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $slider->photo = $final_name;
        }
        
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->button_text = $request->button_text;
        $slider->button_url = $request->button_url;
        $slider->save();
        return redirect()->route('admin_slider_index')->with('success', 'Slider updated successfully.');
    }

    public function delete($id)
    {
        $slider = Slider::where('id', $id)->first();
        if(!$slider) {
            return redirect()->route('admin_slider_index')->with('error', 'Slider not found.');
        }
        if($slider->photo != '') {
            unlink(public_path('uploads/'.$slider->photo));
        }
        $slider->delete();

        return redirect()->route('admin_slider_index')->with('success', 'Slider deleted successfully.');
    }
}
