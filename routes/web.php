<?php

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

Route::get('/', function () {
    return view('home.index');
})->name('home.index');

Route::get('/contact', function (){
    return 'Contact';
})->name('contact');

Route::get('/posts/{id}', function ($id){

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
    //dd($posts[1]);
    abort_if(!isset($posts[$id]),404);
    return view('post.show',['post' => $posts[$id]]);
})->name('posts.show');

Route::get('/recent/{days_ago?}', function ($ago = 20){
    return 'tyle dni '.$ago;
})->name('posts.recent.index');
