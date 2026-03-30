<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function product_category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function product_variations()
    {
        return $this->hasMany(ProductVariation::class)->orderBy('sort_order', 'asc');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function additional_informations()
    {
        return $this->hasMany(AdditionalInformation::class);
    }
}
