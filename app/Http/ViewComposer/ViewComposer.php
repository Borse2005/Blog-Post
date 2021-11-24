<?php

namespace App\Http\ViewComposer;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class ViewComposer{
    public function compose(View $view){
        $comments = Cache::remember('comment',now()->addMinutes(10), function ()
        {
            return Post::mostCommented()->take(5)->get();
        });

        $users = Cache::remember('user', now()->addMinutes(10), function(){
            return User::withMostActiveUser()->take(5)->get();
        });

        $actives = Cache::remember('active', now()->addMinutes(10), function(){
            return User::MostActiveUserInLastMonth()->take(5)->get();
        });

        $view->with('comment', $comments);
        $view->with('user', $users);
        $view->with('active', $actives);
    }
}