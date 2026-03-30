<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\DeliveryOption;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Admin;
use App\Models\Rating;
use App\Models\Slider;
use App\Models\Faq;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Page;
use App\Models\User;
use App\Models\Subscriber;
use App\Mail\Websitemail;
use Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class FrontController extends Controller
{
    public function index()
    {
        $product_categories_home = ProductCategory::where('show_on_home', 1)
            ->orderBy('name', 'asc')
            ->get();
        $products_home = Product::where('show_on_home', 1)->get();
        $sliders = Slider::orderBy('id', 'asc')->get();
        return view('front.home', compact('product_categories_home', 'products_home', 'sliders'));
    }

    public function about()
    {
        return view('front.about');
    }

    public function contact()
    {
        $page_data = Page::where('id',1)->first();
        return view('front.contact', compact('page_data'));
    }

    public function contact_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Sending email to admin
        $admin_data = Admin::where('id',1)->first();
        $admin_email = $admin_data->email;

        $subject = 'New Contact Message: ' . $request->subject;
        $message = 'Hello Admin, <br><br>';
        $message .= 'You have received a new message from the contact form.<br><br>';
        $message .= '<strong>Name:</strong> ' . $request->name . '<br>';
        $message .= '<strong>Email:</strong> ' . $request->email . '<br>';
        if($request->phone) {
            $message .= '<strong>Phone:</strong> ' . $request->phone . '<br>';
        }
        $message .= '<strong>Subject:</strong> ' . $request->subject . '<br>';
        $message .= '<strong>Message:</strong><br>' . nl2br(e($request->message)) . '<br><br>';

        \Mail::to($admin_email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }

    public function faq()
    {
        $faqs = Faq::orderBy('id', 'asc')->get();
        return view('front.faq', compact('faqs'));
    }

    public function blog()
    {
        $posts = Post::orderBy('id','desc')->paginate(15);
        return view('front.blog', compact('posts'));
    }

    public function post($slug)
    {
        $post = Post::where('slug', $slug)->first();
        $comments = Comment::where('post_id', $post->id)
            ->where('status', 'Approved')
            ->orderBy('id', 'asc')
            ->get();
        return view('front.post', compact('post', 'comments'));
    }

    public function comment_submit(Request $request,$post_id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
        ]);

        $comment = new Comment();
        $comment->post_id = $post_id;
        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;
        $comment->status = 'Pending';
        $comment->save();

        return redirect()->back()->with('success', 'Your comment has been submitted successfully!');
    }

    public function reply_submit(Request $request,$comment_id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'reply' => 'required',
        ]);

        $reply = new Reply();
        $reply->comment_id = $comment_id;
        $reply->name = $request->name;
        $reply->email = $request->email;
        $reply->reply = $request->reply;
        $reply->user_type = 'Visitor';
        $reply->status = 'Pending';
        $reply->save();

        return redirect()->back()->with('success', 'Your reply has been submitted successfully!');
    }

    public function terms()
    {
        $page_data = Page::where('id',1)->first();
        return view('front.terms', compact('page_data'));
    }

    public function privacy()
    {
        $page_data = Page::where('id',1)->first();
        return view('front.privacy', compact('page_data'));
    }

    public function products(Request $request)
    {
        //dd($request->all());

        $product_categories = ProductCategory::orderBy('name', 'asc')->get();

        $products = Product::query();

        if($request->category != null && $request->category != "")
        {
            $products = $products->where('product_category_id', $request->category);
        }

        if($request->min_price !== null && $request->max_price !== null)
        {
            $minPrice = $request->min_price;
            $maxPrice = $request->max_price;

            $products = $products->whereHas('product_variations', function($query) use ($minPrice, $maxPrice) {
                $query->whereRaw('sale_price = (SELECT MIN(sale_price) FROM product_variations WHERE product_variations.product_id = products.id)')
                      ->whereBetween('sale_price', [$minPrice, $maxPrice]);
            });
        }

        if($request->rating != null && $request->rating != "")
        {
            $rating = $request->rating;
            $products = $products->where('average_rating', '>=', $rating);
        }

        if($request->sort != null && $request->sort != "")
        {
            if($request->sort == 'price_asc')
            {
                $products = $products->orderByRaw('(SELECT MIN(sale_price) FROM product_variations WHERE product_variations.product_id = products.id) ASC');
            }
            elseif($request->sort == 'price_desc')
            {
                $products = $products->orderByRaw('(SELECT MIN(sale_price) FROM product_variations WHERE product_variations.product_id = products.id) DESC');
            }
            elseif($request->sort == 'name_asc')
            {
                $products = $products->orderBy('name', 'asc');
            }
            elseif($request->sort == 'name_desc')
            {
                $products = $products->orderBy('name', 'desc');
            }
            elseif($request->sort == 'rating_desc')
            {
                $products = $products->orderBy('average_rating', 'desc');
            }
            elseif($request->sort == 'rating_asc')
            {
                $products = $products->orderBy('average_rating', 'asc');
            }
        }
        else
        {
            $products = $products->orderBy('id', 'asc');
        }

        $products = $products->paginate(9);

        return view('front.products', compact('products', 'product_categories'));
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->first();
        $related_products = Product::where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->orderBy('id', 'asc')
            ->take(4)
            ->get();

        $ratings = Rating::where('product_id', $product->id)->get();
        
        return view('front.product', compact('product', 'related_products', 'ratings'));
    }


    public function cart()
    {
        $delivery_option = DeliveryOption::where('is_default',1)->first();
        if(!session()->has('delivery_option_id')){
            session()->put('delivery_option_id', $delivery_option->id);
            session()->put('delivery_option_cost', $delivery_option->cost);
        }

        return view('front.cart');
    }

    public function cart_add(Request $request)
    {
        // Stock Checking
        $product_variation = ProductVariation::where('id', $request->product_variation_id)->first();
        if($product_variation->stock == 0) {
            return redirect()->back()->with('error', 'Product is out of stock!');
        }

        // Product Detail Page Stock Check
        if($request->quantity > $product_variation->stock) {
            return redirect()->back()->with('error', 'No more stock available for this product!');
        }

        $cart = session()->get('cart', []);

        if(isset($cart[$request->product_variation_id])) {
            if($product_variation->stock == $cart[$request->product_variation_id]['quantity']) {
                return redirect()->back()->with('error', 'No more stock available for this product!');
            }
            $cart[$request->product_variation_id]['quantity'] += $request->quantity;
        } else {
            
            $cart[$request->product_variation_id] = [
                'product_id' => $request->product_id,
                "product_variation_id" => $request->product_variation_id,
                "quantity" => $request->quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart')->with('success', 'Product added to cart successfully!');
    }

    public function cart_update(Request $request)
    {
        $product_variation = ProductVariation::where('id', $request->product_variation_id)->first();

        $cart = session()->get('cart', []);

        // Last item minus click
        if($request->quantity == 0) {
            unset($cart[$request->product_variation_id]);
        }

        if(isset($cart[$request->product_variation_id])) {
            if($product_variation->stock < $request->quantity) {
                return redirect()->back()->with('error', 'No more stock available for this product!');
            }
            $cart[$request->product_variation_id]['quantity'] = $request->quantity;
        }
        session()->put('cart', $cart);

        if(empty($cart)) {
            session()->forget('cart');
            session()->forget('delivery_option_id');
            session()->forget('delivery_option_cost');
            session()->forget('coupon_id');
            session()->forget('coupon_code');
            session()->forget('coupon_discount');
        }

        return redirect()->back()->with('success', 'Cart is updated successfully!');
    }

    public function cart_remove($product_variation_id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product_variation_id])) {
            unset($cart[$product_variation_id]);
            session()->put('cart', $cart);
        }
        if(empty($cart)) {
            session()->forget('cart');
            session()->forget('delivery_option_id');
            session()->forget('delivery_option_cost');
            session()->forget('coupon_id');
            session()->forget('coupon_code');
            session()->forget('coupon_discount');
        }

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    public function cart_clear()
    {
        session()->forget('cart');

        session()->forget('delivery_option_id');
        session()->forget('delivery_option_cost');
        session()->forget('coupon_id');
        session()->forget('coupon_code');
        session()->forget('coupon_discount');

        return redirect()->back()->with('success', 'Cart cleared successfully!');
    }

    public function apply_coupon(Request $request)
    {
        $request->validate([
            'code' => 'required',
        ]);

        $coupon = Coupon::where('code', $request->code)->first();

        if(!$coupon) {
            return redirect()->back()->with('error', 'Invalid coupon code!');
        }

        if($coupon->status == 'Inactive') {
            return redirect()->back()->with('error', 'This coupon is inactive!');
        }

        if($coupon->usage_limit == $coupon->times_used) {
            return redirect()->back()->with('error', 'Coupon usage limit reached!');
        }

        if(date('Y-m-d') < $coupon->start_date) {
            return redirect()->back()->with('error', 'This coupon is not active yet!');
        }

        if(date('Y-m-d') > $coupon->end_date) {
            return redirect()->back()->with('error', 'This coupon has expired!');
        }

        session()->put('coupon_id', $coupon->id);
        session()->put('coupon_code', $coupon->code);
        session()->put('coupon_discount', $coupon->discount);

        return redirect()->back()->with('success', 'Coupon applied successfully!');
    }

    public function remove_coupon($coupon_id)
    {
        session()->forget('coupon_id');
        session()->forget('coupon_code');
        session()->forget('coupon_discount');

        return redirect()->back()->with('success', 'Coupon removed successfully!');
    }

    public function checkout()
    {
        if(!Auth::guard('web')->check()) {
            return redirect()->route('user_login')->with('error', 'Please login to proceed to checkout!');
        }
        if(!session()->has('cart')) {
            return redirect()->route('cart')->with('error', 'Your cart is empty!');
        }

        $delivery_options = DeliveryOption::orderBy('id', 'asc')->get();
        
        return view('front.checkout', compact('delivery_options'));
    }

    public function change_delivery_option(Request $request)
    {
        $delivery_option = DeliveryOption::where('id', $request->delivery_option_id)->first();
        if(!$delivery_option) {
            return redirect()->back()->with('error', 'Invalid delivery option selected!');
        }

        session()->put('delivery_option_id', $delivery_option->id);
        session()->put('delivery_option_cost', $delivery_option->cost);

        return redirect()->back()->with('success', 'Delivery option updated successfully!');
    }

    public function payment(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'billing_name' => 'required',
            'billing_email' => 'required|email',
            'billing_phone' => 'required',
            'billing_address' => 'required',
            'billing_country' => 'required',
            'billing_state' => 'required',
            'billing_city' => 'required',
            'billing_zip' => 'required',
        ]);

        if($request->payment_method == 'paypal') 
        {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('paypal_success'),
                    "cancel_url" => route('paypal_cancel')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $request->total_price
                        ]
                    ]
                ]
            ]);
            //dd($response);
            if(isset($response['id']) && $response['id'] != null) {
                foreach($response['links'] as $link) {
                    if($link['rel'] == 'approve') {

                        session()->put('subtotal_price', $request->subtotal_price);
                        session()->put('total_price', $request->total_price);

                        session()->put('billing_name', $request->billing_name);
                        session()->put('billing_email', $request->billing_email);
                        session()->put('billing_phone', $request->billing_phone);
                        session()->put('billing_address', $request->billing_address);
                        session()->put('billing_country', $request->billing_country);
                        session()->put('billing_state', $request->billing_state);
                        session()->put('billing_city', $request->billing_city);
                        session()->put('billing_zip', $request->billing_zip);
                        session()->put('note', $request->note);

                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('paypal_cancel');
            }
        }
        elseif($request->payment_method == 'stripe') 
        {
            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->create([
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'usd',
                            'product_data' => [
                                'name' => $request->product_name,
                            ],
                            'unit_amount' => $request->total_price*100,
                        ],
                        'quantity' => $request->quantity,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('stripe_success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe_cancel'),
            ]);
            //dd($response);
            if(isset($response->id) && $response->id != ''){
                session()->put('subtotal_price', $request->subtotal_price);
                session()->put('total_price', $request->total_price);

                session()->put('billing_name', $request->billing_name);
                session()->put('billing_email', $request->billing_email);
                session()->put('billing_phone', $request->billing_phone);
                session()->put('billing_address', $request->billing_address);
                session()->put('billing_country', $request->billing_country);
                session()->put('billing_state', $request->billing_state);
                session()->put('billing_city', $request->billing_city);
                session()->put('billing_zip', $request->billing_zip);
                session()->put('note', $request->note);
                return redirect($response->url);
            } else {
                return redirect()->route('stripe_cancel');
            }
        }
        elseif($request->payment_method == 'cod') 
        {
            $order_no = 'ORD-'.time().rand(1000,9999);

            // Insert data into database
            $order = new Order;
            $order->user_id = Auth::guard('web')->user()->id;
            $order->order_no = $order_no;
            $order->payment_method = "Cash On Delivery";
            $order->currency = 'USD';
            $order->subtotal_price = $request->subtotal_price;
            $order->delivery_option_cost = session()->get('delivery_option_cost');
            $order->coupon_code = session()->get('coupon_code');
            $order->coupon_discount_percentage = session()->get('coupon_discount');
            $order->coupon_discount_value = (session()->get('coupon_discount')/100) * $request->subtotal_price;
            $order->total_price = $request->total_price;
            $order->billing_name = $request->billing_name;
            $order->billing_email = $request->billing_email;
            $order->billing_phone = $request->billing_phone;
            $order->billing_address = $request->billing_address;
            $order->billing_country = $request->billing_country;
            $order->billing_state = $request->billing_state;
            $order->billing_city = $request->billing_city;
            $order->billing_zip = $request->billing_zip;
            $order->note = $request->note;
            $order->payment_status = "Pending";
            $order->delivery_status = "Pending";
            $order->save();

            $cart = session()->get('cart', []);
            foreach($cart as $item) {

                $variation = ProductVariation::find($item['product_variation_id']);
                $total = $variation->sale_price * $item['quantity'];

                $order_detail = new OrderDetail;
                $order_detail->user_id = Auth::guard('web')->user()->id;
                $order_detail->order_id = $order->id;
                $order_detail->order_no = $order_no;
                $order_detail->product_id = $item['product_id'];
                $order_detail->product_variation_id = $item['product_variation_id'];
                $order_detail->label = $variation->label;
                $order_detail->sale_price = $variation->sale_price;
                $order_detail->quantity = $item['quantity'];
                $order_detail->total_price = $total;
                $order_detail->save();

                // Reduce stock
                $variation->stock = $variation->stock - $item['quantity'];
                $variation->save();
            }

            // If coupon is used, increase times_used by 1
            if(session()->has('coupon_id')) {
                $coupon = Coupon::find(session()->get('coupon_id'));
                $coupon->times_used = $coupon->times_used + 1;
                $coupon->save();
            }

            // Sending email to user
            $subject = 'Your Order is Placed Successfully!';
            $message = 'Hello ' . $request->billing_name . ', <br><br>';
            $message .= 'Your order has been placed successfully. Your order number is ' . $order_no . '.<br><br>';
            $message .= 'You can see your orders from this page: <a href="'.route('user_orders').'">'.route('user_orders').'</a><br><br>';
            $message .= 'Thank you for shopping with us!';

            \Mail::to($request->billing_email)->send(new Websitemail($subject, $message));

            // Sending email to admin
            $admin_data = Admin::where('id',1)->first();
            $admin_email = $admin_data->email;
            $subject = 'New Order Received - ' . $order_no;
            $message = 'Hello Admin, <br><br>';
            $message .= 'A new order has been placed. The order number is ' . $order_no . '.<br><br>';
            $message .= 'Check this page in the admin panel for more details: <a href="'.route('admin_order_index').'">'.route('admin_order_index').'</a><br><br>';
            $message .= 'Thank you!';

            \Mail::to($admin_email)->send(new Websitemail($subject, $message));

            session()->forget('cart');
            session()->forget('delivery_option_id');
            session()->forget('delivery_option_cost');
            session()->forget('coupon_id');
            session()->forget('coupon_code');
            session()->forget('coupon_discount');

            return redirect()->route('user_orders')->with('success', 'Order is placed successfully!');
        }
    }

    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        //dd($response);
        if(isset($response['status']) && $response['status'] == 'COMPLETED') {
            
            $order_no = 'ORD-'.time().rand(1000,9999);

            // Insert data into database
            $order = new Order;
            $order->user_id = Auth::guard('web')->user()->id;
            $order->order_no = $order_no;
            $order->payment_method = "PayPal";
            $order->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $order->subtotal_price = session()->get('subtotal_price');
            $order->delivery_option_cost = session()->get('delivery_option_cost');
            $order->coupon_code = session()->get('coupon_code');
            $order->coupon_discount_percentage = session()->get('coupon_discount');
            $order->coupon_discount_value = (session()->get('coupon_discount')/100) * session()->get('subtotal_price');
            $order->total_price = session()->get('total_price');
            $order->billing_name = session()->get('billing_name');
            $order->billing_email = session()->get('billing_email');
            $order->billing_phone = session()->get('billing_phone');
            $order->billing_address = session()->get('billing_address');
            $order->billing_country = session()->get('billing_country');
            $order->billing_state = session()->get('billing_state');
            $order->billing_city = session()->get('billing_city');
            $order->billing_zip = session()->get('billing_zip');
            $order->note = session()->get('note');
            $order->payment_status = "Paid";
            $order->delivery_status = "Pending";
            $order->save();

            $cart = session()->get('cart', []);
            foreach($cart as $item) {

                $variation = ProductVariation::find($item['product_variation_id']);
                $total = $variation->sale_price * $item['quantity'];

                $order_detail = new OrderDetail;
                $order_detail->user_id = Auth::guard('web')->user()->id;
                $order_detail->order_id = $order->id;
                $order_detail->order_no = $order_no;
                $order_detail->product_id = $item['product_id'];
                $order_detail->product_variation_id = $item['product_variation_id'];
                $order_detail->label = $variation->label;
                $order_detail->sale_price = $variation->sale_price;
                $order_detail->quantity = $item['quantity'];
                $order_detail->total_price = $total;
                $order_detail->save();

                // Reduce stock
                $variation->stock = $variation->stock - $item['quantity'];
                $variation->save();
            }

            // If coupon is used, increase times_used by 1
            if(session()->has('coupon_id')) {
                $coupon = Coupon::find(session()->get('coupon_id'));
                $coupon->times_used = $coupon->times_used + 1;
                $coupon->save();
            }

            // Sending email to user
            $subject = 'Your Order is Placed Successfully!';
            $message = 'Hello ' . session()->get('billing_name') . ', <br><br>';
            $message .= 'Your order has been placed successfully. Your order number is ' . $order_no . '.<br><br>';
            $message .= 'You can see your orders from this page: <a href="'.route('user_orders').'">'.route('user_orders').'</a><br><br>';
            $message .= 'Thank you for shopping with us!';

            \Mail::to(session()->get('billing_email'))->send(new Websitemail($subject, $message));

            // Sending email to admin
            $admin_data = Admin::where('id',1)->first();
            $admin_email = $admin_data->email;
            $subject = 'New Order Received - ' . $order_no;
            $message = 'Hello Admin, <br><br>';
            $message .= 'A new order has been placed. The order number is ' . $order_no . '.<br><br>';
            $message .= 'Check this page in the admin panel for more details: <a href="'.route('admin_order_index').'">'.route('admin_order_index').'</a><br><br>';
            $message .= 'Thank you!';

            \Mail::to($admin_email)->send(new Websitemail($subject, $message));

            session()->forget('cart');
            session()->forget('delivery_option_id');
            session()->forget('delivery_option_cost');
            session()->forget('coupon_id');
            session()->forget('coupon_code');
            session()->forget('coupon_discount');
            session()->forget('subtotal_price');
            session()->forget('total_price');
            session()->forget('billing_name');
            session()->forget('billing_email');
            session()->forget('billing_phone');
            session()->forget('billing_address');
            session()->forget('billing_country');
            session()->forget('billing_state');
            session()->forget('billing_city');
            session()->forget('billing_zip');
            session()->forget('note');

            return redirect()->route('user_orders')->with('success', 'Order is placed successfully!');

        } else {
            return redirect()->route('paypal_cancel');
        }
    }

    public function paypal_cancel()
    {
        return redirect()->route('cart')->with('error', 'Payment is cancelled!');
    }

    public function stripe_success(Request $request)
    {
        if(isset($request->session_id)) {

            $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);

            $order_no = 'ORD-'.time().rand(1000,9999);

            // Insert data into database
            $order = new Order;
            $order->user_id = Auth::guard('web')->user()->id;
            $order->order_no = $order_no;
            $order->payment_method = "Stripe";
            $order->currency = 'USD';
            $order->subtotal_price = session()->get('subtotal_price');
            $order->delivery_option_cost = session()->get('delivery_option_cost');
            $order->coupon_code = session()->get('coupon_code');
            $order->coupon_discount_percentage = session()->get('coupon_discount');
            $order->coupon_discount_value = (session()->get('coupon_discount')/100) * session()->get('subtotal_price');
            $order->total_price = session()->get('total_price');
            $order->billing_name = session()->get('billing_name');
            $order->billing_email = session()->get('billing_email');
            $order->billing_phone = session()->get('billing_phone');
            $order->billing_address = session()->get('billing_address');
            $order->billing_country = session()->get('billing_country');
            $order->billing_state = session()->get('billing_state');
            $order->billing_city = session()->get('billing_city');
            $order->billing_zip = session()->get('billing_zip');
            $order->note = session()->get('note');
            $order->payment_status = "Paid";
            $order->delivery_status = "Pending";
            $order->save();

            $cart = session()->get('cart', []);
            foreach($cart as $item) {

                $variation = ProductVariation::find($item['product_variation_id']);
                $total = $variation->sale_price * $item['quantity'];

                $order_detail = new OrderDetail;
                $order_detail->user_id = Auth::guard('web')->user()->id;
                $order_detail->order_id = $order->id;
                $order_detail->order_no = $order_no;
                $order_detail->product_id = $item['product_id'];
                $order_detail->product_variation_id = $item['product_variation_id'];
                $order_detail->label = $variation->label;
                $order_detail->sale_price = $variation->sale_price;
                $order_detail->quantity = $item['quantity'];
                $order_detail->total_price = $total;
                $order_detail->save();

                // Reduce stock
                $variation->stock = $variation->stock - $item['quantity'];
                $variation->save();
            }

            // If coupon is used, increase times_used by 1
            if(session()->has('coupon_id')) {
                $coupon = Coupon::find(session()->get('coupon_id'));
                $coupon->times_used = $coupon->times_used + 1;
                $coupon->save();
            }

            // Sending email to user
            $subject = 'Your Order is Placed Successfully!';
            $message = 'Hello ' . session()->get('billing_name') . ', <br><br>';
            $message .= 'Your order has been placed successfully. Your order number is ' . $order_no . '.<br><br>';
            $message .= 'You can see your orders from this page: <a href="'.route('user_orders').'">'.route('user_orders').'</a><br><br>';
            $message .= 'Thank you for shopping with us!';

            \Mail::to(session()->get('billing_email'))->send(new Websitemail($subject, $message));

            // Sending email to admin
            $admin_data = Admin::where('id',1)->first();
            $admin_email = $admin_data->email;
            $subject = 'New Order Received - ' . $order_no;
            $message = 'Hello Admin, <br><br>';
            $message .= 'A new order has been placed. The order number is ' . $order_no . '.<br><br>';
            $message .= 'Check this page in the admin panel for more details: <a href="'.route('admin_order_index').'">'.route('admin_order_index').'</a><br><br>';
            $message .= 'Thank you!';

            \Mail::to($admin_email)->send(new Websitemail($subject, $message));

            session()->forget('cart');
            session()->forget('delivery_option_id');
            session()->forget('delivery_option_cost');
            session()->forget('coupon_id');
            session()->forget('coupon_code');
            session()->forget('coupon_discount');
            session()->forget('subtotal_price');
            session()->forget('total_price');
            session()->forget('billing_name');
            session()->forget('billing_email');
            session()->forget('billing_phone');
            session()->forget('billing_address');
            session()->forget('billing_country');
            session()->forget('billing_state');
            session()->forget('billing_city');
            session()->forget('billing_zip');
            session()->forget('note');

            return redirect()->route('user_orders')->with('success', 'Order is placed successfully!');

        } else {
            return redirect()->route('cancel');
        }
    }

    public function stripe_cancel()
    {
        return redirect()->route('cart')->with('error', 'Payment is cancelled!');
    }

    public function subscriber_send_email(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        $token = hash('sha256', time());

        $obj = new Subscriber();
        $obj->email = $request->email;
        $obj->token = $token;
        $obj->status = 0;
        $obj->save();

        $verification_link = url('subscriber/verify/'.$request->email.'/'.$token);

        // Send email
        $subject = 'Subscriber Verification';
        $message = 'Please click on the link below to confirm subscription:<br>';
        $message .= '<a href="'.$verification_link.'">';
        $message .= $verification_link;
        $message .= '</a>';

        \Mail::to($request->email)->send(new Websitemail($subject,$message));

        return redirect()->back()->with('success', 'A verification link has been sent to your email address. Please check your inbox.');
    }

    public function subscriber_verify($email,$token)
    {
        $subscriber_data = Subscriber::where('email',$email)->where('token',$token)->first();
        if(!$subscriber_data) {
            return redirect()->route('home');
        }
        $subscriber_data->token = '';
        $subscriber_data->status = 1;
        $subscriber_data->update();
        return redirect()->route('home')->with('success', 'Your subscription is verified successfully!');
    }
}
