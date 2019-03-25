<?php

namespace Tests\Feature;

use App\Post;
use App\Tag;
use App\Topic;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\Concerns\ImpersonatesUsers;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class FeaturesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testEveryoneCanSeeThePosts()
    {
        $response = $this->get(route('home'));

        $response->assertSuccessful();
        $response->assertViewIs('home');
        $response->assertViewHas('featuredPosts');
        $response->assertViewHas('allPosts');
    }

    public function testEveryoneCanSeeTheSinglePost()
    {
        $post = Post::get()->random();
        $response = $this->get(route('singlePost', [
                'name' => str_replace(' ', '-', $post->post_title),
                'id' => base64_encode($post->id)
            ]
        ));

        $response->assertViewIs('singlePost');
        $response->assertViewHas('post');
        $response->assertViewHas('tags');
    }

    public function testEveryoneCanSeeTheTopicPosts()
    {
        $topic = Topic::get()->random();

        $response = $this->get(route('topicPosts', [
                'type' => 'topic',
                'name' => strtolower($topic->topic_name),
                'id' => base64_encode($topic->id)
            ]
        ));

        $response->assertSuccessful();
        $response->assertViewIs('category');
        $response->assertViewHas('posts');
        $response->assertViewHas('typeName');
    }

    public function testEveryoneCanSeeTheTagPosts()
    {
        $tag = Tag::get()->random();

        $response = $this->get(route('topicPosts', [
                'type' => 'tag',
                'name' => strtolower($tag->tag_name),
                'id' => base64_encode($tag->id)
            ]
        ));

        $response->assertSuccessful();
        $response->assertViewIs('category');
        $response->assertViewHas('posts');
        $response->assertViewHas('typeName');
    }

    public function testOnlyAdminCanSeeTheAdminDashboard()
    {
        $user = User::where('admin', '<>', 1)->first();

        $this->actingAs($user)
            ->get('/dashboard')
            ->assertStatus(404);
    }

    public function testEveryoneCanSeeTheRegisterPage()
    {
        $response = $this->get(route('register'));
        $response->assertSuccessful();
    }

    public function testEveryoneCanSeeTheLoginPage()
    {
        $response = $this->get(route('login'));
        $response->assertSuccessful();
    }

    public function testOnlyLoggedInUserCanCreateAnewStory()
    {
        $user = User::find(1);

        $this->actingAs($user)
            ->get('/story/new')
            ->assertStatus(200);

    }

    public function testOnlyAdminCanChangePostVisibility()
    {
        $user = User::where('admin', '<>', 1)->first();

        $this->actingAs($user)
            ->get('/publish')
            ->assertStatus(404);
    }

    public function testOnlyAdminCanChangeFeatureThePost()
    {
        $user = User::where('admin', '<>', 1)->first();

        $this->actingAs($user)
            ->get('/featured')
            ->assertStatus(404);
    }

    public function testOnlyAdminCanChangeDeleteThePost()
    {
        $user = User::where('admin', '<>', 1)->first();

        $this->actingAs($user)
            ->get('/delete')
            ->assertStatus(404);
    }
}
