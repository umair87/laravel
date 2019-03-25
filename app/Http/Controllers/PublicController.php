<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function index()
    {
        $featuredPosts = $this->getPosts(true, 1);
        $allPosts = $this->getPosts('', 1);

        foreach ($featuredPosts as $key => $post) {
            preg_match_all('/<img[^>]+>/i', $post->post_content, $result);

            if (isset($result[0][0])) {
                $featuredPosts[$key]->img = str_replace('))', '', $result[0][0]);
            }

            $content = preg_replace("/<img[^>]+\>/i", "", $post->post_content);
            $featuredPosts[$key]->excerpt = substr($content, 0, 100).'...';
        }

        foreach ($allPosts as $key => $post) {
            preg_match_all('/<img[^>]+>/i', $post->post_content, $result);

            if (isset($result[0][0])) {
                $allPosts[$key]->img = str_replace('))', '', $result[0][0]);
            }

            $content = preg_replace("/<img[^>]+\>/i", "", $post->post_content);
            $allPosts[$key]->excerpt = substr($content, 0, 200).'...';
        }

        return view('home')->with(compact('featuredPosts', 'allPosts'));
    }

    public function getPosts($featured = '', $status='')
    {
        $posts = DB::table('posts')
            ->select(array('posts.id', 'posts.post_title', 'posts.post_content', 'posts.created_at', 'posts.featured', 'posts.status', 'users.name', 'topics.topic_name'))
            ->join('users', 'users.id', '=', 'posts.author')
            ->join('topics', 'topics.id', '=', 'posts.topic')

            ->when($featured != '', function ($q, $featured) {
                return $q->where('posts.featured', '=', $featured);
            })

            ->when($status != '', function ($q, $status) {
                return $q->where('posts.status', '=', $status);
            })

        ->orderBy('posts.id', 'DESC');

        return $posts->get();

    }

    public function showSinglePost($name, $id, $status=1)
    {
        $id = base64_decode($id);
        $tags = $this->getPostTags($id);

        $post = DB::table('posts')
            ->select(array('posts.id', 'posts.post_title', 'posts.post_content', 'posts.created_at', 'users.name', 'topics.topic_name'))
            ->join('users', 'users.id', '=', 'posts.author')
            ->join('topics', 'topics.id', '=', 'posts.topic')
            ->where('posts.id', '=', $id)

            ->when($status != '', function ($q, $status) {
                return $q->where('posts.status', '=', $status);
            });

        $post = $post->get();

        return view('singlePost')->with(compact('post', 'tags'));
    }

    public function getPostTags($post_id)
    {
        $tags = DB::table('tags')
            ->select(array('tags.id', 'tags.tag_name'))
            ->join('posts_tags', 'posts_tags.tag_id', '=', 'tags.id')
            ->where('posts_tags.post_id', '=', $post_id)
            ->get();

        return $tags;
    }

    public function getTopicPosts($type, $type_name, $type_id)
    {
        $type_id = base64_decode($type_id);

        if ($type == 'topic') {
            $posts = DB::table('posts')
                ->select(array('posts.id', 'posts.post_title', 'posts.post_content', 'posts.created_at', 'users.name', 'topics.topic_name'))
                ->join('users', 'users.id', '=', 'posts.author')
                ->join('topics', 'topics.id', '=', 'posts.topic')
                ->where('posts.topic', '=', $type_id)
                ->where('posts.status', '=', 1)
                ->orderBy('posts.id', 'DESC')
                ->get();

            $typeName = Topic::where('id', $type_id)->get()->first();
            $typeName = $typeName->topic_name;

        } else if ($type == 'tag') {
            $posts = DB::table('posts')
                ->select(array('posts.id', 'posts.post_title', 'posts.post_content', 'posts.created_at', 'users.name', 'topics.topic_name'))
                ->join('users', 'users.id', '=', 'posts.author')
                ->join('topics', 'topics.id', '=', 'posts.topic')
                ->join('posts_tags', 'posts_tags.post_id', '=', 'posts.id')
                ->where('posts_tags.tag_id', '=', $type_id)
                ->where('posts.status', '=', 1)
                ->orderBy('posts.id', 'DESC')
                ->get();

            $typeName = Tag::where('id', $type_id)->get()->first();
            $typeName = $typeName->tag_name;
        }

        foreach ($posts as $key => $post) {
            preg_match_all('/<img[^>]+>/i', $post->post_content, $result);

            if (isset($result[0][0])) {
                $posts[$key]->img = str_replace('))', '', $result[0][0]);
            }

            $content = preg_replace("/<img[^>]+\>/i", "", $post->post_content);
            $posts[$key]->excerpt = substr($content, 0, 200).'...';
        }


        return view('category')->with(compact('posts', 'typeName'));
    }
}
