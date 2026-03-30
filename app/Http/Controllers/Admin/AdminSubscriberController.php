<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Auth;

class AdminSubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::get();
        return view('admin.subscriber.index', compact('subscribers'));
    }

    public function export()
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=subscribers_'.date('Y-m-d_H-i-s').'.csv');
        
        $output = fopen('php://output', 'w');
        fputcsv($output, ['SL', 'Email']);
        
        $subscribers = Subscriber::where('status', 1)->orderBy('id', 'ASC')->get();
        
        $i = 0;
        foreach ($subscribers as $row) {
            $i++;
            fputcsv($output, [$i, $row->email]);
        }
        
        fclose($output);
        exit;
    }

    public function delete($id)
    {
        $subscriber = Subscriber::find($id);
        if($subscriber)
        {
            $subscriber->delete();
        }
        return redirect()->route('admin_subscriber_index')->with('success', 'Subscriber deleted successfully.');
    }

}
