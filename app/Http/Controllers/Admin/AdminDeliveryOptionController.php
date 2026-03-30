<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeliveryOption;

class AdminDeliveryOptionController extends Controller
{
    public function index()
    {
        $delivery_options = DeliveryOption::get();
        return view('admin.delivery_option.index', compact('delivery_options'));
    }

    public function create()
    {
        return view('admin.delivery_option.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:delivery_options,name',
            'description' => 'required',
            'cost' => 'required|numeric|min:0',
            'is_default' => 'required|in:0,1',
        ]);

        $delivery_option = new DeliveryOption();
        $delivery_option->name = $request->name;
        $delivery_option->description = $request->description;
        $delivery_option->cost = $request->cost;
        $delivery_option->is_default = $request->is_default;
        $delivery_option->save();

        return redirect()->route('admin_delivery_option_index')->with('success', 'Delivery option created successfully.');
    }

    public function edit($id)
    {
        $delivery_option = DeliveryOption::where('id', $id)->first();
        return view('admin.delivery_option.edit', compact('delivery_option'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:delivery_options,name,'.$id,
            'description' => 'required',
            'cost' => 'required|numeric|min:0',
            'is_default' => 'required|in:0,1',
        ]);

        $delivery_option = DeliveryOption::where('id', $id)->first();
        $delivery_option->name = $request->name;
        $delivery_option->description = $request->description;
        $delivery_option->cost = $request->cost;
        $delivery_option->is_default = $request->is_default;
        $delivery_option->save();

        return redirect()->route('admin_delivery_option_index')->with('success', 'Delivery option updated successfully.');
    }

    public function delete($id)
    {
        $delivery_option = DeliveryOption::where('id', $id)->first();
        $delivery_option->delete();

        return redirect()->route('admin_delivery_option_index')->with('success', 'Delivery option deleted successfully.');
    }
}
