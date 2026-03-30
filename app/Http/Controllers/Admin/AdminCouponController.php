<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class AdminCouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::get();
        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount' => 'required|numeric|min:0|max:100',
            'usage_limit' => 'required|integer|min:1',
            'status' => 'required',
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount = $request->discount;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->status = $request->status;
        $coupon->save();

        return redirect()->route('admin_coupon_index')->with('success', 'Coupon created successfully.');
    }

    public function edit($id)
    {
        $coupon = Coupon::where('id', $id)->first();
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code,'.$id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount' => 'required|numeric|min:0|max:100',
            'usage_limit' => 'required|integer|min:1',
            'status' => 'required',
        ]);

        $coupon = Coupon::where('id', $id)->first();
        $coupon->code = $request->code;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->discount = $request->discount;
        $coupon->usage_limit = $request->usage_limit;
        $coupon->status = $request->status;
        $coupon->save();

        return redirect()->route('admin_coupon_index')->with('success', 'Coupon updated successfully.');
    }

    public function delete($id)
    {
        $coupon = Coupon::where('id', $id)->first();
        $coupon->delete();

        return redirect()->route('admin_coupon_index')->with('success', 'Coupon deleted successfully.');
    }
}
