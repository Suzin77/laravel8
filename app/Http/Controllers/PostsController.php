<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Models\BlogPost;
use App\Models\Image;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

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

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        DB::connection()->enableQueryLog();

        //$posts = BlogPost::all();

        return view('posts.index',
            [
                'posts' => BlogPost::mydesc()->withCount('comments')->with(['user','tags'])->get()
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


        if($request->hasFile('thumbnail')){
            $path = $request->file('thumbnail')->store('thumbnails');
            $post->image()->save(Image::create(['path' => $path,]));

            //to
            //$name1 = $file->storeAs('thumbnail', $post->id. "." .$file->guessExtension());
            //is the same as:
            //$name2 = \Storage::disk('local')->putFileAs('thumbnails', $file, $post->id.".".$file->guessExtension());
        }

        //die;


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
        $sessionId = Session::getId();
        $counterKey = "blog-post-{$id}-counter";
        $usersKey = "blog-post-{$id}-users";

        $users = Cache::tags(['blog-post'])->get($usersKey, []);
        $usersUpdate = [];
        $difference = 0;
        $now = now();

        foreach ($users as $session => $lastVisit){
            if($now->diffInMinutes($lastVisit) >= 1){
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if(!array_key_exists($sessionId,$users) || $now->diffInMinutes($users[$sessionId]) >= 1){
            $difference++;
        }

        $usersUpdate[$sessionId] = $now;
        Cache::tags(['blog-post'])->put($usersKey,$usersUpdate);

        if(!Cache::tags(['blog-post'])->has($counterKey)){
            Cache::tags(['blog-post'])->forever($counterKey, 1);
        } else {
            Cache::tags(['blog-post'])->increment($counterKey, $difference);
        }

        $counter = Cache::tags(['blog-post'])->get($counterKey);

        $posts = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 30, function () use($id){
            return BlogPost::with(['comments', 'tags', 'comments.user'])->findOrFail($id);
        });

        //$posts = BlogPost::with(['comments'])->findOrFail($id);
//        abort_if(!isset($this->posts[$id]),404);
        return view('posts.show',['posts' => $posts, 'counter' => $counter]);
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
//            abort(403, 'Ot???? nie tym razem');
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
        if($request->hasFile('thumbnail')){
            $newPath = $request->file('thumbnail')->store('thumbnails');
            if($post->image){
                \Storage::delete($post->image->path);
                $post->image->path =$newPath;
                $post->image->save();
            } else {
                $post->image()->save(Image::create(['path' => $newPath,]));
            }

        }
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
//            abort(403, 'Kasowanko? Ot???? nie tym razem.');
//        }

        $post->delete();

        session()->flash('status', 'Blog post was deleted');

        return redirect()->route('posts.index');
    }
}
