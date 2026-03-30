<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Wishlist;
use App\Models\Rating;
use App\Models\Product;
use App\Mail\Websitemail;

class UserController extends Controller
{
    public function dashboard()
    {
        $orders = Order::where('user_id', Auth::guard('web')->user()->id)->orderBy('id','desc')->limit(3)->get();
        $total_pending_orders = Order::where('user_id', Auth::guard('web')->user()->id)->where('delivery_status', 'Pending')->count();
        $total_shipped_orders = Order::where('user_id', Auth::guard('web')->user()->id)->where('delivery_status', 'Shipped')->count();
        $total_orders = Order::where('user_id', Auth::guard('web')->user()->id)->count();
        $total_wishlist_items = Wishlist::where('user_id', Auth::guard('web')->user()->id)->count();
        return view('user.dashboard', compact('orders', 'total_pending_orders', 'total_shipped_orders', 'total_orders', 'total_wishlist_items'));
    }

    public function registration()
    {
        if(Auth::guard('web')->check()){
            return redirect()->route('user_dashboard');
        }
        return view('user.auth.registration');
    }

    public function registration_submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $token = hash('sha256', time());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token = $token;
        $user->save();

        $link = route('user_registration_verify', ['token' => $token, 'email' => $request->email]);
        $subject = 'Registration Verification';
        $message = 'Click on the following link to verify your email: <br><a href="' . $link . '">' . $link . '</a>';

        \Mail::to($request->email)->send(new Websitemail($subject, $message));
        
        return redirect()->back()->with('success', 'Registration successful. Please check your email to verify your account.');
    }

    public function registration_verify($token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->route('user_login')->with('error', 'Invalid token or email');
        }
        $user->token = '';
        $user->status = 1;
        $user->update();

        return redirect()->route('user_login')->with('success', 'Email verified successfully. You can now login.');
    }

    public function login()
    {
        if(Auth::guard('web')->check()){
            return redirect()->route('user_dashboard');
        }
        return view('user.auth.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
            'status' => 1,
        ];

        if(Auth::guard('web')->attempt($data)){
            return redirect()->route('user_dashboard')->with('success', 'Logged in successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('user_login')->with('success', 'Logged out successfully');
    }

    public function forget_password()
    {
        if(Auth::guard('web')->check()){
            return redirect()->route('user_dashboard');
        }
        return view('user.auth.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user){
            return redirect()->back()->with('error', 'Email not found');
        }

        $token = hash('sha256', time());
        $user->token = $token;
        $user->update();

        $link = route('user_reset_password', ['token' => $token, 'email' => $request->email]);
        $subject = 'Reset Password';
        $message = 'Click on the following link to reset your password: <br>';
        $message .= '<a href="'.$link.'">'.$link.'</a>';

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'Reset password link sent to your email');

    }

    public function reset_password($token, $email)
    {
        $user = User::where('email', $email)->where('token', $token)->first();
        if(!$user){
            return redirect()->route('user_login')->with('error', 'Invalid token or email');
        }
        return view('user.auth.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, $token, $email)
    {
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::where('email', $email)->where('token', $token)->first();
        $user->password = Hash::make($request->password);
        $user->token = '';
        $user->update();

        return redirect()->route('user_login')->with('success', 'Password reset successfully');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function profile_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::guard('web')->user()->id,
        ]);

        $user = User::where('id',Auth::guard('web')->user()->id)->first();

        if($request->photo){
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $final_name = 'user_'.time().'.'.$request->photo->extension();
            if($user->photo != '') {
                unlink(public_path('uploads/'.$user->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $user->photo = $final_name;
        }

        if($request->password){
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            $user->password = Hash::make($request->password);
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->zip = $request->zip;
        $user->update();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function orders()
    {
        $orders = Order::orderBy('id','desc')->where('user_id', Auth::guard('web')->user()->id)->paginate(20);
        return view('user.orders', compact('orders'));
    }

    public function invoice($order_no)
    {
        $order = Order::where('order_no', $order_no)->where('user_id', Auth::guard('web')->user()->id)->first();
        if(!$order) {
            return redirect()->route('user_orders')->with('error', 'Order not found.');
        }
        $order_details = OrderDetail::where('order_id', $order->id)->get();
        $admin_data = Admin::where('id', 1)->first();
        return view('user.invoice', compact('order', 'order_details', 'admin_data'));
    }

    public function wishlist()
    {
        $wishlist_items = Wishlist::where('user_id', Auth::guard('web')->user()->id)->get();
        return view('user.wishlist', compact('wishlist_items'));
    }

    public function wishlist_add($product_id)
    {
        $user = Auth::guard('web')->user();
        if(!$user) {
            return redirect()->route('user_login')->with('error', 'Please login to add to wishlist.');
        }

        // Duplicate checking
        $existing = Wishlist::where('user_id', $user->id)->where('product_id', $product_id)->first();
        if($existing) {
            return redirect()->back()->with('error', 'Product already in wishlist.');
        }

        $wishlist = new Wishlist();
        $wishlist->user_id = Auth::guard('web')->user()->id;
        $wishlist->product_id = $product_id;
        $wishlist->save();

        return redirect()->back()->with('success', 'Product added to wishlist.');
    }

    public function wishlist_remove($id)
    {
        $wishlist_item = Wishlist::where('id', $id)->where('user_id', Auth::guard('web')->user()->id)->first();
        if(!$wishlist_item) {
            return redirect()->back()->with('error', 'Wishlist item not found.');
        }
        $wishlist_item->delete();

        return redirect()->back()->with('success', 'Product removed from wishlist.');
    }

    public function rating_submit(Request $request, $product_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required',
        ]);

        $rating = new Rating();
        $rating->product_id = $product_id;
        $rating->user_id = Auth::guard('web')->user()->id;
        $rating->rating = $request->rating;
        $rating->review = $request->review;
        $rating->save();

        $product = Product::where('id', $product_id)->first();
        $product->total_rating_value += $request->rating;
        $product->total_rating_count += 1;
        $product->average_rating = $product->total_rating_value / $product->total_rating_count;
        $product->update();

        return redirect()->back()->with('success', 'Thank you for your review!');
    }
}
