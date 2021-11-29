<?php

namespace App\Providers;

use App\Events\PostCommented;
use App\Events\PostPosted;
use App\Listeners\NotifyAdminWhenPost;
use App\Listeners\NotifyPostCommented;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        PostCommented::class => [
            NotifyPostCommented::class,
        ],
        PostPosted::class => [
            NotifyAdminWhenPost::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
