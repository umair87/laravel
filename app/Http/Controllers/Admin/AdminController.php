<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\PostTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $admin = Auth::user()->admin;

        if ($admin == false) {
            return redirect('/post-login');
        }

        return $this->getAllPostsInAdminPanel();
    }

    public function getAllPostsInAdminPanel()
    {
        $posts = app('App\Http\Controllers\PublicController')->getPosts();

        return view('admin.dashboard')->with(compact('posts'));
    }

    public function deletePost(Request $request)
    {
        $post_id = $request->input('id');

        Post::where('id', $post_id)->delete();
        PostTag::where('post_id', $post_id)->delete();
        echo 1;
    }

    public function makeFeaturedPost(Request $request)
    {
        $post_id = $request->input('id');

        $post = Post::select('featured')->where('id', $post_id)->get()->first();

        $update_featured = ($post->featured == 1) ? 0 : 1;

        DB::table('posts')
            ->where('id', $post_id)
            ->update(['featured' => $update_featured]);
        echo $update_featured;
    }

    public function publishPost(Request $request)
    {
        $post_id = $request->input('id');

        $post = Post::select('status')->where('id', $post_id)->get()->first();

        $update_status = ($post->status == 1) ? 0 : 1;

        DB::table('posts')
            ->where('id', $post_id)
            ->update(['status' => $update_status]);
        echo $update_status;
    }

    public function showSinglePost($name, $id)
    {
        return app('App\Http\Controllers\PublicController')->showSinglePost($name, $id, '');

    }

}
