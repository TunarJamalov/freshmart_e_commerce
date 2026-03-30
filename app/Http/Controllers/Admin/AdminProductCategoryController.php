<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Mail\Websitemail;
use Hash;
use Auth;

class AdminProductCategoryController extends Controller
{
    public function index()
    {
        $product_categories = ProductCategory::orderBy('name','asc')->get();
        return view('admin.product_category.index', compact('product_categories'));
    }

    public function create()
    {
        return view('admin.product_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product_categories,name',
        ]);

        $product_category = new ProductCategory();
        $product_category->name = $request->name;
        $product_category->show_on_home = $request->show_on_home;
        $product_category->save();

        return redirect()->route('admin_product_category_index')->with('success', 'Product category created successfully.');
    }

    public function edit($id)
    {
        $product_category = ProductCategory::where('id', $id)->first();
        return view('admin.product_category.edit', compact('product_category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:product_categories,name,'.$id,
        ]);

        $product_category = ProductCategory::where('id', $id)->first();
        $product_category->name = $request->name;
        $product_category->show_on_home = $request->show_on_home;
        $product_category->save();

        return redirect()->route('admin_product_category_index')->with('success', 'Product category updated successfully.');
    }

    public function delete($id)
    {
        $product_category = ProductCategory::where('id', $id)->first();
        $product_category->delete();

        return redirect()->route('admin_product_category_index')->with('success', 'Product category deleted successfully.');
    }
}
