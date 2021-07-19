<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('posts', PostsController::class)->only('index', 'show');


Route::get('/', [HomeController::class, 'home'])
    ->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])
    ->name('home.contact');

Route::get('/single', AboutController::class);


$posts = [
    1=> [
        'title' => 'title1',
        'content' => 'content1'
    ],
    2=> [
        'title' => 'title2',
        'content' => 'content2'
    ],
];

//Route::get('/posts/{id}', function ($id) use($posts){
//
//    //dd($posts[1]);
//    abort_if(!isset($posts[$id]),404);
//    return view('posts.show',['posts' => $posts[$id]]);
//})->name('posts.show');

//Route::get('/posts', function () use ($posts){
//    return view('posts.index', compact('posts'));
//});

Route::get('/recent/{days_ago?}', function ($ago = 20){
    return 'tyle dni '.$ago;
})->name('posts.recent.index')->middleware('auth');


Route::prefix('/fun')->name('fun.')->group(function () use($posts){

    Route::get('/responses', function () use($posts){
        return response($posts,201)
            ->header('Content-Type', 'application/json')
            ->cookie('MY_COOKIE','PAt sos', 3600);
    });

    Route::get('/redirect', function (){
        return redirect('/contact');
    });

    Route::get('/back', function (){
        return back();
    });

    Route::get('/named', function (){
        return redirect()->route('posts.show', ['id' => 1]);
    });

    Route::get('/json', function () use ($posts){
        return response()->json($posts);
    });

    Route::get('/download', function () use ($posts){
        return response()->download(public_path('/comment_1622520186qF3VQ0Ik9GG4W0Uwxgvqi2.jpg'), 'jebaniutki');
    });

});

