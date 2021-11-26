<?php

namespace App\Providers;

use App\Policies\PostPoslicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
         'App\Models\Post' => 'App\Policies\PostPoslicy',
         'App\Models\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('home.secret', function($user){
            return $user->is_admin;
        });

        // Gate::define('update_post', function($user, $post){
        //     return $user->id === $post->user_id;
        // });

        // Gate::define('delete_post', function($user, $post){
        //     return $user->id == $post->user_id;
        // });

            // Gate::define('posts.update', [PostPoslicy::class, 'update']);
            // Gate::define('posts.delete', [PostPoslicy::class, 'delete']);

         Gate::resource('user', UserPolicy::class);

        Gate::before(function($user, $ability){
            if ($user->is_admin && in_array($ability, ['update', 'delete'])) {
                return true;
            }
        });

        

        // Gate::after(function($user, $ability){
        //     if ($user->is_admin) {
        //         return true;
        //     }
        // });
    }
}
