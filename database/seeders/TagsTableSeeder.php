<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tag =collect([
            'Science',
            'Sport',
            'Politics',
            'Entertainment',
            'Economy'
        ]);

        $tag->each(function($tagName){
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->save();
        });
    }
}
