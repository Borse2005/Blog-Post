<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class counter
{
    public function increament(string $key)
    {
        $sessionId = session()->getId();
        $counterKeys = "post-{$key}-counter";
        $usersKey = "post-{$key}-user";

        $users = Cache::get($usersKey, []);
        $usersUpdate = [];
        $difference = 0;
        $now = now();
        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= 1) {
                $difference--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if (!array_key_exists($sessionId, $users) || $now->diffInMinutes($users[$sessionId]) >= 1) {
            $difference++;
        }

        $usersUpdate[$sessionId] = $now;

        Cache::forever($usersKey, $usersUpdate);

        if (!Cache::has($counterKeys)) {
            Cache::forever($counterKeys, 1);
        } else {
            Cache::increment($counterKeys, $difference);
        }

        $counter = Cache::get($counterKeys);

        return $counter;
    }
}
