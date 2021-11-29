<?php

namespace App\Listeners;

use Illuminate\Cache\Events\CacheHit;
use Illuminate\Cache\Events\CacheMissed;
use Illuminate\Support\Facades\Log;

class Subscriber
{
    
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handleCacheHit(CacheHit $event)
    {
        Log::info("{$event->key} cache miss");
    }

    public function handleCacheMissed(CacheMissed $event)
    {
        Log::info("{$event->key} cache miss");
    }

    public function subscriber($events)
    {
        $events->listen(
            CacheHit::class,
            'App\Listeners\Subscriber@handleCacheHit',
        );
        $events->listen(
            CacheMissed::class,
            'App\Listeners\Subscriber@handleCacheMissed',
        );
    }
}
