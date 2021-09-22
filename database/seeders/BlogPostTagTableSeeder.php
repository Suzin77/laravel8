<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();

        if($tagCount == 0){
            $this->command->info('No tags');
            return;
        }

        $howMAnyMin = (int) $this->command->ask('Ile minimalnie', 0);
        $howMAnyMax = min((int) $this->command->ask('Ile maksymalnie', $tagCount), $tagCount);

        BlogPost::all()->each(function (BlogPost $blogPost) use ($howMAnyMax, $howMAnyMin){
               $take = random_int($howMAnyMin,$howMAnyMax);
               $tags = Tag::inRandomOrder()->take($take)->get()->pluck('id');
               $blogPost->tags()->sync($tags);
        });
    }
}
