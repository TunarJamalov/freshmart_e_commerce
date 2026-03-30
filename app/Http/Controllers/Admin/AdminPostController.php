<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Reply;
use Auth;

class AdminPostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id','desc')->get();
        return view('admin.post.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:posts,slug',
            'short_description' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = new Post();

        $final_name = 'post_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);
        $post->photo = $final_name;
        
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->save();

        return redirect()->route('admin_post_index')->with('success', 'Post created successfully.');
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->first();
        return view('admin.post.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'slug' => 'required|regex:/^[a-z0-9-]+$/|unique:posts,slug,'.$id,
            'short_description' => 'required',
            'description' => 'required',
        ]);

        $post = Post::where('id', $id)->first();

        if($request->photo)
        {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $final_name = 'post_'.time().'.'.$request->photo->extension();
            if($post->photo != '') {
                unlink(public_path('uploads/'.$post->photo));
            }
            $request->photo->move(public_path('uploads'), $final_name);
            $post->photo = $final_name;
        }
        
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->short_description = $request->short_description;
        $post->description = $request->description;
        $post->save();
        return redirect()->route('admin_post_index')->with('success', 'Post updated successfully.');
    }

    public function delete($id)
    {
        $post = Post::where('id', $id)->first();
        if(!$post) {
            return redirect()->route('admin_post_index')->with('error', 'Post not found.');
        }
        if($post->photo != '') {
            unlink(public_path('uploads/'.$post->photo));
        }
        $post->delete();

        return redirect()->route('admin_post_index')->with('success', 'Post deleted successfully.');
    }

    public function comment()
    {
        $comments = Comment::orderBy('id','desc')->get();
        return view('admin.post.comment', compact('comments'));
    }

    public function comment_status_change($id)
    {
        $comment = Comment::where('id', $id)->first();
        if(!$comment) {
            return redirect()->route('admin_comment')->with('error', 'Comment not found.');
        }
        if($comment->status == 'Pending') {
            $comment->status = 'Approved';
        } else {
            $comment->status = 'Pending';
        }
        $comment->save();

        return redirect()->back()->with('success', 'Comment status changed successfully.');
    }

    public function comment_delete($id)
    {
        $comment = Comment::where('id', $id)->first();
        if(!$comment) {
            return redirect()->route('admin_comment')->with('error', 'Comment not found.');
        }
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function reply($comment_id)
    {
        $replies = Reply::where('comment_id', $comment_id)->orderBy('id','desc')->get();
        $comment_data = Comment::where('id', $comment_id)->first();
        return view('admin.post.reply', compact('replies', 'comment_data'));
    }

    public function reply_status_change($id)
    {
        $reply = Reply::where('id', $id)->first();
        if(!$reply) {
            return redirect()->route('admin_reply')->with('error', 'Reply not found.');
        }
        if($reply->status == 'Pending') {
            $reply->status = 'Approved';
        } else {
            $reply->status = 'Pending';
        }
        $reply->save();

        return redirect()->back()->with('success', 'Reply status changed successfully.');
    }

    public function reply_delete($id)
    {
        $reply = Reply::where('id', $id)->first();
        if(!$reply) {
            return redirect()->route('admin_reply')->with('error', 'Reply not found.');
        }
        $reply->delete();

        return redirect()->back()->with('success', 'Reply deleted successfully.');
    }

    public function admin_reply_submit(Request $request, $comment_id)
    {
        $request->validate([
            'reply' => 'required',
        ]);

        $reply = new Reply();
        $reply->comment_id = $comment_id;
        $reply->reply = $request->reply;
        $reply->user_type = 'Admin';
        $reply->status = 'Approved';
        $reply->save();

        return redirect()->back()->with('success', 'Reply submitted successfully.');
    }
    
}
