<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct(){
        
    }

    public function index(){
        // Eager loading | 
        $posts = Post::with('user', 'likes')->paginate(5);
        
        // No eager loading
        // $posts = Post::paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'body' => 'required'
        ]);
        $request->user()->posts()->create([
            'body' => $request->body
        ]);
        return back();
    }

    public function destroy(Post $post){
        $post->delete();
        return back();
    }
}
