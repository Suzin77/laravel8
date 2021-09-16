<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only([
            'create',
            'store',
            'edit',
            'update',
            'destroy'
        ]);
    }

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
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        DB::connection()->enableQueryLog();

        $posts = BlogPost::all();
        return view('posts.index',
            [
                'posts' => BlogPost::mydesc()->withCount('comments')->get(),
                'most_popular' => BlogPost::mostpopular()->take(5)->get(),
                'mostActiveUsers' => User::mostActive()->take(5)->get(),
                'mostActiveLastMonth' => User::mostActiveLastMonth()->take(5)->get(),
            ]
        );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        //$this->authorize('create', BlogPost::class);
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePost $request
     * @return RedirectResponse|Response
     */
    public function store(StorePost $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;
        $post = BlogPost::create($validated);

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
//        $posts = BlogPost::with([
//            'comments' => function ($query){
//                return $query->myDesc();
//            }
//        ])->findOrFail($id);
        $posts = BlogPost::with(['comments'])->findOrFail($id);
//        abort_if(!isset($this->posts[$id]),404);
        return view('posts.show',['posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View|Response
     */
    public function edit(int $id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize('update', $post);

//        if(Gate::denies('update-post', $post)){
//            abort(403, 'Otóż nie tym razem');
//        }

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

        if(Gate::denies('post.update', $post)){
            abort(403,'No i dupa');
        }
        $validated = $request->validated();

        $post->fill($validated);
        $post->save();

        $request->session()->flash('status', 'updated post');
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

        $this->authorize('delete', $post);

//        if(Gate::denies('post.delete', $post)){
//            abort(403, 'Kasowanko? Otóż nie tym razem.');
//        }

        $post->delete();

        session()->flash('status', 'Blog post was deleted');

        return redirect()->route('posts.index');
    }
}
