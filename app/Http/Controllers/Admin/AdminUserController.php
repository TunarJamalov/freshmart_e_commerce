<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\Websitemail;
use Hash;
use Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'unique:users,phone',
        ]);

        $user = new User();

        if($request->photo)
        {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $final_name = 'user_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            $user->photo = $final_name;
        }

        // Generate a random password
        $randomPassword = bin2hex(random_bytes(4)); // Generates an 8-character random password
        $password = bcrypt($randomPassword);

        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->status = $request->status;
        $user->password = $password;
        $user->save();

        // Send email to user with their credentials
        $subject = 'Your account is created';
        $message = 'See your login details below:<br>';
        $message .= 'URL: <a href="'.route('user_login').'">'.route('user_login').'</a><br>';
        $message .= 'Email: ' . $request->email . '<br>';
        $message .= 'Password: ' . $randomPassword . '<br>';

        \Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->route('admin_user_index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'unique:users,phone,'.$id,
        ]);

        $user = User::where('id', $id)->first();

        if($request->photo)
        {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $final_name = 'user_'.time().'.'.$request->photo->extension();
            if($user->photo != '') {
                unlink(public_path('uploads/'.$user->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $user->photo = $final_name;
        }
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('admin_user_index')->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();
        if(!$user) {
            return redirect()->route('admin_user_index')->with('error', 'User not found.');
        }
        if($user->photo != '') {
            unlink(public_path('uploads/'.$user->photo));
        }
        $user->delete();

        return redirect()->route('admin_user_index')->with('success', 'User deleted successfully.');
    }
}
