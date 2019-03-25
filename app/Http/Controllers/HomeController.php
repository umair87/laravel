<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostTag;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $admin = Auth::user()->admin;

        if ($admin == true) {
            return redirect()->action('Admin\AdminController@index');
        }

        return redirect()->action('PublicController@index');
    }

    public function newStory()
    {
        $tags = Tag::all()->sortBy('tag_name');
        return view('newStory')->with(compact('tags'));
    }

    public function postNewStory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'topic' => 'required',
            'tags' => 'required|array|min:5'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'newstory')->withInput($request->input());
        }

        $title = $request->input('title');
        $topic = $request->input('topic');
        $tags = $request->input('tags');

        $postData = array('post_title' => $title, 'author' => Auth::user()->id, 'topic' => $topic);
        $post_id = Post::create($postData);
        $post_id = $post_id->id;

        foreach ($tags as $tag) {
            $tagData = array('post_id' => $post_id, 'tag_id' => $tag);
            PostTag::create($tagData);
        }

        return redirect('/story/new/'.$post_id);
    }

    public function createNewStoryContent($id)
    {
        $post_title = POST::where('id', $id)->get()->first();
        $post_title = ($post_title) ? $post_title->post_title : 0;

        return view('createNewStoryContent')->with(compact('id', 'post_title'));
    }

    public function postNewStoryContent(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->only('file');
            $file = $file['file'];

            $fileArray = array('file' => $file);

            $rules = array(
                'file' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
            );

            $validator = Validator::make($fileArray, $rules);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->getMessages()], 400);

            } else {
                $file = $request->file('file');
                $filename = rand(1, 99999) . '_' . $file->getClientOriginalName();
                $file->move('img/uploads', $filename);
                return $filename;

            }

        }
    }

    public function saveContent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'savenewstory');
        }

        $post_id = $request->input('post_id');
        $content = $request->input('content');
        $body = '';

        foreach ($content as $value) {
            $body.= '<p>'. $value .'</p>';
            $body.= '<p>&nbsp;</p>';
        }

        $body = str_replace('{', '<img src="', $body);
        $body = str_replace('}', '">', $body);

        DB::table('posts')
            ->where('id', $post_id)
            ->update(['post_content' => $body]);

        return redirect()->back()->with('success', 'Content added successfully!');
    }

}
