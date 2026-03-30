<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Mail\Websitemail;
use Auth;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function invoice($order_no)
    {
        $order = Order::where('order_no', $order_no)->first();
        if(!$order) {
            return redirect()->route('user_orders')->with('error', 'Order not found.');
        }
        $order_details = OrderDetail::where('order_id', $order->id)->get();
        return view('admin.order.invoice', compact('order', 'order_details'));
    }

    public function change_payment_status($id)
    {
        $order = Order::where('id', $id)->first();
        $order->payment_status = "Paid";
        $order->update();

        return redirect()->back()->with('success', 'Payment status changed to Paid successfully.');
    }

    public function change_delivery_status(Request $request, $id)
    {
        $order = Order::where('id', $id)->first();
        $order->delivery_status = $request->delivery_status;
        $order->update();

        // Sending email to user about delivery status change
        $user = User::where('id', $order->user_id)->first();
        $subject = 'Order Delivery Status Updated';
        $message = 'Dear ' . $user->name . ',<br><br>';
        $message .= 'Your order with order number ' . $order->order_no . ' has been updated to the delivery status <b>' . $request->delivery_status . '</b>.<br><br>';
        $message .= 'Thank you for shopping with us!';
        \Mail::to($user->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'Delivery status changed to Delivered successfully.');
    }

    public function delete($id)
    {
        $order = Order::find($id);
        if(!$order)
        {
            return redirect()->back()->with('error', 'Order not found.');
        }

        OrderDetail::where('order_id', $order->id)->delete();
        $order->delete();

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
}
