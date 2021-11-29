<?php

namespace App\Listeners;

use App\Events\PostCommented;
use App\Jobs\NotifyUsersPostedWasCommented;
use App\Jobs\ThrottalMail;
use App\Mail\CommentPostedMarkDown;


class NotifyPostCommented
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
    public function handle(PostCommented $event)
    {
        ThrottalMail::dispatch(new CommentPostedMarkDown($event->comment), $event->comment->commentable->user)->onQueue('high');
        NotifyUsersPostedWasCommented::dispatch($event->comment)->onQueue('low');
    }
}
