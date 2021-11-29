<?php

namespace App\Listeners;

use App\Events\PostPosted;
use App\Jobs\ThrottalMail;
use App\Mail\PostAdded;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminWhenPost
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(PostPosted $event)
    {
        User::thatIsAdmin()->get()->map(function(User $user){
            ThrottalMail::dispatch(
                new PostAdded(),
                $user
            );
        });
    }
}
