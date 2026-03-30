<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\User;
use App\Models\Product;

class AdminRatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::get();
        return view('admin.rating.index', compact('ratings'));
    }

    public function delete($id)
    {
        $rating = Rating::where('id', $id)->first();
        $rating->delete();

        // Update the products table's average rating
        $product_data = Product::where('id', $rating->product_id)->first();
        
        $updated_total_rating_value = $product_data->total_rating_value - $rating->rating;
        $updated_total_rating_count = $product_data->total_rating_count - 1;
        $updated_average_rating = $updated_total_rating_count > 0 ? $updated_total_rating_value / $updated_total_rating_count : 0;

        $product_data->total_rating_value = $updated_total_rating_value;
        $product_data->total_rating_count = $updated_total_rating_count;
        $product_data->average_rating = $updated_average_rating;
        $product_data->save();

        return redirect()->route('admin_rating_index')->with('success', 'Rating deleted successfully.');
    }
}
