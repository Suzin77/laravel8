<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = BlogPost::all();

        $commentsNumber = $this->command->ask('Ile commentów', 150);
        Comment::factory($commentsNumber)->make()->each(function ($comment) use ($posts){
            $comment->blog_post_id  = $posts->random()->id;
            $comment->save();
        });
    }
}
