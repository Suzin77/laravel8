<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostsController extends Controller
{

    private $posts = [
        1=> [
            'title' => 'title1',
            'content' => 'content1'
        ],
        2=> [
            'title' => 'title2',
            'content' => 'content2'
        ],
    ];
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('posts.index', ['posts' => BlogPost::orderBy('created_at', 'desc')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePost $request
     * @return Response
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $post = BlogPost::create();

        $post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();

        $request->session()->flash('status', 'created post');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(int $id)
    {
//        abort_if(!isset($this->posts[$id]),404);
        return view('posts.show',['posts' => BlogPost::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(int $id)
    {
        $post = BlogPost::findOrFail($id);

        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StorePost $request
     * @param int $id
     * @return void
     */
    public function update(StorePost $request, int $id)
    {
        $post = BlogPost::findOrFail($id);

        $validated = $request->validated();

        $post->fill($validated);
        $post->save();

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $post = BlogPost::findOrFail($id);

        $post->delete();

        session()->flash('status', 'Blog post was deleted');

        return redirect()->route('posts.index');
    }
}
