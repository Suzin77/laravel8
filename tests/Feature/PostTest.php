<?php

namespace Tests\Feature;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testNoBlogPostsInDB()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No posts yet');
    }

    public function testSeeOneBlogPostWhenThereIsOne()
    {
        $post = $this->createDummyBlogPost();

        $response = $this->get('/posts');

        $response->assertSeeText($post->title);

        $response->assertSeeText('No comments yet');

        $this->assertDatabaseHas('blog_posts', [
            'title' => $post->title
        ]);
    }

    public function testSeeOneBlogPostWithComments()
    {
        $post = $this->createDummyBlogPost();

        Comment::factory()->count(4)->create([
            'blog_post_id' => $post->id
        ]);

        $response = $this->get('/posts');

        $response->assertSeeText('Comments: 4');
    }

    public function testStoreValid()
    {
        $params = [
            'title' => 'new title',
            'content' => 'new content',
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals('created post', session('status'));

    }

    public function testStoreFail()
    {
        $params = [
            'title' => 'a',
            'content' => 'a'
        ];

        $this->actingAs($this->user())
            ->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        $message = session('errors')->getMessages();

        $this->assertEquals("The title must be at least 3 characters.", $message['title'][0]);

    }

    public function testUpdateValid()
    {
        $post = new BlogPost();
        $post->title = 'title asas';
        $post->content = 'content sfsdfs';
        $post->save();

        //dd($post->toArray());

        //$this->assertDatabaseHas('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'title asas'
        ]);

        $params = [
            'title' => 'new update title',
            'content' => 'new update content',
        ];

        $this->actingAs($this->user())
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals("updated post", session('status'));

        $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }

    public function testDeletePost()
    {
        $user = $this->user();

        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts', [
            'title' => $post->title
        ]);

        $this->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals("Blog post was deleted", session('status'));
        $this->assertDatabaseMissing('blog_posts', [
            'title' => $post->title,
            'content' => $post->content
        ]);
    }

    private function createDummyBlogPost(): BlogPost
    {
        return BlogPost::factory()->definedBlogPost()->create();
    }
}
