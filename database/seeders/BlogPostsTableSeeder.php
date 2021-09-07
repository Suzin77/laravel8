<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allUsers = User::all();
        BlogPost::factory(50)->make()->each(function ($post) use ($allUsers){
            $post->user_id = $allUsers->random()->id;
            $post->save();
        });
    }
}
