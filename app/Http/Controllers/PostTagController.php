<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function index($tag)
    {

        $tag = Tag::findOrFail($tag);

        //dd($tag->blogPosts, $tag->blogPosts());
        return view('posts.index', [
            'posts' => $tag->blogPosts,
        ]);
    }
}