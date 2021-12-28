<?php

namespace App\Listeners;

use App\Events\Registered;
use App\Jobs\ThrottalMail;
use App\Mail\Registered as MailRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisteredUser
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
     * @param  \App\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        ThrottalMail::dispatch(new MailRegistered($event->user), $event->user)->onQueue('high');
    }
}
