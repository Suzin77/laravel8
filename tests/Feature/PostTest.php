<?php

namespace Tests\Feature;

use App\Models\BlogPost;
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

        $this->assertDatabaseHas('blog_posts', [
            'title' => $post->title
        ]);
    }

    public function testStoreValid()
    {
        $params = [
            'title' => 'new title',
            'content' => 'new content',
        ];

        $this->post('/posts', $params)
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

        $this->post('/posts', $params)
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

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals("updated post", session('status'));

        $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }

    public function testDeletePost()
    {
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'title1'
        ]);

        $this->delete("/posts/{$post->id}")
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
        $post = new BlogPost([
            'title' => 'title1',
            'content' => 'content1'
        ]);

        $post->save();

        return $post;
    }
}
