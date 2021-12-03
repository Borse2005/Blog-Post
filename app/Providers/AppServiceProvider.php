<?php

namespace App\Providers;

use App\Http\Resources\Comment as ResourcesComment;
use App\Http\ViewComposer\ViewComposer;
use App\Models\Comment;
use App\Models\Post;
use App\Observers\CommentObserver;
use App\Observers\PostObserver;
use App\Services\counter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Comment::observe(CommentObserver::class);
        View::composer(['posts','content'], ViewComposer::class);
        Post::observe(PostObserver::class);

        $this->app->bind(counter::class, function($app){
            return new counter(env('COUNTER_TIMEOUT'));
        });

        // $this->app->when(counter::class)->needs('$timeout')->give(env('COUNTER_TIMEOUT'));

        ResourcesComment::withoutWrapping();
        // Resources::withoutWrapping();
    }
}
