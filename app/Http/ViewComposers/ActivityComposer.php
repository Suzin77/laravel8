<?php

namespace App\Http\ViewComposers;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ActivityComposer
{

    public function compose(View $view)
    {
        $mostCommented = Cache::tags(['blog-post'])->remember('most_popular', now()->addSeconds(10), function (){
            return  BlogPost::mostpopular()->take(5)->get();
        });

        $mostActiveUsers = Cache::tags(['blog-post'])->remember('mostActiveUsers', now()->addSeconds(10), function (){
            return  User::mostActive()->take(5)->get();
        });

        $mostActiveLastMonth = Cache::tags(['blog-post'])->remember('mostActiveLastMonth', now()->addSeconds(10), function (){
            return  User::mostActiveLastMonth()->take(5)->get();
        });

        $view->with('mostCommented', $mostCommented);
        $view->with('mostActiveUsers', $mostActiveUsers);
        $view->with('mostActiveLastMonth', $mostActiveLastMonth);
    }
}
