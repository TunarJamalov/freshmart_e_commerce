<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductVariation;
use App\Models\AdditionalInformation;
use App\Mail\Websitemail;
use Hash;
use Auth;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $product_categories = ProductCategory::orderBy('name', 'asc')->get();
        return view('admin.product.create', compact('product_categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:products,slug',
            'short_description' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = new Product();

        $final_name = 'product_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
        $product->photo = $final_name;
        
        $product->product_category_id = $request->product_category_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->show_on_home = $request->show_on_home;
        $product->total_rating_value = 0;
        $product->total_rating_count = 0;
        $product->average_rating = 0;
        $product->save();

        return redirect()->route('admin_product_index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product_categories = ProductCategory::orderBy('name', 'asc')->get();
        $product = Product::where('id', $id)->first();
        return view('admin.product.edit', compact('product', 'product_categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:products,slug,'.$id,
            'short_description' => 'required',
            'description' => 'required',
        ]);

        $product = Product::where('id', $id)->first();

        if($request->photo)
        {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $final_name = 'product_'.time().'.'.$request->photo->extension();
            if($product->photo != '') {
                unlink(public_path('uploads/'.$product->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $product->photo = $final_name;
        }
        
        $product->product_category_id = $request->product_category_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->show_on_home = $request->show_on_home;
        $product->save();

        return redirect()->route('admin_product_index')->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->first();
        if(!$product) {
            return redirect()->route('admin_product_index')->with('error', 'Product not found.');
        }
        if($product->photo != '') {
            unlink(public_path('uploads/'.$product->photo));
        }
        $product->delete();

        return redirect()->route('admin_product_index')->with('success', 'Product deleted successfully.');
    }

    public function product_variation($id)
    {
        $product = Product::where('id', $id)->first();
        $product_variations = ProductVariation::orderBy('sort_order', 'asc')->where('product_id', $id)->get();
        return view('admin.product.variation', compact('product', 'product_variations'));
    }

    public function product_variation_store(Request $request, $id)
    {
        $request->validate([
            'label' => 'required',
            'sale_price' => 'required|numeric',
            'regular_price' => 'numeric|nullable',
            'stock' => 'required|integer',
            'sort_order' => 'integer|nullable',
        ]);

        $product_variation = new ProductVariation();
        $product_variation->product_id = $id;
        $product_variation->label = $request->label;
        $product_variation->sale_price = $request->sale_price;
        $product_variation->regular_price = $request->regular_price;
        $product_variation->stock = $request->stock;
        $product_variation->sort_order = $request->sort_order;
        $product_variation->save();

        return redirect()->back()->with('success', 'Product variation added successfully.');
    }

    public function product_variation_update(Request $request, $id)
    {
        $request->validate([
            'label' => 'required',
            'sale_price' => 'required|numeric',
            'regular_price' => 'numeric|nullable',
            'stock' => 'required|integer',
            'sort_order' => 'integer|nullable',
        ]);

        $product_variation = ProductVariation::where('id', $id)->first();
        $product_variation->label = $request->label;
        $product_variation->sale_price = $request->sale_price;
        $product_variation->regular_price = $request->regular_price;
        $product_variation->stock = $request->stock;
        $product_variation->sort_order = $request->sort_order;
        $product_variation->save();

        return redirect()->back()->with('success', 'Product variation updated successfully.');
    }

    public function product_variation_delete($id)
    {
        $product_variation = ProductVariation::where('id', $id)->first();
        $product_variation->delete();

        return redirect()->back()->with('success', 'Product variation deleted successfully.');
    }


    public function product_additional_information($id)
    {
        $product = Product::where('id', $id)->first();
        $additional_informations = AdditionalInformation::orderBy('id', 'asc')->where('product_id', $id)->get();
        return view('admin.product.additional_info', compact('product', 'additional_informations'));
    }

    public function product_additional_information_store(Request $request, $id)
    {
        $request->validate([
            'label' => 'required',
            'value' => 'required',
        ]);

        $additional_information = new AdditionalInformation();
        $additional_information->product_id = $id;
        $additional_information->label = $request->label;
        $additional_information->value = $request->value;
        $additional_information->save();

        return redirect()->back()->with('success', 'Additional information added successfully.');
    }

    public function product_additional_information_update(Request $request, $id)
    {
        $request->validate([
            'label' => 'required',
            'value' => 'required',
        ]);

        $additional_information = AdditionalInformation::where('id', $id)->first();
        $additional_information->label = $request->label;
        $additional_information->value = $request->value;
        $additional_information->save();
        return redirect()->back()->with('success', 'Additional information updated successfully.');
    }

    public function product_additional_information_delete($id)
    {
        $additional_information = AdditionalInformation::where('id', $id)->first();
        $additional_information->delete();

        return redirect()->back()->with('success', 'Additional information deleted successfully.');
    }
}
